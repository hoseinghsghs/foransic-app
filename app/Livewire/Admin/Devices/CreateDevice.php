<?php

namespace App\Livewire\Admin\Devices;

use App\Http\Controllers\Admin\ImageController;
use App\Models\Device;
use App\Models\Dossier;
use App\Models\Category;
use App\Models\DeviceImage;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateDevice extends Component
{
    use WithFileUploads;

    public Device $device;
    public $category_id;
    public $attribute_values = [];
    public string $code = '';
    public string $trait = '';
    public string $correspondence_number = '';
    public string $correspondence_date = '';
    public $dossier_id;
    public int|null $laboratory_id = null;
    public string $delivery_code = '';
    public string $delivery_name = '';
    public string $receive_date = '';
    public string $status = '0';
    public string $description = '';
    public string $accessories = '';
    public bool $is_active = false;
    public $primary_image;

    public function rules(): array
    {
        // get dossiers in same laboratory
        $dossiers = Dossier::when(isset(auth()->user()->laboratory_id), function ($query) {
            $query->where('laboratory_id', auth()->user()->laboratory_id);
        })->get()->pluck('id')->toArray();

        return [
            'category_id' => 'required|integer|exists:categories,id',
            'attribute_values' => $this->category_id && $this->category->attributes()->exists() ? 'array:' . $this->category->attributes()->pluck('attributes.id')->implode(',') : 'array',
            'status' => 'required|integer',
            'dossier_id' => ['nullable','integer',Rule::in($dossiers)],
            'laboratory_id' => ['integer', 'nullable', 'exists:laboratories,id', Rule::requiredIf(is_null(auth()->user()->laboratory_id))],
            'description' => 'nullable|string',
            'accessories' => 'nullable|string',
            'code' => 'required|string|unique:devices,code',
            'delivery_code' => 'nullable|string',
            'trait' => 'nullable|string',
            'correspondence_number' => 'nullable|string',
            'correspondence_date' => 'nullable|string',
            'receive_date' => 'nullable|string',
            'delivery_name' => 'required|string',
            'primary_image' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2000',
        ];
    }

    public function getCategoryProperty()
    {
        return Category::find($this->category_id);
    }

    public function mount()
    {
        Session::forget('images');
        $this->receive_date = verta()->format('Y/m/d');
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
                'category_id' => $this->category_id,
                'status' => $this->status,
                'trait' => $this->trait,
                'dossier_id' => $this->dossier_id,
                'laboratory_id' => is_null(auth()->user()->laboratory_id) ? $this->laboratory_id : auth()->user()->laboratory_id,
                'primary_image' => $image_name,
                'description' => $this->description,
                'accessories' => $this->accessories,
                'code' => $this->code,
                'correspondence_number' => $this->correspondence_number,
                'correspondence_date' => $this->correspondence_date,
                'delivery_code' => $this->delivery_code,
                'delivery_name' => $this->delivery_name,
                'receiver_name' => "-",
                'receiver_code' => "-",
                'report' => "-",
                'delivery_staff_id' => 0,
                'receiver_staff_id' => auth()->user()->id,
                'delivery_date' => "-",
                'receive_date' => $this->receive_date,
                'is_active' => !$this->is_active,
                'is_archive' => 0,
            ]);

            if (count($this->attribute_values) > 0) {
                $attributesValue = [];
                foreach ($this->attribute_values as $key => $value) {
                    $attributesValue[] = ['attribute_id' => $key, 'value' => $value];
                }
                $device->attributes()->createMany($attributesValue);
            }
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

//        $this->device = $device;
        flash()->addSuccess('شواهد مورد نظر دریافت شد');
        return redirect()->route('admin.devices.index')->with('print_device', $device->id);
    }

    public function render()
    {
        $dossiers = Dossier::when(isset(auth()->user()->laboratory_id), function ($query) {
            $query->where('laboratory_id', auth()->user()->laboratory_id);
        })->get();
        $categories = Category::all();
        return view('livewire.admin.devices.create-device', compact('dossiers', 'categories'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}



