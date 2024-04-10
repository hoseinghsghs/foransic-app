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

class CreateDevice extends Component
{
    use WithFileUploads;

    public Device $device;
    public string $name = '';
    public string $code = '';
    public string $trait = '';
    public string $delivery_code = '';
    public $user_category_id;
    public string $delivery_name = '';
    public string $status = 'پیش فرض';
    public string $description = '';
    public string $accessories = '';
    public bool $is_active = false;
    public $primary_image;
    protected $listeners = [
        'sweetalertConfirmed',// only when confirm button is clicked
        'sweetalertDenied'
    ];

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'status' => 'required',
            'user_category_id'=>'required',
            // 'description' => 'required|string',
            'description' => 'string',
            'accessories' => 'string',
            // 'accessories' => 'required|string',
            'code' => 'required|string',
            // 'code' => 'required|string|unique:devices,code',
            'delivery_code' => 'string',
            'trait' => 'string',
            // 'delivery_code' => 'required|string',
            'delivery_name' => 'required|string',
            'primary_image' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2000',
        ];
    }

    public function mount()
    {
        Session::forget('images');
    }

    public function create()
    {
        $this->validate();
        try {

            DB::beginTransaction();
            if ($this->primary_image) {

                $ImageController = new ImageController();

                $image_name = $ImageController->UploadeImage($this->primary_image, "primary_image", 900, 800);

            } else {
                $image_name = null;
                $this->addError('primary_image', 'مشکل در ذخیره سازی عکس');
            }
            $device = Device::create([
                'name' => $this->name,
                'user_category_id' => $this->user_category_id,
                'status' => $this->status,
                'trait' => $this->trait,
                'primary_image' => $image_name,
                'description' => $this->description,
                'accessories' => $this->accessories,
                'code' => $this->code,
                'delivery_code' => $this->delivery_code,
                'delivery_name' => $this->delivery_name,
                'receiver_name' => "",
                'receiver_code' => 0,
                'delivery_staff_id' => 0,
                'receiver_staff_id' => auth()->user()->id,
                'delivery_date' => "",
                'receiver_date' => verta()->format('Y/n/j H:i'),
                'is_active' => !$this->is_active,
                'is_archive' => 0,
            ]);
            $imagesStore = Session::pull('images', []);
            foreach ($imagesStore as $imageStore) {
                DeviceImage::create([
                    'device_id' => $device->id,
                    'image' => $imageStore
                ]);
            }
            DB::commit();
        } catch (\Exception $ex) {
            toastr()->rtl(true)->persistent()->closeButton()->addError('خطا', $ex->getMessage());
            DB::rollBack();
            return redirect()->back();
        }
        Session::forget('images');

        $this->device=$device;
        sweetalert()
            ->showDenyButton()->timerProgressBar(false)->persistent()
            ->addInfo('مایل به پرینت دستگاه / قطعه هستید؟');
//        toastr()->rtl()->addSuccess('دستگاه / قطعه مورد نظر دریافت شد', ' ');
         return redirect()->route('admin.devices.index');
    }

    public function sweetalertConfirmed(array $payload)
    {
        return redirect()->route('admin.print.device.show', ['device' => $this->device->id]);
//        toastr()->addSuccess('ویژگی با موفقیت حذف شد');
    }
    /*public function sweetalertDenied(array $data)
    {
        toastr()->addSuccess('ویژگی با موفقیت حذف شد');
    }*/

    public function render()
    {
        $users = User::role('company')->get();
        // dd($users->hasRole('super-admin'));
        return view('livewire.admin.devices.create-device', compact('users'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}



