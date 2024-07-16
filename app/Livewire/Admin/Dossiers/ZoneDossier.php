<?php

namespace App\Livewire\Admin\Dossiers;

use App\Models\Zone;
use Livewire\Component;
use Livewire\WithPagination;

class ZoneDossier extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $title;
    public $country;
    public Zone $zone;
    public $is_edit = false;
    public $display;

    public function ref()
    {

        $this->is_edit = false;
        $this->reset("title");
        $this->reset("country");
        $this->reset("display");
        $this->resetValidation();
    }

    public function add_zone()
    {
        if ($this->is_edit) {
            $this->authorize('zone-edit');

            $this->validate([
                'title' => 'required|unique:zones,title,' . $this->zone->id,
                'country' => 'string',
            ]);

            $this->zone->update([
                'title' => $this->title,
                'country' => $this->country,
            ]);

            $this->is_edit = false;
            $this->reset("title");
            $this->reset("country");
            $this->reset("display");
            toastr()->rtl()->addSuccess('تغییرات با موفقیت ذخیره شد', ' ');
        } else {
            $this->authorize('zone-create');

            $this->validate([
                'title' => 'required|unique:zones,title',
                'country' => 'string'
            ]);
            Zone::create([
                "title" => $this->title,
                "country" => $this->country,
            ]);
            $this->reset("title");
            $this->reset("country");
            toastr()->rtl()->addSuccess('ویژگی با موفقیت ایجاد شد', ' ');
        }
    }

    public function edit_zone(Zone $zone)
    {
        $this->authorize('zone-edit');

        $this->is_edit = true;
        $this->title = $zone->title;
        $this->country = $zone->country;
        $this->zone = $zone;
        $this->display = "disabled";
    }

    public function del_zone(Zone $zone)
    {
        $this->authorize('zone-delete');

        if ($zone->dossiers()->exists()) {
            flash()->addWarning('به علت الحاق معاونت به پرونده امکان حذف آن وجود ندارد');
        } else {
            $zone->delete();
            flash()->addSuccess(' معاونت با موفقیت حذف شد');
        }
    }

    public function render()
    {
        $zones = Zone::latest()->paginate(10);

        return view('livewire.admin.dossiers.zone-dossier', compact(['zones']))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
