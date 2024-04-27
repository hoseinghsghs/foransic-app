<?php

namespace App\Livewire\Admin\Settings;

use App\Http\Controllers\Admin\ImageController;
use App\Models\Setting as ModelsSetting;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Setting extends Component
{
    use WithFileUploads;

    public $site_name;
    public $device_names;
    public $logo;
    public $logo_url;

//    protected $listeners = ['privacyChanged', 'rulesChanged', 'keywordsChanged'];
    protected $rules = [
        'site_name' => 'nullable|string',
//        'device_names' => 'nullable|string',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];

    protected $validationAttributes = [
        'device_names' => 'نام شواهد دیجیتال'
    ];

    public function mount()
    {
        $settings = ModelsSetting::findOrNew(1);
        $this->site_name = $settings->site_name;

        $this->device_names = $settings->device_names;

        $this->logo_url = $settings->logo;
    }

    public function save()
    {
        $data = $this->validate();
        if ($this->logo) {
            Storage::deleteDirectory('logo');
            $image_controller = new ImageController();
            $image_name = $image_controller->UploadeImage($this->logo, "logo", 96, 340);
            $data['logo'] = $image_name;
        } else {
            unset($data['logo']);
        }
        ModelsSetting::updateOrCreate(['id' => 1], $data);


        toastr()->rtl()->addSuccess('تغییرات با موفقیت ذخیره شد',' ');
        return redirect()->route('admin.settings.show');
    }

    public function render()
    {
        return view('livewire.admin.settings.setting')->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
