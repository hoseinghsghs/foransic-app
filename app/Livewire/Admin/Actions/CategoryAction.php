<?php

namespace App\Livewire\Admin\Actions;

use App\Models\ActionCategory;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryAction extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $title;
    public ActionCategory $action_category;
    public $is_edit = false;
    public $display;

    public function ref()
    {

        $this->is_edit = false;
        $this->reset("title");
        $this->reset("display");
        $this->resetValidation();
    }

    public function add_action_category()
    {
        if ($this->is_edit) {
            $this->authorize('actions-category-edit');

            $this->validate([
                'title' => 'required|unique:action_category,title,' . $this->action_category->id,
                'action_category.id' => 'required|exists:action_category,id',
            ]);

            $this->action_category->update([
                'title' => $this->title,
            ]);

            $this->is_edit = false;
            $this->reset("title");
            $this->reset("display");
            toastr()->rtl()->addSuccess('تغییرات با موفقیت ذخیره شد', ' ');
        } else {
            $this->authorize('actions-category-create');

            $this->validate([
                'title' => 'required|unique:action_category,title'
            ]);
            ActionCategory::create([
                "title" => $this->title,
            ]);
            $this->reset("title");
            toastr()->rtl()->addSuccess('ویژگی با موفقیت ایجاد شد', ' ');
        }
    }

    public function edit_action_category(ActionCategory $action_category)
    {
        $this->authorize('actions-category-edit');

        $this->is_edit = true;
        $this->title = $action_category->title;
        $this->action_category = $action_category;
        $this->display = "disabled";
    }

    public function del_action_category(ActionCategory $action_category)
    {
        $this->authorize('actions-category-delete');

        if ($action_category->actions()->exists()) {
            flash()->addWarning('به علت الحاق عنوان به اقدام امکان حذف آن وجود ندارد');
        } else {
            $action_category->delete();
            flash()->addSuccess('دسته بندی با موفقیت حذف شد');
        }
    }

    public function render()
    {
        return view('livewire.admin.actions.category-action', ['action_categorys' => ActionCategory::latest()->paginate(10)])->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
