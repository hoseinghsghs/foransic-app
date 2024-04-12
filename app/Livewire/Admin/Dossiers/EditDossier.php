<?php

namespace App\Livewire\Admin\Dossiers;
use App\Http\Controllers\Admin\ImageController;
use App\Models\Dossier;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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

    protected $listeners = [
        'sweetalertConfirmed',// only when confirm button is clicked
        'sweetalertDenied'
    ];


    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'user_category_id'=>'required',
            'subject' => 'required|string',
            'expert' => 'string',
            'section' => 'string',
            'number_dossier' => 'string',
            'summary_description' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'receiver_name.required_if' => 'نام تحویل گیرنده ضروری است.',
            'receiver_code.required_if' => 'کد تحویل گیرنده ضروری است.',
        ];
    }

    public function mount()
    {
        $this->name=$this->dossier->name;
        $this->user_category_id=$this->dossier->user_category_id;
        $this->section=$this->dossier->section;
        $this->subject=$this->dossier->subject;
        $this->expert=$this->dossier->expert;
        $this->number_dossier=$this->dossier->number_dossier;
        $this->summary_description=$this->dossier->summary_description;
        $this->is_active=!$this->dossier->is_active;
    }

    public function edit()
    {
        $this->validate();
           $this->dossier->update([
                'name' => $this->name,
                'user_category_id' => $this->user_category_id,
                'section' => $this->section,
                'subject' => $this->subject,
                'expert' => $this->expert,
                'number_dossier' => $this->number_dossier,
                'summary_description' => $this->summary_description,
                'is_active' => !$this->is_active,
                'is_archive' => 0,
            ]);
        toastr()->rtl(true)->addInfo('پرونده ویرایش شد',' ');
//        flash()->addSuccess('دستگاه / قطعه مورد نظر دریافت شد');
        return redirect()->route('admin.devices.index');
    }


       public function render()
    {
        $users = User::role('company')->get();
        return view('livewire.admin.dossiers.edit-dossier', compact('users'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}

