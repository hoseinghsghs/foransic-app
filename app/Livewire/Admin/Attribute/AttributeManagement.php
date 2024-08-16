<?php

namespace App\Livewire\Admin\Attribute;

use App\Models\Attribute;
use Livewire\Component;
use Livewire\WithPagination;

class AttributeManagement extends Component
{
    use WithPagination;


    protected $paginationTheme = 'bootstrap';
    public $name;
    public $def_values;
    public $def_value;
    public Attribute $attribute;
    public $is_edit = false;
    public $display;

    public function ref()
    {
        $this->is_edit = false;
        $this->reset("name");
        $this->reset("display");
        $this->reset('def_values');
        $this->reset('def_value');
        $this->resetValidation();
    }

    public function addDef_values()
    {
        $this->validate([
            'def_value' => 'required',
        ]);
        $this->def_values[] = $this->def_value;
        $this->reset('def_value');
    }

    public function removeDef_values($index)
    {
        array_splice($this->def_values, $index, 1);
    }

    public function add_attribute()
    {
        if ($this->is_edit) {
            $this->authorize('attributes-edit');

            $this->validate(['def_values' => 'nullable|array',
                'def_values.*' => 'nullable',
                'name' => 'required|unique:attributes,name,' . $this->attribute->id,
                'attribute.id' => 'required|exists:attributes,id',
            ]);

            $this->def_values = json_encode($this->def_values);

            $this->attribute->update([
                'name' => $this->name,
                'def_values' => $this->def_values,
            ]);

            $this->is_edit = false;
            $this->ref();

            toastr()->rtl()->addSuccess('تغییرات با موفقیت ذخیره شد',' ');
        } else {
            $this->authorize('attributes-create');

            $this->validate(['name' => 'required|unique:attributes,name',
                'def_values' => 'nullable|array',
                'def_values.*' => 'nullable',
            ]);
            $this->def_values = json_encode($this->def_values);

            Attribute::create([
                "name" => $this->name,
                'def_values' => $this->def_values,

            ]);
            $this->ref();
            toastr()->rtl()->addSuccess('ویژگی با موفقیت ایجاد شد',' ');
        }
    }

    public function edit_attribute(Attribute $attribute)
    {
        $this->authorize('attributes-edit');
        $this->def_values = json_decode($attribute->def_values, true);
        $this->is_edit = true;
        $this->name = $attribute->name;
        $this->attribute = $attribute;
        $this->display = "disabled";
    }

    public function del_attribute(Attribute $attribute)
    {
        $this->authorize('attributes-delete');

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
