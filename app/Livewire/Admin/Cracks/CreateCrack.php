<?php

namespace App\Livewire\Admin\Cracks;

use App\Http\Controllers\Admin\AttachmentsController;
use App\Http\Controllers\Admin\ImageController;
use App\Models\Crack;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class CreateCrack extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public Crack $crack;
    public $title;
    public $program_version;
    public $hardware_code;
    public $license_file;
    public $user_id;
    public $laboratory_id;
    public $description_personal;
    public $description_admin;
    public $is_edit = false;
    public $display;

    public function ref()
    {
        $this->is_edit = false;
        $this->reset("title");
        $this->reset("program_version");
        $this->reset("hardware_code");
        $this->reset("license_file");
        $this->reset("description_personal");
        $this->reset("description_admin");
        $this->reset("display");
        $this->reset("crack");
        $this->dispatch('resetfile');
        $this->resetValidation();
    }

    public function add_crack()
    {
        if ($this->is_edit) {

            $this->authorize('cracks-create');
            if ($this->license_file != null) {
                $AttachmentsController = new AttachmentsController();
                $license_file_name = $AttachmentsController->uploadAttachment($this->license_file, "license_files");
            } else {
                $license_file_name = $this->crack->license_file;
            }

            $data = $this->validate([
                'title' => 'required|string',
                'program_version' => 'required|string',
                'hardware_code' => 'required|string',
                'license_file' => 'nullable|file|mimes:docx,xlsx,pdf,csv,zip,rar',
                'description_personal' => 'nullable|string|max:128',
                'description_admin' => 'nullable|string|max:128',
            ]);

            $data['license_file'] = $license_file_name;
            if (!auth()->user()->hasRole('Super Admin'))
                array_except($data, ['license_file', 'description_admin']);
            if ($data['license_file']) {
                $data['is_seen'] = 1;
            }

            $this->crack->update($data);
            $this->ref();
            flash()->addSuccess('تغییرات با موفقیت ذخیره شد');
        } else {
            $this->authorize('cracks-create');

            $this->validate([
                'title' => 'required|string',
                'program_version' => 'required|string',
                'hardware_code' => 'required|string',
                'license_file' => 'nullable|file|mimes:docx,xlsx,pdf,csv,zip,rar',
                'description_personal' => 'nullable|string|max:128',
                'description_admin' => 'nullable|string|max:128',

            ]);
            if ($this->license_file != null) {
                $AttachmentsController = new AttachmentsController();
                $license_file_name = $AttachmentsController->uploadAttachment($this->license_file, "license_files");
            } elseif (isset($this->crack->license_file)) {
                $license_file_name = $this->crack->license_file;
            } else {
                $license_file_name = null;
            }
            Crack::create([
                "title" => $this->title,
                "program_version" => $this->program_version,
                "hardware_code" => $this->hardware_code,
                "license_file" => $license_file_name,
                "description_personal" => $this->description_personal,
                "description_admin" => $this->description_admin,
                "user_id" => auth()->user()->id,
                "laboratory_id" => auth()->user()->laboratory_id,
            ]);
            $this->ref();
            flash()->addSuccess('درخواست با موفقیت ایجاد شد');
        }
    }

    public function edit_crack(Crack $crack)
    {
        $this->authorize('cracks-create');
        $this->crack = $crack;
        $this->is_edit = true;
        $this->title = $crack->title;
        $this->program_version = $crack->program_version;
        $this->hardware_code = $crack->hardware_code;
        $this->description_personal = $crack->description_personal;
        $this->description_admin = $crack->description_admin;
        $this->display = "disabled";
    }


    public function render()
    {
        $cracks = Crack::latest()->when(!auth()->user()->hasRole('Super Admin'), function ($query) {
            $query->where("user_id", auth()->user()->id);
        })->paginate(10);
        return view('livewire.admin.cracks.create-crack', compact('cracks'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
