<?php

namespace App\Livewire\Admin\Dossiers;

use App\Http\Controllers\Admin\ImageController;
use App\Models\Dossier;
use App\Models\Section;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateDossier extends Component
{
    use WithFileUploads;

    public Dossier $dossier;
    public string $name = '';
    public string $number_dossier = '';
    public string $subject = '';
    public string $section_id = '';
    public string $zone_id = '';
    public string $expert = '';
    public $user_category_id;
    public int|null $laboratory_id;
    public bool $is_active = false;
    public string $summary_description = '';
    public string $Judicial_number = '';
    public $Judicial_image = '';
    public string $Judicial_date = '';
    public string $dossier_type = '0';
    public string $dossier_case = '';
    public string $expert_phone = '';
    public string $expert_cellphone = '';

    protected $listeners = [
        'sweetalertConfirmed',// only when confirm button is clicked
        'sweetalertDenied'
    ];

    public function rules(): array
    {
        // get users from same laboratory that has company role
        $users = User::role('company')->get()->pluck('id')->toArray();

        return [
            'name' => 'required|string|max:100',
            'user_category_id' => ['required','integer',Rule::in($users)],
            'laboratory_id' => ['integer','nullable','exists:laboratories,id', Rule::requiredIf(is_null(auth()->user()->laboratory_id))],
            'subject' => 'required|string',
            'expert' => 'required|string',
            'section_id' => 'required|string',
            'zone_id' => 'required|string',
            'number_dossier' => 'required|string|unique:dossiers,number_dossier',
            'summary_description' => 'required|string',
            'Judicial_date' => 'nullable|string',
            'Judicial_number' => 'nullable|string',
            'dossier_case' => 'required|string',
            'dossier_type' => 'required|string',
            'expert_phone' => 'required|string',
            'expert_cellphone' => 'required|string',
        ];
    }

    public function create($type_redirect)
    {
        $this->validate();
        try {

            DB::beginTransaction();
            if ($this->Judicial_image) {
                $ImageController = new ImageController();

                $image_name = $ImageController->UploadeImage($this->Judicial_image, "Judicial-image", 900, 800);

            } else {
                $image_name = null;
                $this->addError('Judicial_image', 'مشکل در ذخیره سازی عکس');
            }
            $device = Dossier::create([
                'name' => $this->name,
                'user_category_id' => $this->user_category_id,
                'personal_creator_id' => auth()->user()->id,
                'laboratory_id' => is_null(auth()->user()->laboratory_id) ? $this->laboratory_id : auth()->user()->laboratory_id,
                'section_id' => $this->section_id,
                'zone_id' => $this->zone_id,
                'subject' => $this->subject,
                'expert' => $this->expert,
                'number_dossier' => $this->number_dossier,
                'summary_description' => $this->summary_description,
                'Judicial_date' => $this->Judicial_date,
                'dossier_type' => $this->dossier_type,
                'dossier_case' => $this->dossier_case,
                'expert_phone' => $this->expert_phone,
                'expert_cellphone' => $this->expert_cellphone,
                'Judicial_number' => $this->Judicial_number,
                'Judicial_image' => $image_name,
                'is_active' => !$this->is_active,
                'is_archive' => 0,
            ]);

            DB::commit();
        } catch (\Exception $ex) {
            toastr()->rtl(true)->persistent()->closeButton()->addError('خطا', $ex->getMessage());
            DB::rollBack();
            return redirect()->back();
        }

        toastr()->rtl()->addSuccess('پرونده مورد نظر دریافت شد', ' ');
        if ($type_redirect == 1) {
            return redirect()->route('admin.dossiers.index');
        } else {
            return redirect()->route('admin.dossiers.show', $device->id);
        }
    }

    public function render()
    {
        // get users from same laboratory that has company role
        $users = User::role('company')->get();
        $sections = Section::all();
        $zones = Zone::all();

        return view('livewire.admin.dossiers.create-dossier', compact('users', 'sections', 'zones'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}



