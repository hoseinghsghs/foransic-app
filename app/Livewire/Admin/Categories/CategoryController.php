<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;


class CategoryController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $title;
    public Category $category;
    public $is_edit = false;
    public $display;

    public function ref()
    {
        $this->is_edit = false;
        $this->reset("title");
        $this->reset("display");
        $this->resetValidation();
    }

    public function add_category()
    {
        if ($this->is_edit) {
            $this->validate([
                'title' => 'required|unique:categories,title,' . $this->category->id
            ]);

            $this->category->update([
                'title' => $this->title,
            ]);

            $this->is_edit = false;
            $this->reset("title");
            $this->reset("display");
            toastr()->rtl()->addSuccess('تغییرات با موفقیت ذخیره شد',' ');
        } else {
            $this->validate([
                'title' => 'required|unique:categories,title'
            ]);

            Category::create([
                "title" => $this->title,
            ]);
            $this->reset("title");
            toastr()->rtl()->addSuccess('عنوان با موفقیت ایجاد شد',' ');
        }
    }

    public function edit_category(Category $category)
    {
        $this->is_edit = true;
        $this->title = $category->title;
        $this->category = $category;
        $this->display = "disabled";
    }

    public function del_category(Category $category)
    {
        if ($category->devices()->exists()){
            toastr()->rtl()->addWarning('به علت الحاق عنوان به قطعه یا دستگاه امکان حذف آن وجود ندارد');
        }else{
            $category->delete();
            toastr()->rtl()->addSuccess('عنوان با موفقیت حذف شد');
        }
    }

    public function render()
    {
        return view('livewire.admin.categories.category-management', ['categories' => Category::latest()->paginate(10)])->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
