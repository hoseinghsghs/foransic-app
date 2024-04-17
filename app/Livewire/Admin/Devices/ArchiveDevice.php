<?php

namespace App\Livewire\Admin\Devices;

use App\Models\Device;
use App\Models\User;
use App\Models\TitleManagement;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ArchiveDevice extends Component
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
        $title_ids= TitleManagement::where('title' , 'like', '%' . $this->title . '%')->pluck('id');
        $devices = Device::where('is_archive',true)->where( 'code', 'like', '%' . $this->title . '%')->orWhereIn('title_managements_id',$title_ids)

            ->when($this->status != '', function ($query) {
                $query->where('status', $this->status);
            })->when($this->is_active != '', function ($query) {
                $query->where('is_active', $this->is_active);
            })->latest()->paginate(10);
        return view('livewire.admin.devices.archive-device',compact(['devices']));
    }
}
