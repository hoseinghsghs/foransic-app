<?php

namespace App\Livewire\Admin\Devices;

use App\Models\Device;
use App\Models\User;
use App\Models\Dossier;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Http\Controllers\Admin\AttachmentsController;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Verta;

class EditDevice extends Component
{
    use WithFileUploads;

    public Device $device;
    public string $category_id;
    public $parent_id;
    public $attribute_values = [];
    public string $code = '';
    public string $trait = '';
    public string $correspondence_number = '';
    public string $correspondence_date = '';
    public string|null $reply_correspondence_number = '';
    public string|null $reply_correspondence_date = '';
    public string $receive_date = '';
    public $dossier_id;
    public string $delivery_code = '';
    public string $delivery_name = '';
    public string $delivery_date = '';
    public string $receiver_name = '';
    public string $receiver_code = '';
    public string $status = 'پیش فرض';
    public string $description = '';
    public string $accessories = '';
    public $primary_image;
    public $attachment_report;
    public string $report = '';
    public bool $is_active = false;

    public function rules(): array
    {
        // get dossiers in same laboratory
        $dossiers = Dossier::when(isset(auth()->user()->laboratory_id), function ($query) {
            $query->where('laboratory_id', auth()->user()->laboratory_id);
        })->when(auth()->user()->hasRole('company'),function (Builder $query){
            $query->where('user_category_id',auth()->user()->id);
        })->get()->pluck('id')->toArray();

        return [
            'category_id' => 'required|integer',
            'parent_id' => 'required|integer',
            'attribute_values' => $this->category_id && $this->category->attributes()->exists() ? 'array:' . $this->category->attributes()->pluck('attributes.id')->implode(',') : 'array',
            'status' => 'required|integer',
            'dossier_id' => ['required', 'integer', Rule::in($dossiers)],
            'description' => 'nullable|string',
            'report' => 'nullable|string',
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

    public function getCategoryProperty()
    {
        return Category::find($this->category_id);
    }

    public function updatedCategoryId()
    {
        $this->attribute_values = [];
    }

    public function mount()
    {
        $this->authorize('is-same-laboratory', $this->device->laboratory_id);

        $this->category_id = $this->device->category_id;
        $this->parent_id = $this->device->parent_id;
        $this->code = $this->device->code;
        $this->trait = $this->device->trait;
        $this->report = $this->device->report;
        $this->dossier_id = $this->device->dossier_id;
        $this->status = $this->device->status;
        $this->correspondence_number = $this->device->correspondence_number;
        $this->reply_correspondence_number = $this->device->reply_correspondence_number;
        $this->correspondence_date = $this->device->correspondence_date;
        $this->reply_correspondence_date = $this->device->reply_correspondence_date;
        $this->delivery_name = $this->device->delivery_name;
        $this->delivery_code = $this->device->delivery_code;
        $this->delivery_date=$this->device->delivery_date;
        $this->receiver_name = $this->device->receiver_name;
        $this->receiver_code = $this->device->receiver_code;
        $this->receive_date = $this->device->receive_date;
        $this->is_active = !$this->device->is_active;
        $this->accessories = $this->device->accessories;
        $this->description = $this->device->description;
        //device attributes
        foreach ($this->device->attributes as $attribute) {
            $this->attribute_values[$attribute->attribute_id] = $attribute->value;
        }
    }

    public function edit()
    {
        $this->validate();
        try {
            DB::beginTransaction();
            if ($this->attachment_report != null) {
                $AttachmentsController = new AttachmentsController();
                $attachment_report_name = $AttachmentsController->uploadAttachment($this->attachment_report, "attachment_report");
            } else {
                $attachment_report_name = $this->device->attachment_report;
            }
            $parent_devices = Device::where('parent_id', $this->device->id);
            // dd($parent_devices->where('dossier_id', $this->dossier_id)->exists());
            if (!$this->parent_id == "0") {
                if (!Device::where('id', $this->parent_id)->where('dossier_id', $this->dossier_id)->exists()) {
                    flash()->addWarning('فقط شواهد در این پرونده قابل انتخاب هستند');
                    return redirect()->back();
                }
            } else {
                // dd($parent_devices->where('dossier_id', $this->dossier_id)->exists());
                // if (!$parent_devices->where('dossier_id', $this->dossier_id)->exists()) {
                //     flash()->addWarning('شواهدی که با این شاهد مرتبط شده اند در پرونده دیگری قرار دارند');
                //     return redirect()->back();
                // }
            }
            if ($this->parent_id == $this->device->id) {
                flash()->addWarning('ارتباط شاهد با خودش امکان پذیر نیست');
                return redirect()->back();
            }
            if ($this->device->parent_id == 0 && $parent_devices->exists() && $this->parent_id != 0) {
                flash()->addWarning('شواهدی با این شاهد مرتبط شده اند امکان تغییر وجود ندارد');
                return redirect()->back();
            }



            // if (!$this->device->where('dossier_id', $this->dossier_id)->exists()) {
            //     flash()->addWarning('فقط شواهد در این پرونده قابل انتخاب هستند');
            //     return redirect()->back();
            // }

            $this->device->update([
                'category_id' => $this->category_id,
                'parent_id' => $this->parent_id,
                'status' => $this->status,
                'description' => $this->description,
                'accessories' => $this->accessories,
                'trait' => $this->trait,
                'report' => $this->report,
                'attachment_report' => $attachment_report_name,
                'dossier_id' => $this->dossier_id,
                'code' => $this->code,
                'correspondence_number' => $this->correspondence_number,
                'reply_correspondence_number' => $this->reply_correspondence_number,
                'correspondence_date' => $this->correspondence_date,
                'reply_correspondence_date' => $this->reply_correspondence_date,
                'receive_date' => $this->receive_date,
                'delivery_code' => $this->delivery_code,
                'delivery_name' => $this->delivery_name,
                'receiver_name' => $this->receiver_name,
                'receiver_code' => $this->receiver_code,
                'delivery_staff_id' => auth()->user()->id,
                'delivery_date' => $this->delivery_date,
                'is_active' => !$this->is_active,
            ]);
            // update device attributes value
            $this->device->attributes()->delete();
            $this->attribute_values = array_filter($this->attribute_values, function ($value) {
                return !empty($value);
            });
            if (count($this->attribute_values) > 0) {
                $attributesValue = [];
                foreach ($this->attribute_values as $key => $value) {
                    $attributesValue[] = ['attribute_id' => $key, 'value' => $value];
                }
                $this->device->attributes()->createMany($attributesValue);
            }
            Event::create([
                'title' => 'شاهد  ویرایش شد ' . ' ' . ' | ' . ' ' . ' آزمایشگاه : ' . $this->device->laboratory->name,
                'body' => 'ID شاهد ' . " : " . $this->device->id . " | " . 'آیدی کاربر' . " : " . auth()->user()->id . "-" . auth()->user()->name   . " | " . 'نام شاهد : ' . $this->device->category->title,
                'user_id' => auth()->user()->id,
                'eventable_id' => $this->device->id,
                'eventable_type' => Device::class,
            ]);
            DB::commit();
        } catch (\Exception $ex) {
            flash()->addError($ex->getMessage());
            DB::rollBack();
            return redirect()->back();
        }
        flash()->addSuccess('شاهد مورد نظر ویرایش شد');
        // return redirect()->route('admin.devices.index');
    }

    public function printReport()
    {
        return redirect()->route('admin.print.print-report', [$this->device->id]);
    }

    public function render()
    {
        // get dossiers that were in same laboratory
        $dossiers = Dossier::when(isset(auth()->user()->laboratory_id), function ($query) {
            $query->where('laboratory_id', auth()->user()->laboratory_id);
        })->when(auth()->user()->hasRole('company'),function (Builder $query){
            $query->where('user_category_id',auth()->user()->id);
        })->get();
        $categories = Category::all();
        $parent_devices = Device::where('parent_id', 0)->get();
        return view('livewire.admin.devices.edit-device', compact('dossiers', 'categories', 'parent_devices'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}

