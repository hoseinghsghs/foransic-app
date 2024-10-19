<?php

namespace App\Livewire\Admin\Actions;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use App\Models\Action;
use App\Models\Device;
use App\Models\ActionCategory;
use App\Http\Controllers\Admin\AttachmentsController;
use App\Models\ActionAttachment;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
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
    public $attachments;
    public $device_image;
    public $status = true;
    public $is_print = true;
    public $action;
    public $is_edit = false;
    public $display;
    public $action_category_id;
    public $catg;

    public function rules(): array
    {
        return [
            'action_category_id' => 'required|string|exists:action_category,id',
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
        $this->reset("attachments");
        $this->reset("start_date");
        $this->reset("end_date");
        $this->reset("status");
        $this->reset("is_print");
        $this->reset("display");
        $this->reset("action_category_id");
        $this->resetValidation();
        $this->dispatch('destroy-date-picker');
        $this->dispatch('upfile');
        $this->dispatch('resetselect2');
    }

    public function mount()
    {
        Session::forget('attachments');
    }

    public function edit_action(Action $action)
    {
        $this->authorize('actions-edit');
        if (Gate::allows('update-action', $action)) {
            $this->category_id = $action->action_category_id;
            $this->dispatch(
                'eselect2',
                catg: $action->action_category_id,
            );
            $this->attachments = $action->attachments->pluck('url');
            $this->is_edit = true;
            $this->description = $action->description;
            $this->start_date = $action->start_date;
            $this->end_date = $action->end_date;
            $this->status = $action->status;
            $this->is_print = $action->is_print;
            $this->action_category_id = $action->action_category_id;
            $this->action = $action;
            $this->display = "disabled";
            $this->resetValidation();
            $this->dispatch('edit-action', start_date: $this->start_date, end_date: $this->end_date);
            $this->dispatch('edit-file', attachments: $this->attachments);
        } else {
            flash()->addInfo('شما اجازه ویرایش این قسمت را ندارید!');
        }
    }


    public function del_action(Action $action)
    {
        $this->authorize('actions-delete');

        try {
            $action->delete();
            flash()->addSuccess('اقدام با موفقیت حذف شد');
        } catch (\Exception $e) {

            redirect('admin.actions.create');
        }
    }

    public function addAction()
    {
        if ($this->is_edit) {
            $this->authorize('actions-edit');
            $this->validate();
            try {
                DB::beginTransaction();
                $this->action->update([
                    "description" => $this->description,
                    'start_date' => $this->start_date,
                    'end_date' => $this->end_date,
                    'status' => $this->status,
                    'is_print' => $this->is_print,
                    'device_id' => $this->device->id,
                    'action_category_id' => $this->action_category_id,
                ]);

                $attachmentsStore = Session::pull('attachments', []);
                foreach ($attachmentsStore as $attachmentStore) {
                    ActionAttachment::create([
                        'action_id' => $this->action->id,
                        'url' => $attachmentStore
                    ]);
                }
                if (!empty($_SERVER['HTTP_CLIENT_IP']))
                    //check ip from share internet
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
                    //to check ip is pass from proxy
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                else
                    $ip = $_SERVER['REMOTE_ADDR'];
                Event::create([
                    'title' => 'ویرایش اقدام' . ' ' . ' | ' . ' ' . ' آزمایشگاه : ' . $this->device->laboratory->name  . '___' . ' ip ' . ' : ' . $ip,
                    'body' => 'ID اقدام ' . " : " . $this->action->id .  ' ' . ' | ' . ' ' . 'آیدی کاربر' . " : " . auth()->user()->id . ' ' . ' - ' . ' ' . auth()->user()->name  .  ' ' . ' | ' . ' ' . ' عنوان شاهد: ' . $this->device->category->title . '-' . $this->device->id,
                    'user_id' => auth()->user()->id,
                    'eventable_id' => $this->action->id,
                    'eventable_type' => Action::class,
                ]);


                DB::commit();
            } catch (\Exception $ex) {
                flash()->addError($ex->getMessage());
                DB::rollBack();
                return redirect()->back();
            }

            Session::forget('attachments');
            $this->ref();
            flash()->addSuccess('تغییرات با موفقیت ذخیره شد');
        } else {
            $this->authorize('actions-create');
            $this->validate();
            try {
                DB::beginTransaction();
                $action = Action::create([
                    "description" => $this->description,
                    'start_date' => $this->start_date,
                    'end_date' => $this->end_date,
                    'status' => $this->status,
                    'is_print' => $this->is_print,
                    'action_category_id' => $this->action_category_id,
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
                if (!empty($_SERVER['HTTP_CLIENT_IP']))
                    //check ip from share internet
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
                    //to check ip is pass from proxy
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                else
                    $ip = $_SERVER['REMOTE_ADDR'];
                Event::create([
                    'title' => 'ایجاد اقدام' . ' ' . ' | ' . ' ' . ' آزمایشگاه : ' . $this->device->laboratory->name  . '___' . ' ip ' . ' : ' . $ip,
                    'body' => 'ID اقدام ' . " : " . $action->id .  ' ' . ' | ' . ' ' . 'آیدی کاربر' . " : " . auth()->user()->id . ' ' . ' - ' . ' ' . auth()->user()->name  .  ' ' . ' | ' . ' ' . ' عنوان شاهد: ' . $this->device->category->title . '-' . $this->device->id,
                    'user_id' => auth()->id(),
                    'eventable_id' => $action->id,
                    'eventable_type' => Action::class,
                ]);
                DB::commit();
            } catch (\Exception $ex) {
                flash()->addError($ex->getMessage());
                DB::rollBack();
                return redirect()->back();
            }

            Session::forget('attachments');

            $this->ref();
            flash()->addSuccess('اقدام با موفقیت ایجاد شد');
        }
    }

    public function render()
    {
        $actions = Action::orderBy('created_at', 'desc')->where('device_id', $this->device->id)->paginate(10);
        return view('livewire.admin.actions.action-controll', ['actions' => $actions, 'categories' => ActionCategory::all()])->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
