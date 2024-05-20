<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Action;
use Flasher\Toastr\Prime\ToastrFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        Gate::authorize('users-list');
        $users = User::when(!auth()->user()->hasRole('Super Admin'), function ($query) {
            $query->where('laboratory_id', auth()->user()->laboratory_id);
        })->latest()->paginate(10);
        return view('admin.page.users.index', compact('users'));
    }

    public function create()
    {
        Gate::authorize('users-create');

        $roles = Role::all();
        return view('admin.page.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        Gate::authorize('users-create');

        $request->validate([
            'name' => 'nullable|string|max:255',
            'role' => 'required|string|exclude_if:role,false|exists:roles,name',
            'laboratory_id' => ['integer','nullable','exists:laboratories,id', Rule::requiredIf(is_null(auth()->user()->laboratory_id))],
            'username' => [
                'nullable',
                'required_without:cellphone',
                'string',
                'max:255',
                Rule::unique(User::class,'email'),
            ],
            'cellphone' => 'nullable|required_without:username|numeric|unique:users,cellphone',
            'password' => ['required', Password::min(8)],
        ]);
        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->name,
                'email' => $request->username,
                'cellphone' => $request->cellphone,
                'laboratory_id' => is_null(auth()->user()->laboratory_id) ? $request->laboratory_id : auth()->user()->laboratory_id,
                'password' => Hash::make($request->password),
            ]);
            $user->syncRoles($request->role != 'false' ? [$request->role] : []);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            toastr()->rtl(true)->addError($ex->getMessage(), ' ');
            return redirect()->route('admin.users.index');
        }
        toastr()->rtl(true)->addSuccess('کاربر با موفقیت افزوده شد', ' ');
        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        Gate::authorize('is-same-laboratory',$user->laboratory_id);
        Gate::authorize('users-edit');

        $user->load(['roles', 'permissions']);
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        return view('admin.page.users.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, User $user, ToastrFactory $flasher)
    {
        Gate::authorize('is-same-laboratory',$user->laboratory_id);
        Gate::authorize('users-edit');

        $data = $request->validate([
            'name' => 'nullable|string',
            'username' => 'required_without:cellphone|nullable|string|unique:users,email,' . $user->id,
            'cellphone' => 'required_without:username|nullable|numeric|unique:users,cellphone,' . $user->id,
            'role' => 'required|string|exclude_if:role,false|exists:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'nullable|exists:permissions,name',
            'password' => ['nullable', Password::min(8)],
        ]);
        try {
            DB::beginTransaction();
            $data['email']=$data['username'];
            $user->update($data['password'] ? Arr::only($data, ['name', 'email', 'cellphone', 'password']) : Arr::only($data, ['name', 'email', 'cellphone']));
            $user->syncRoles(array_key_exists('role',$data) ? [$data['role']] : []);
            $user->syncPermissions($data['permissions'] ?? []);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            $flasher->addError($ex->getMessage());
            return redirect()->route('admin.users.index');
        }

        $flasher->addSuccess('کاربر با موفقیت ویرایش شد');
        return redirect()->back();
    }

    public function show(User $user)
    {
        Gate::authorize('is-same-laboratory',$user->laboratory_id);
        Gate::authorize('users-show');

        $actions = Action::where('user_id', $user->id)->take(10)->get();
        return view('admin.page.users.show', compact('user', 'actions'));
    }
}
