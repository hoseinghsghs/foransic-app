<?php

namespace App\Livewire\Admin\Attribute;

use App\Models\Attribute;
use Livewire\Component;

class AttributeManagement extends Component
{
    protected $paginationTheme = 'bootstrap';
    public $name;
    public Attribute $attribute;
    public $is_edit = false;
    public $display;

    public function ref()
    {
        $this->is_edit = false;
        $this->reset("name");
        $this->reset("display");
        $this->resetValidation();
    }

    public function add_attribute()
    {
        if ($this->is_edit) {
            $this->validate([
                'name' => 'required|unique:attributes,name,' . $this->attribute->id,
                'attribute.id' => 'required|exists:attributes,id',
            ]);

            $this->attribute->update([
                'name' => $this->name,
            ]);

            $this->is_edit = false;
            $this->reset("name");
            $this->reset("display");
            toastr()->rtl()->addSuccess('تغییرات با موفقیت ذخیره شد',' ');
        } else {
            $this->validate([
                'name' => 'required|unique:attributes,name'
            ]);

            Attribute::create([
                "name" => $this->name,
            ]);
            $this->reset("name");
            toastr()->rtl()->addSuccess('ویژگی با موفقیت ایجاد شد',' ');
        }
    }

    public function edit_attribute(Attribute $attribute)
    {
        $this->is_edit = true;
        $this->name = $attribute->name;
        $this->attribute = $attribute;
        $this->display = "disabled";
    }

    public function del_attribute(Attribute $attribute)
    {
        if ($attribute->categories()->exists() || $attribute->attributeValues()->exists()){
            toastr()->rtl()->addWarning('به علت الحاق ویژگی به دسته بندی امکان حذف آن وجود ندارد');
        }else{
            $attribute->delete();
            toastr()->rtl()->addSuccess('ویژگی با موفقیت حذف شد');
        }
    }

    public function render()
    {
        return view('livewire.admin.attribute.attribute-management', ['attributes' => Attribute::latest()->paginate(10)])->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
