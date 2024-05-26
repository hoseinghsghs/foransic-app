<?php

namespace App\Livewire\Admin\Laboratories;

use App\Models\Laboratory;
use Livewire\Component;

class LaboratoryControll extends Component
{
    protected $paginationTheme = 'bootstrap';
    public $name;
    public $province = "";
    public $place = "";
    public $internal_number = "";
    public $permanent_personnel_count = "";
    public $temporary_personnel_count = "";
    public $laptop_count = "";
    public $tablet_count = "";
    public $version_ufed_for_pc = "";
    public $version_ufed_analyzer = "";
    public $version_oxygen = "";
    public $version_axiom = "";
    public $version_final_mobile = "";
    public $description = "";
    public Laboratory $laboratory;
    public $is_edit = false;
    public $display;

    public function ref()
    {
        $this->is_edit = false;
        $this->reset("name");
        $this->reset("display");
        $this->resetValidation();
    }

    public function add_laboratory()
    {
        if ($this->is_edit) {
            $this->authorize('laboratories-edit');

            $this->validate([
                'name' => 'required|unique:laboratories,name,' . $this->laboratory->id,
                'laboratory.id' => 'required|exists:laboratories,id',
            ]);

            $this->laboratory->update(["name" => $this->name,
                "province" => $this->province,
                "place" => $this->place,
                "internal_number" => $this->internal_number,
                "permanent_personnel_count" => $this->permanent_personnel_count,
                "temporary_personnel_count" => $this->temporary_personnel_count,
                "laptop_count" => $this->laptop_count,
                "tablet_count" => $this->tablet_count,
                "version_ufed_for_pc" => $this->version_ufed_for_pc,
                "version_ufed_analyzer" => $this->version_ufed_analyzer,
                "version_oxygen" => $this->version_oxygen,
                "version_axiom" => $this->version_axiom,
                "version_final_mobile" => $this->version_final_mobile,
                "description" => $this->description,
            ]);

            $this->is_edit = false;
            $this->reset("name");
            $this->reset("province");
            $this->reset("place");
            $this->reset("internal_number");
            $this->reset("permanent_personnel_count");
            $this->reset("temporary_personnel_count");
            $this->reset("laptop_count");
            $this->reset("tablet_count");
            $this->reset("version_ufed_for_pc");
            $this->reset("version_ufed_analyzer");
            $this->reset("version_oxygen");
            $this->reset("version_axiom");
            $this->reset("version_final_mobile");
            $this->reset("description");
            $this->reset("display");
            toastr()->rtl()->addSuccess('تغییرات با موفقیت ذخیره شد', ' ');
        } else {
            $this->authorize('laboratories-create');

            $this->validate([
                'name' => 'required|unique:laboratories,name'
            ]);
            Laboratory::create([
                "name" => $this->name,
                "province" => $this->province,
                "place" => $this->place,
                "internal_number" => $this->internal_number,
                "permanent_personnel_count" => $this->permanent_personnel_count,
                "temporary_personnel_count" => $this->temporary_personnel_count,
                "laptop_count" => $this->laptop_count,
                "tablet_count" => $this->tablet_count,
                "version_ufed_for_pc" => $this->version_ufed_for_pc,
                "version_ufed_analyzer" => $this->version_ufed_analyzer,
                "version_oxygen" => $this->version_oxygen,
                "version_axiom" => $this->version_axiom,
                "version_final_mobile" => $this->version_final_mobile,
                "description" => $this->description,
            ]);
            $this->reset("name");
            toastr()->rtl()->addSuccess('آزمایشگاه با موفقیت ایجاد شد', ' ');
        }
    }

    public function edit_laboratory(Laboratory $laboratory)
    {
        $this->authorize('laboratories-edit');

        $this->is_edit = true;
        $this->name = $laboratory->name;
        $this->province = $laboratory->province;
        $this->place = $laboratory->place;
        $this->internal_number = $laboratory->internal_number;
        $this->permanent_personnel_count = $laboratory->permanent_personnel_count;
        $this->temporary_personnel_count = $laboratory->temporary_personnel_count;
        $this->laptop_count = $laboratory->laptop_count;
        $this->tablet_count = $laboratory->tablet_count;
        $this->version_ufed_for_pc = $laboratory->version_ufed_for_pc;
        $this->version_ufed_analyzer = $laboratory->version_ufed_analyzer;
        $this->version_oxygen = $laboratory->version_oxygen;
        $this->version_axiom = $laboratory->version_axiom;
        $this->version_final_mobile = $laboratory->version_final_mobile;
        $this->description = $laboratory->description;
        $this->laboratory = $laboratory;
        $this->display = "disabled";
    }

    /*public function del_laboratory(Laboratory $laboratory)
    {
        $this->authorize('laboratories-delete');

        $laboratory->delete();
        toastr()->rtl()->addSuccess('دسته بندی با موفقیت حذف شد');

    }*/

    public function render()
    {
        return view('livewire.admin.laboratories.laboratory-controll', ['laboratories' => Laboratory::latest()->paginate(10)])->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
