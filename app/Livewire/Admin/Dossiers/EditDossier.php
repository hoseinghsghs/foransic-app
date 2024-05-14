<?php

namespace App\Livewire\Admin\Dossiers;

use App\Http\Controllers\Admin\ImageController;
use App\Models\Dossier;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Verta;

class EditDossier extends Component
{
    use WithFileUploads;


    public Dossier $dossier;
    public string $name = '';
    public string $number_dossier = '';
    public string $subject = '';
    public string $section = '';
    public string $expert = '';
    public $user_category_id;
    public bool $is_active = false;
    public bool $is_archive = false;
    public string $summary_description = '';
    public string $Judicial_number = '';
    public $Judicial_image;
    public $image_url = '';
    public string $Judicial_date = '';
    public string $dossier_type = '';
    public string $dossier_case = '';
    public string $expert_phone = '';
    public string $expert_cellphone = '';

    public function rules(): array
    {
        // get users that were in same laboratory
        $users = User::role('company')->when(isset($this->dossier->laboratory_id) || isset(auth()->user()->laboratory_id), function ($query) {
            if (isset($this->dossier->laboratory_id))
                $query->where('laboratory_id', $this->dossier->laboratory_id);
            else
                $query->where('laboratory_id', auth()->user()->laboratory_id);
        })->get()->pluck('id')->toArray();

        return [
            'name' => 'required|string|max:100',
            'user_category_id' => ['required', 'integer', Rule::in($users)],
            'subject' => 'required|string',
            'expert' => 'required|string',
            'section' => 'required|string',
            'number_dossier' => 'required|string|unique:dossiers,number_dossier,' . $this->dossier->id,
            'summary_description' => 'required|string',
            'Judicial_date' => 'nullable|string',
            'Judicial_number' => 'nullable|string',
            'dossier_case' => 'required|string',
            'dossier_type' => 'required|string',
            'expert_phone' => 'required|string',
            'expert_cellphone' => 'required|string',
        ];
    }

    public function mount()
    {
        $this->authorize('is-same-laboratory', $this->dossier->laboratory_id);
        $this->name = $this->dossier->name;
        $this->user_category_id = $this->dossier->user_category_id;
        $this->section = $this->dossier->section;
        $this->subject = $this->dossier->subject;
        $this->expert = $this->dossier->expert;
        $this->number_dossier = $this->dossier->number_dossier;
        $this->summary_description = $this->dossier->summary_description;
        $this->is_active = !$this->dossier->is_active;
        $this->Judicial_date = $this->dossier->Judicial_date;
        $this->dossier_type = $this->dossier->dossier_type;
        $this->dossier_case = $this->dossier->dossier_case;
        $this->expert_phone = $this->dossier->expert_phone;
        $this->expert_cellphone = $this->dossier->expert_cellphone;
        $this->Judicial_number = $this->dossier->Judicial_number;
        $this->image_url = $this->dossier->Judicial_image;
    }

    public function edit()
    {
        $this->validate();
        if ($this->Judicial_image) {
            $ImageController = new ImageController();
            $image_name = $ImageController->UploadeImage($this->Judicial_image, "Judicial-image", 900, 800);

            if (Storage::exists('Judicial-image/' . $this->dossier->Judicial_image)) {
                Storage::delete('Judicial-image/' . $this->dossier->Judicial_image);
            }

        } else {
            $image_name = $this->image_url;
            $this->addError('Judicial_image', 'مشکل در ذخیره سازی عکس');
        }

        $this->dossier->update([
            'name' => $this->name,
            'user_category_id' => $this->user_category_id,
            'personal_creator_id' => auth()->user()->id,
            'section' => $this->section,
            'subject' => $this->subject,
            'expert' => $this->expert,
            'number_dossier' => $this->number_dossier,
            'summary_description' => $this->summary_description,
            'is_active' => !$this->is_active,
            'is_archive' => 0,
            'Judicial_date' => $this->Judicial_date,
            'dossier_type' => $this->dossier_type,
            'dossier_case' => $this->dossier_case,
            'expert_phone' => $this->expert_phone,
            'expert_cellphone' => $this->expert_cellphone,
            'Judicial_number' => $this->Judicial_number,
            'Judicial_image' => $image_name,
        ]);
        toastr()->rtl(true)->addInfo('پرونده ویرایش شد', ' ');
//        flash()->addSuccess('شواهد دیجیتال مورد نظر دریافت شد');
        return redirect()->route('admin.dossiers.index');
    }


    public function render()
    {
        $users = User::role('company')->when(isset($this->dossier->laboratory_id) || isset(auth()->user()->laboratory_id), function ($query) {
            if (isset($this->dossier->laboratory_id))
                $query->where('laboratory_id', $this->dossier->laboratory_id);
            else
                $query->where('laboratory_id', auth()->user()->laboratory_id);
        })->get();
        return view('livewire.admin.dossiers.edit-dossier', compact('users'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}

