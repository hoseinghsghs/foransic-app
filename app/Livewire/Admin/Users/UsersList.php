<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class UsersList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $role='';

    protected $rules = [
        'search' => 'nullable|string',
    ];

    public function updatedSearch($search)
    {
        $this->validate();
        $this->resetPage();
    }
    public function updatedRole($role)
    {
        if ($role && $role !='false'){
            $this->validate(['role'=>'string|exists:roles,name'],[],['role'=>"نقش"]);
        }
        $this->resetPage();
    }

    public function render()
    {
        $roles=Role::all();
        $users=User::when($this->search,function ($query){
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orWhere('cellphone', 'like', '%' . $this->search . '%');
        })->when(!empty($this->role),function ($query){
            if ($this->role == 'false'){
                $query->whereDoesntHave('roles');
            }else{
                $query->whereHas('roles',function ($query){
                    $query->where('name',$this->role);
                });
            }
        })->paginate(10);
        return view('livewire.admin.users.users-list', compact(['roles','users']));
    }
}
