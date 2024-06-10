<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\Device;
use App\Models\DeviceAttribute;
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
            $this->authorize('categories-edit');

            $this->validate([
                'title' => 'required|unique:categories,title,' . $this->category->id,
                'attribute_ids' => 'required|array',
                'attribute_ids.*' => 'nullable|exists:attributes,id'
            ]);
            //check if attributes don't have value
            $category_attributes_ids = $this->category->attributes()->pluck('attributes.id')->toArray();
            $res = array_diff($category_attributes_ids, $this->attribute_ids);
            if (count($res) > 0) {
                $category_devices_ids = $this->category->devices()->pluck('devices.id')->toArray();
                $forbidden_attribute = DeviceAttribute::whereIn('device_id', $category_devices_ids)->whereIn('attribute_id', $res)->get();

                if (count($forbidden_attribute) > 0) {
                    flash()->addWarning('به علت مقدار دهی ویژگی دسته بندی امکان حذف آن وجود ندارد.');
                } else {

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
                }
            }
        } else {
            $this->authorize('categories-create');

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
        $this->authorize('categories-edit');
        $this->is_edit = true;
        $this->title = $category->title;
        $this->category = $category;
        $this->attribute_ids = $category->attributes()->pluck('attributes.id')->toArray();
        $this->display = "disabled";
        $this->dispatch('update-attribute', attribute_ids: $this->attribute_ids);
    }

    public function del_category(Category $category)
    {
        $this->authorize('categories-delete');
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
