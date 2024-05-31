<?php

namespace App\Livewire\Admin\Devices;

use App\Models\Dossier;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use App\Models\Device;
use App\Models\Category;
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
        Gate::authorize('devices-active-status');

        $device->update([
            "is_active" => !$device->is_active
        ]);
    }

    public function ChangeArchive_device(Device $device)
    {
        Gate::authorize('devices-archive-status');

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
        $category_ids = Category::where('title', 'like', '%' . $this->title . '%')->pluck('id')->toArray();

        $devices = Device::with(['category','laboratory'])->where('is_archive', false)->when(!auth()->user()->hasRole(['Super Admin','company']), function ($query) {
            $query->where('laboratory_id', auth()->user()->laboratory_id);
        })->when(auth()->user()->hasRole('company'),function ($query){
            // get devices that refer to dossier of company user
            $user_dossiers=Dossier::where('user_category_id',auth()->user()->id)->get()->pluck('id')->toArray();
            $query->whereIn('dossier_id',$user_dossiers);
        })->when($this->title, function ($query) use ($category_ids) {
            $query->where('code', 'like', '%' . $this->title . '%')->orWhereIn('category_id', $category_ids);
        })->when($this->title, function ($query) {
            $query->where('id', 'like', '%' . $this->title . '%');
        })->when($this->status != '', function ($query) {
            $query->where('status', $this->status);
        })->when($this->is_active != '', function ($query) {
            $query->where('is_active', $this->is_active);
        })->latest()->paginate(10);

        return view('livewire.admin.devices.device-component', compact(['devices']))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
