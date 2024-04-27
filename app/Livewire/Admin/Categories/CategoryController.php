<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;


class CategoryController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $title;
    public Category $category;
    public $attribute_ids = [];
    public $is_edit = false;
    public $display;

    // function for reset variables
    public function ref()
    {
        $this->is_edit = false;
        $this->reset("title");
        $this->reset("attribute_ids");
        $this->reset("display");
        $this->dispatch('destroy-attribute');
        $this->resetValidation();
    }

    public function add_category()
    {
        if ($this->is_edit) {
            $this->validate([
                'title' => 'required|unique:categories,title,' . $this->category->id,
                'attribute_ids' => 'required|array',
                'attribute_ids.*' => 'nullable|exists:attributes,id'
            ]);

            try {
                DB::beginTransaction();
                $this->category->update([
                    'title' => $this->title,
                ]);
                $this->category->attributes()->sync($this->attribute_ids);
                DB::commit();
                // reset variables
                $this->ref();
                flash()->addSuccess('تغییرات با موفقیت ذخیره شد');
            } catch (\Exception $ex) {
                DB::rollBack();
                toastr()->rtl()->addError($ex->getMessage());
            }
        } else {
            $this->validate([
                'title' => 'required|unique:categories,title',
                'attribute_ids' => 'nullable|array',
                'attribute_ids.*' => 'nullable|exists:attributes,id'
            ]);

            try {
                DB::beginTransaction();
                $category = Category::create([
                    "title" => $this->title,
                ]);
                $category->attributes()->attach($this->attribute_ids);
                DB::commit();
                // reset variables
                $this->ref();
                flash()->addSuccess('عنوان با موفقیت ایجاد شد');
            } catch (\Exception $ex) {
                DB::rollBack();
                toastr()->rtl()->addError($ex->getMessage());
            }
        }
    }

    public function edit_category(Category $category)
    {
        $this->is_edit = true;
        $this->title = $category->title;
        $this->category = $category;
        $this->attribute_ids = $category->attributes()->pluck('attributes.id')->toArray();
        $this->display = "disabled";
        $this->dispatch('update-attribute', attribute_ids: $this->attribute_ids);
    }

    public function del_category(Category $category)
    {
        if ($category->devices()->exists() || $category->attributes()->exists()) {
            flash()->addWarning('به علت الحاق عنوان به قطعه یا شواهد امکان حذف آن وجود ندارد');
        } else {
            $category->delete();
            flash()->addSuccess('دسته بندی با موفقیت حذف شد');
        }
    }

    public function render()
    {
        $categories = Category::latest()->with('attributes')->paginate(10);
        $attributes = Attribute::all();
        return view('livewire.admin.categories.category-management', compact(['categories', 'attributes']))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
