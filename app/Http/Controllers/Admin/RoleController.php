<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Flasher\Toastr\Prime\ToastrFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.page.roles.index', [
            'roles' => Role::paginate(10)
        ]);
    }

    public function create()
    {
        return view('admin.page.roles.create', ['permissions' => Permission::all()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:roles',
            'display_name' => 'required|unique:roles',
            'permissions' => 'nullable|array',
        ]);

        try {
            DB::beginTransaction();
            $role = Role::create(['name' => $data['name'], 'display_name' => $data['display_name']]);
            $role->syncPermissions($data['permissions'] ?? []);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            flash()->addError($ex->getMessage());
            return redirect()->route('admin.roles.index');
        }

        flash()->addSuccess('نقش کاربری با موفقیت ایجاد شد');
        return redirect()->route('admin.roles.index');
    }

    public function edit(Role $role)
    {
        $role->load('permissions');
        return view('admin.page.roles.edit', [
            'role' => $role,
            'permissions' => Permission::all()
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'display_name' => 'required|unique:roles,display_name,' . $role->id,
            'permissions' => 'nullable|array',
        ]);
        try {
            DB::beginTransaction();
            if ($data['name'] == 'Super Admin')
                $data2 = array_only($data, ['display_name']);
            else
                $data2 = array_only($data, ['name', 'display_name']);

            $role->update($data2);
            $role->syncPermissions($data['permissions'] ?? []);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            flash()->addError($ex->getMessage());
            return redirect()->route('admin.roles.index');
        }
        flash()->addSuccess('تغییرات با موفقیت ثبت شد');
        return redirect()->back();
    }

    public function destroy(Role $role)
    {
        if (count($role->permissions) > 0)
            flash()->addWarning('به دلیل الحاق مجوز به نقش امکان حذف آن وجود ندارد.');
        elseif (count($role->users) > 0)
            flash()->addWarning('به دلیل الحاق نقش به کاربر امکان حذف آن وجود ندارد.');
        elseif ($role->name == 'Super Admin')
            flash()->addWarning('امکان حذف نقش مورد نظر وجود ندارد.');
        else {
            $role->delete();
            flash()->addSuccess('نقش مورد نظر با موفقیت حذف گردید.');
        }
        return redirect()->back();
    }
}
