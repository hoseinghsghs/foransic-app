<?php

namespace App\Livewire\Admin\Devices;

use Livewire\Component;
use App\Models\Device;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

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

       public function export()
    {
        return Storage::disk('exports')->download('export.csv');
    }
    public function render()
    {
                $category_ids= Category::where('title' , 'like', '%' . $this->title . '%')->pluck('id');
        $devices = Device::where('is_archive',true)->where( 'code', 'like', '%' . $this->title . '%')->orWhereIn('category_id',$category_ids)

            ->when($this->status != '', function ($query) {
                $query->where('status', $this->status);
            })->when($this->is_active != '', function ($query) {
                $query->where('is_active', $this->is_active);
            })->latest()->paginate(10);

        return view('livewire.admin.devices.device-component', compact(['devices']));
    }
}
