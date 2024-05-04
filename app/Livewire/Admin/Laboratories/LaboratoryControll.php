<?php
namespace App\Livewire\Admin\Laboratories;
use App\Models\Laboratory;
use Livewire\Component;

class LaboratoryControll extends Component
{
    protected $paginationTheme = 'bootstrap';
    public $name;
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
            $this->validate([
                'name' => 'required|unique:laboratories,name,' . $this->laboratory->id,
                'laboratory.id' => 'required|exists:laboratories,id',
            ]);

            $this->laboratory->update([
                'name' => $this->name,
            ]);

            $this->is_edit = false;
            $this->reset("name");
            $this->reset("display");
            toastr()->rtl()->addSuccess('تغییرات با موفقیت ذخیره شد',' ');
        } else {
            $this->validate([
                'name' => 'required|unique:laboratories,name'
            ]);
            Laboratory::create([
                "name" => $this->name,
            ]);
            $this->reset("name");
            toastr()->rtl()->addSuccess('آزمایشگاه با موفقیت ایجاد شد',' ');
        }
    }

    public function edit_laboratory(Laboratory $laboratory)
    {
        $this->is_edit = true;
        $this->name = $laboratory->name;
        $this->laboratory = $laboratory;
        $this->display = "disabled";
    }

    public function del_laboratory(Laboratory $laboratory)
    {

            $laboratory->delete();
            toastr()->rtl()->addSuccess('دسته بندی با موفقیت حذف شد');

    }

    public function render()
    {
        return view('livewire.admin.laboratories.laboratory-controll', ['laboratorys' => Laboratory::latest()->paginate(10)])->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
