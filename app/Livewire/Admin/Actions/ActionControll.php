<?php

namespace App\Livewire\Admin\Actions;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use App\Models\Action;
use App\Models\Device;
use App\Http\Controllers\Admin\AttachmentsController;
use App\Models\ActionAttachment;
use Illuminate\Support\Facades\Session;

use Livewire\WithPagination;


class ActionControll extends Component
{
    use WithPagination, AuthorizesRequests;

    public Device $device;
    protected $paginationTheme = 'bootstrap';
    public $description;
    public $start_date;
    public $end_date;
    public $status = true;
    public $is_print = true;
    public $action;
    public $is_edit = false;
    public $display;
    protected $listeners = [
        'sweetAlertConfirmed', // only when confirm button is clicked
    ];

    public function rules(): array
    {
        return [
            'description' => 'required|string',
            'start_date' => 'required|string',
            'end_date' => 'required|string',
            'status' => 'required|boolean',
            'is_print' => 'required|boolean',
        ];
    }

    public function ref()
    {
        $this->is_edit = false;

        $this->reset("description");
        $this->reset("start_date");
        $this->reset("end_date");
        $this->reset("status");
        $this->reset("is_print");
        $this->reset("display");
        $this->resetValidation();
        $this->dispatch('destroy-date-picker');
    }

    public function mount()
    {
        Session::forget('attachments');
    }

    public function render()
    {
        return view('livewire.admin.actions.action-controll', ['actions' => Action::orderBy('created_at', 'desc')->where('device_id', $this->device->id)->paginate(10)])->extends('admin.layout.MasterAdmin')->section('Content');
    }


    public function edit_action(Action $action)
    {
        if (Gate::allows('update-action',$action)){
            $this->is_edit = true;
            $this->description = $action->description;
            $this->start_date = $action->start_date;
            $this->end_date = $action->end_date;
            $this->status = $action->status;
            $this->is_print = $action->is_print;
            $this->action = $action;
            $this->display = "disabled";
            $this->resetValidation();
            $this->dispatch('edit-action', start_date: $this->start_date, end_date: $this->end_date);
        }else{
            toastr()->rtl()->addInfo('شما اجازه ویرایش این قسمت را ندارید!', ' ');
        }
    }


    public function del_action(Action $action)
    {
        try {
            $this->action = $action;
            $this->action->delete();
            toastr()->rtl()->addSuccess('اقدام با موفقیت حذف شد', ' ');

        } catch (\Exception $e) {

            redirect('admin.actions.create');
        }
    }

    public function addAction()
    {
        if ($this->is_edit) {
            $this->validate();

            $this->action->update([
                "description" => $this->description,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'status' => $this->status,
                'is_print' => $this->is_print,
//                'user_id' => auth()->user()->id,
                'device_id' => $this->device->id,
            ]);

            $this->ref();
            toastr()->rtl()->addSuccess('تغییرات با موفقیت ذخیره شد', ' ');
        } else {
            $this->validate();

            $action=Action::create([
                "description" => $this->description,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'status' => $this->status,
                'is_print' => $this->is_print,
                'user_id' => auth()->user()->id,
                'device_id' => $this->device->id,
            ]);

           $attachmentsStore = Session::pull('attachments', []);
            foreach ($attachmentsStore as $attachmentStore) {
                ActionAttachment::create([
                    'action_id' => $action->id,
                    'url' => $attachmentStore
                ]);
            }
            Session::forget('attachments');

            $this->ref();
            toastr()->rtl(true)->addSuccess('اقدام با موفقیت ایجاد شد', ' ');
        }
        $this->dispatch('destroy-date-picker');
        $this->dispatch('upfile');
    }

    public function sweetAlertConfirmed(array $data)
    {
        $this->action->delete();
        toastr()->rtl(true)->addSuccess('ویژگی با موفقیت حذف شد', ' ');
    }


    public function createAction()
    {
        $actions = Action::latest()->where('device_id', $this->device->id)->paginate(10);
        return view('livewire.admin.actions.action-controll', compact('actions'));
    }
}
