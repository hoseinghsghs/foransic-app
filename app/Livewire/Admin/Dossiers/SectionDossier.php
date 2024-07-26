<?php

namespace App\Livewire\Admin\Dossiers;

use App\Models\Section;
use Livewire\Component;
use Livewire\WithPagination;

class SectionDossier extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name;
    public $code;
    public Section $section;
    public $is_edit = false;
    public $display;

    public function ref()
    {

        $this->is_edit = false;
        $this->reset("name");
        $this->reset("code");
        $this->reset("display");
        $this->resetValidation();
    }

    public function add_section()
    {
        if ($this->is_edit) {
            $this->authorize('section-edit');

            $this->validate([
                'name' => 'required|unique:sections,name,' . $this->section->id,
                'code' => 'required|string',
            ]);

            $this->section->update([
                'name' => $this->name,
                'code' => $this->code,
            ]);

            $this->is_edit = false;
            $this->reset("name");
            $this->reset("code");
            $this->reset("display");
            toastr()->rtl()->addSuccess('تغییرات با موفقیت ذخیره شد', ' ');
        } else {
            $this->authorize('section-create');

            $this->validate([
                'name' => 'required|unique:sections,name',
                'code' => 'required|string'
            ]);
            Section::create([
                "name" => $this->name,
                "code" => $this->code,
            ]);
            $this->reset("name");
            $this->reset("code");
            toastr()->rtl()->addSuccess('ویژگی با موفقیت ایجاد شد', ' ');
        }
    }

    public function edit_section(Section $section)
    {
        $this->authorize('section-edit');

        $this->is_edit = true;
        $this->name = $section->name;
        $this->code = $section->code;
        $this->section = $section;
        $this->display = "disabled";
    }

    public function del_section(Section $section)
    {
        $this->authorize('section-delete');

        if ($section->dossiers()->exists()) {
            flash()->addWarning('به علت الحاق معاونت به پرونده امکان حذف آن وجود ندارد');
        } else {
            $section->delete();
            flash()->addSuccess(' معاونت با موفقیت حذف شد');
        }
    }

    public function render()
    {
        $sections = Section::latest()->paginate(10);
        return view('livewire.admin.dossiers.section-dossier', compact(['sections']))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
