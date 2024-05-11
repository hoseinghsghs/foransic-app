<?php

namespace App\Livewire\Admin\Permissions;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class PermissionList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $display_name;
    public $name;
    public $permission;
    public $is_edit = false;
    public $display;

    protected $rules = [
        'display_name' => 'required|unique:permissions',
    ];

    protected $validationAttributes = [
        'name' => 'نام مجوز',
        'display_name' => 'نام نمایشی',
    ];

    public function ref()
    {
        $this->is_edit = false;
        $this->reset("display_name");
        $this->reset("name");
        $this->reset("display");
        $this->resetValidation();
    }

    public function editPermission(Permission $permission)
    {
        $this->is_edit = true;
        $this->display_name = $permission->display_name;
        $this->name = $permission->name;
        $this->permission = $permission;
        $this->display = "disabled";
    }

    public function updatePermission()
    {
            $data = $this->validate([
                'display_name' => 'required|unique:permissions,display_name,' . $this->permission->id,
            ]);

            $this->permission->update($data);

            $this->is_edit = false;
            $this->reset("display_name");
            $this->reset("name");
            $this->reset("display");

            flash()->addSuccess('تغییرات با موفقیت ثبت شد');
    }

    public function render()
    {
        return view('livewire.admin.permissions.permission-list', ['permissions' => Permission::latest()->paginate(10)])->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
