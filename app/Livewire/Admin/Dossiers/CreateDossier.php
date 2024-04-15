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

class CreateDossier extends Component
{
    use WithFileUploads;

    public Dossier $dossier;
    public string $name = '';
    public string $number_dossier = '';
    public string $dossier_date='';
    public string $subject = '';
    public string $section = '';
    public string $expert = '';
    public $user_category_id;
    public bool $is_active = false;
    public string $summary_description = '';

    protected $listeners = [
        'sweetalertConfirmed',// only when confirm button is clicked
        'sweetalertDenied'
    ];

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'dossier_date' => 'required|integer',
            'user_category_id'=>'required',
            'subject' => 'required|string',
            'expert' => 'required|string',
            'section' => 'required|string',
            'number_dossier' => 'required|string',
            'summary_description' => 'required|string',
        ];
    }

    public function create()
    {
        $this->validate();
        try {

            DB::beginTransaction();

            $device = Dossier::create([
                'name' => $this->name,
                'user_category_id' => $this->user_category_id,
                'section' => $this->section,
                'subject' => $this->subject,
                'expert' => $this->expert,
                'number_dossier' => $this->number_dossier,
                'dossier_date'=>$this->dossier_date,
                'summary_description' => $this->summary_description,
                'is_active' => !$this->is_active,
                'is_archive' => 0,
            ]);

            DB::commit();
        } catch (\Exception $ex) {
            toastr()->rtl(true)->persistent()->closeButton()->addError('خطا', $ex->getMessage());
            DB::rollBack();
            return redirect()->back();
        }

        $this->device=$device;
        sweetalert()
            ->showDenyButton()->timerProgressBar(false)->persistent()
            ->addInfo('مایل به پرینت دستگاه / قطعه هستید؟');
//        toastr()->rtl()->addSuccess('دستگاه / قطعه مورد نظر دریافت شد', ' ');
         return redirect()->route('admin.dossiers.index');
    }

    public function sweetalertConfirmed(array $payload)
    {
        return redirect()->route('admin.print.device.show', ['device' => $this->device->id]);
//        toastr()->addSuccess('ویژگی با موفقیت حذف شد');
    }
    /*public function sweetalertDenied(array $data)
    {
        toastr()->addSuccess('ویژگی با موفقیت حذف شد');
    }*/

    public function render()
    {
        $users = User::role('company')->get();
        return view('livewire.admin.dossiers.create-dossier',compact('users'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}



