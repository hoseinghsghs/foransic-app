<?php
namespace App\Livewire\Admin\Devices;

use App\Http\Controllers\Admin\ImageController;
use App\Models\Device;
use App\Models\DeviceImage;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Verta;

class EditDevice extends Component
{
    use WithFileUploads;


    public Device $device;
    public string $name = '';
    public string $code = '';
    public string $delivery_code = '';
    public  $user_category_id ;
    public string $delivery_name = '';
    public string $receiver_name = '';
    public string $receiver_code = '';
    public string $status = 'پیش فرض';
    public string $description = '';
    public string $accessories = '';
    public $primary_image;
    public bool $is_active = false;


    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'status' => 'required',
            'description' => 'required|string',
            'accessories' => 'required|string',
            'code' => 'required|string',
            'delivery_code' => 'required|string',
            'delivery_name' => 'required|string',
        ];
    }

    public function mount()
    {
        $this->name=$this->device->name;
        $this->code=$this->device->code;
        $this->status=$this->device->status;
        $this->delivery_name=$this->device->delivery_name;
        $this->delivery_code=$this->device->delivery_code;
        $this->receiver_name=$this->device->receiver_name;
        $this->receiver_code=$this->device->receiver_code;
        $this->is_active=!$this->device->is_active;
        $this->accessories=$this->device->accessories;
        $this->description=$this->device->description;
        $this->user_category_id=$this->device->user_category_id;
    }

    public function edit()
    {
        $this->validate();
           $this->device->update([
                'name' => $this->name,
                'user_category_id' => $this->user_category_id,
                'status' => $this->status,
                'description' => $this->description,
                'accessories' => $this->accessories,
                'code' => $this->code,
                'delivery_code' => $this->delivery_code,
                'delivery_name' => $this->delivery_name,
                'receiver_name' => $this->receiver_name,
                'receiver_code' => $this->receiver_code,
                'delivery_staff_id' => auth()->user()->id,
                'delivery_date' => verta()->formatJalaliDatetime(),
                'is_active' => !$this->is_active,
            ]);


        alert()->success('دیوایس مورد نظر دریافت شد')->toToast();
        return redirect()->route('admin.devices.index');
    }


       public function render()
    {
        $users = User::all();
        // dd($users->hasRole('super-admin'));
        return view('livewire.admin.devices.edit-device', compact('users'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}

