<?php

namespace App\Livewire\Admin\Devices;

use Livewire\Component;
use App\Models\Device;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class DeviceComponent extends Component
{
    use WithFileUploads, WithPagination;

    public $device;

    protected $paginationTheme = 'bootstrap';
    public $title = '';
    public $company_user = '';
    public $status = '';
    public $is_active = '';

    public function updatingTitle()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function updatingIsActive()
    {
        $this->resetPage();
    }

    protected $listeners = [
        'sweetAlertConfirmed', // only when confirm button is clicked
    ];

    public function mount(Device $device)
    {

    }


    public function ChangeActive_device(Device $device)
    {
        $device->update([
            "is_active" => !$device->is_active
        ]);
    }

    public function ChangeArchive_device(Device $device)
    {
        $device->update([
            "is_archive" => true
        ]);
    }

    public function render()
    {
        $company_users = User::Role('company')->get();
        $devices = Device::whereAny(['name', 'code'], 'like', '%' . $this->title . '%')
            ->when($this->company_user != '', function ($query) {
                $query->where('user_category_id', $this->company_user);
            })
            ->when($this->status != '', function ($query) {
                $query->where('status', $this->status);
            })->when($this->is_active != '', function ($query) {
                $query->where('is_active', $this->is_active);
            })->latest()->paginate(10);

        return view('livewire.admin.devices.device-component', compact(['devices', 'company_users']));
    }
}
