<?php

namespace App\Livewire\Admin\Devices;

use App\Http\Controllers\Admin\ImageController;
use App\Models\Device;
use App\Models\Dossier;
use App\Models\Category;
use App\Models\DeviceImage;
use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
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
    public $parent_id = "0";
    public $attribute_values = [];
    public string $code = '';
    public string $trait = '';
    public string $correspondence_number = '';
    public string $reply_correspondence_number = '';
    public string $reply_correspondence_date = '';
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
        /*
         just allow dossiers that has same lab for personnel and dossiers that company users that create by themselves
        */
        $dossiers = Dossier::when(isset(auth()->user()->laboratory_id), function ($query) {
            $query->where('laboratory_id', auth()->user()->laboratory_id);
        })->when(auth()->user()->hasRole('company'), function (Builder $query) {
            $query->where('user_category_id', auth()->user()->id);
        })->get()->pluck('id')->toArray();

        return [
            'category_id' => 'required|integer|exists:categories,id',
            'parent_id' => 'required|integer',
            'attribute_values' => $this->category_id && $this->category->attributes()->exists() ? 'array:' . $this->category->attributes()->pluck('attributes.id')->implode(',') : 'array',
            'status' => 'required|integer',
            'dossier_id' => ['required', 'integer', Rule::in($dossiers)],
            'laboratory_id' => ['integer', 'nullable', 'exists:laboratories,id', Rule::requiredIf(is_null(auth()->user()->laboratory_id))],
            'description' => 'nullable|string',
            'accessories' => 'nullable|string',
            'code' => 'required|string',
            'delivery_code' => 'nullable|string',
            'trait' => 'nullable|string',
            'correspondence_number' => 'nullable|string',
            'reply_correspondence_number' => 'nullable|string',
            'correspondence_date' => 'nullable|string',
            'reply_correspondence_date' => 'nullable|string',
            'receive_date' => 'nullable|string',
            'delivery_name' => 'required|string',
            'primary_image' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:10000',
        ];
    }

    public function getCategoryProperty()
    {
        return Category::find($this->category_id);
    }

    public function mount()
    {
//        $this->dossier_id = Session::get('dossier');
        Session::forget('images');
//        $this->receive_date = verta()->format('Y/m/d H:i');
    }

    public function create($type_redirect = '1')
    {
        $this->validate();

        try {
            DB::beginTransaction();
            if ($this->primary_image) {
                $ImageController = new ImageController();
                $image_name = $ImageController->UploadeImage($this->primary_image, "primary_image", 900, 800);
                if (!$image_name)
                    $this->addError('primary_image', 'مشکل در ذخیره سازی عکس');
            } else {
                $image_name = null;
            }
            if (!$this->parent_id == "0") {
                if (!Device::where('id', $this->parent_id)->where('dossier_id', $this->dossier_id)->exists()) {
                    flash()->addWarning('فقط شواهد در این پرونده قابل انتخاب هستند');
                    return redirect()->back();
                }
            }
            $device = Device::create([
                'category_id' => $this->category_id,
                'parent_id' => $this->parent_id,
                'status' => $this->status,
                'trait' => $this->trait,
                'dossier_id' => $this->dossier_id,
                'laboratory_id' => auth()->user()->laboratory_id ?? $this->laboratory_id,
                'primary_image' => $image_name,
                'description' => $this->description,
                'accessories' => $this->accessories,
                'code' => $this->code,
                'correspondence_number' => $this->correspondence_number,
                'reply_correspondence_number' => $this->reply_correspondence_number,
                'correspondence_date' => $this->correspondence_date,
                'reply_correspondence_date' => $this->reply_correspondence_date,
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

            Event::create(['title' => 'شاهد جدید ایجاد شد' . ' ' . ' | ' . ' ' . ' آزمایشگاه : ' . $device->laboratory->name,
                'body' => 'ID شاهد ' . " : " . $device->id . " | " . 'آیدی کاربر' . " : " . auth()->user()->id . "-" . auth()->user()->name . " | " . 'نام شاهد : ' . $device->category->title,
                'user_id' => auth()->user()->id,
                'eventable_id' => $device->id,
                'eventable_type' => Device::class,
            ]);

            DB::commit();
        } catch (\Exception $ex) {
            flash()->addError($ex->getMessage());
            DB::rollBack();
            return redirect()->back();
        }
        Session::forget('images');

        flash()->addSuccess('شواهد مورد نظر دریافت شد');

        if ($type_redirect == '2')
            return redirect()->route('admin.devices.create')->with('print_device', $device->id);
        elseif ($type_redirect == '3')
            return redirect()->route('admin.dossiers.show', $device->dossier->id)->with('print_device', $device->id);
        else
            return redirect()->route('admin.devices.index')->with('print_device', $device->id);
    }

    public function getLabs()
    {
        $laboratories=Dossier::find($this->dossier_id)->laboratories()->get();
        $res=[['id'=>'','text'=>'']];
        foreach ($laboratories as $laboratory) {
           $res[]=['id'=>$laboratory->id,'text'=>$laboratory->name];
        }
        return json_encode($res);
    }
    public function render()
    {
        $dossiers = Dossier::when(isset(auth()->user()->laboratory_id), function ($query) {
            $query->where('laboratory_id', auth()->user()->laboratory_id);
        })->when(auth()->user()->hasRole('company'), function (Builder $query) {
            $query->where('user_category_id', auth()->user()->id);
        })->get();
        $categories = Category::all();
        $parent_devices = Device::where('parent_id', 0)->get();
        $laboratories=[];
        if (is_null(auth()->user()->laboratory_id) && !is_null($this->dossier_id))
            $laboratories=Dossier::find($this->dossier_id)->laboratories()->get();
        return view('livewire.admin.devices.create-device', compact('dossiers', 'categories', 'parent_devices','laboratories'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}



