<?php

namespace App\Livewire\Admin\Devices;

use App\Http\Controllers\Admin\ImageController;
use App\Models\Device;
use App\Models\DeviceImage;
use App\Models\User;
use App\Models\Dossier;
use App\Models\Category;
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
    public string $category_id = '';
    public string $code = '';
    public string $trait = '';
    public string $correspondence_number = '';
    public string $correspondence_date = '';
    public $dossier_id;
    public string $delivery_code = '';
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
            'category_id' => 'required|integer|exists:categories,id',
            'status' => 'required|integer',
            'dossier_id'=>'nullable|integer|exists:dossiers,id',
            'description' => 'nullable|string',
            'accessories' => 'nullable|string',
            'code' => 'required|string|unique:devices,code,'.$this->device->id,
            'delivery_code' => 'nullable|string',
            'trait' => 'nullable|string',
            'correspondence_number' => 'nullable|string',
            'correspondence_date' => 'nullable|string',
            'delivery_name' => 'required|string',
            'receiver_name' => 'required_if:status,3|string',
            'receiver_code' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'receiver_name.required_if' => 'نام تحویل گیرنده ضروری است.',
            'receiver_code.required_if' => 'کد تحویل گیرنده ضروری است.',
        ];
    }

    public function mount()
    {
        $this->category_id = $this->device->category_id;
        $this->code = $this->device->code;
        $this->trait = $this->device->trait;
        $this->dossier_id = $this->device->dossier_id;
        $this->status = $this->device->status;
        $this->correspondence_number = $this->device->correspondence_number;
        $this->correspondence_date = $this->device->correspondence_date;
        $this->delivery_name = $this->device->delivery_name;
        $this->delivery_code = $this->device->delivery_code;
        $this->receiver_name = $this->device->receiver_name;
        $this->receiver_code = $this->device->receiver_code;
        $this->is_active = !$this->device->is_active;
        $this->accessories = $this->device->accessories;
        $this->description = $this->device->description;
    }

    public function edit()
    {
        if ($this->status == 3) {
            $delivery_date = verta()->formatJalaliDatetime();
        } else {
            $delivery_date = '-';
        }

        $this->validate();
        $this->device->update([
            'category_id' => $this->category_id,
            'status' => $this->status,
            'description' => $this->description,
            'accessories' => $this->accessories,
            'trait' => $this->trait,
            'dossier_id' => $this->dossier_id,
            'code' => $this->code,
            'correspondence_number' => $this->correspondence_number,
            'correspondence_date' => $this->correspondence_date,
            'delivery_code' => $this->delivery_code,
            'delivery_name' => $this->delivery_name,
            'receiver_name' => $this->receiver_name,
            'receiver_code' => $this->receiver_code,
            'delivery_staff_id' => auth()->user()->id,
            'delivery_date' => $delivery_date,
            'is_active' => !$this->is_active,
        ]);
        toastr()->rtl(true)->addInfo('دستگاه / قطعه مورد نظر ویرایش شد', ' ');
//        flash()->addSuccess('دستگاه / قطعه مورد نظر دریافت شد');
        return redirect()->route('admin.devices.index');
    }


    public function render()
    {
        $users = User::all();
        $dossiers = Dossier::all();
        $categories = Category::all();
        // dd($users->hasRole('super-admin'));
        return view('livewire.admin.devices.edit-device', compact('users', 'dossiers' , 'categories'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}

