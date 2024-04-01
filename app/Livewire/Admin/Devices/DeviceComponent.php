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
    public $name;
    public $status;

    public function updatingName()
    {
        $this->resetPage();
    }

    public function updatingStatus()
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
        $devices = Device::where('name', 'like', '%' . $this->name . '%')
            ->where('is_active', 'like', '%' . $this->status . '%')
            ->where('is_archive', 0)->latest()
            ->paginate(10);

        return view('livewire.admin.devices.device-component', ['devices' => $devices]);
    }
}
