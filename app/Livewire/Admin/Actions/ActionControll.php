<?php

namespace App\Livewire\Admin\Actions;

use Livewire\Component;
use App\Models\Action;
use App\Models\Device;
use Livewire\WithPagination;


class ActionControll extends Component
{
    use WithPagination;
    public Device $device;
    protected $paginationTheme = 'bootstrap';
    public $description;
    public $start_date;
    public $end_date;
    public $status;
    public $is_print;
    public $action;
    public $is_edit=false;
    public $display;
    protected $listeners = [
      'sweetAlertConfirmed', // only when confirm button is clicked
  ];


    public function ref()
    {
        $this->is_edit=false;

        $this->reset("description");
        $this->reset("start_date");
        $this->reset("end_date");
        $this->reset("status");
        $this->reset("is_print");
        $this->reset("display");
        $this->resetValidation();
    }


    public function render()
    {
        return view('livewire.admin.actions.action-controll',['actions'=>Action::latest()->where('device_id' , $this->device->id)->paginate(10)])->extends('admin.layout.MasterAdmin')->section('Content');
    }


    public function edit_action(Action $action)
    {
     $this->is_edit=true;
     $this->description=$action->description;
     $this->start_date=$action->start_date;
     $this->end_date=$action->end_date;
     $this->status=$action->status;
     $this->is_print=$action->is_print;
     $this->action=$action;
     $this->display="disabled";
    }



    public function del_action(Action $action){

        try {
          $this->action=$action;
          sweetAlert()
              ->livewire()
              ->showDenyButton(true,'انصراف')->confirmButtonText("تایید")
              ->addInfo('از حذف رکورد مورد نظر اطمینان دارید؟');



          } catch (\Exception $e) {

            redirect('admin.actions.create');
         }

    }

    public function addAction(){

        if($this->is_edit){

          $this->validate([
                'description' => 'required|string',
                'start_date' => 'required|string',
                'end_date' => 'required|string',
                'status' => 'required',
                'is_print' => 'required',
          ]);

        $this->action->update([
                "description" => $this->description,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'status' => $this->status,
                'is_print' => $this->is_print,
                'user_id' => auth()->user()->id,
                'device_id' => $this->device->id,
        ]);

        $this->is_edit=false;

        $this->reset("description");
        $this->reset("start_date");
        $this->reset("end_date");
        $this->reset("status");
        $this->reset("is_print");
        $this->reset("display");

        toastr()->livewire()->addSuccess('تغییرات با موفقیت ذخیره شد');


        }

        else{
            $this->validate([
                'description' => 'required|string',
                'start_date' => 'required|string',
                'end_date' => 'required|string',
                'status' => 'required',
                'is_print' => 'required',

              ]);

            Action::create([
                "description" => $this->description,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'status' => $this->status,
                'is_print' => $this->is_print,
                'user_id' => auth()->user()->id,
                'device_id' => $this->device->id,
               ]);

        $this->reset("description");
        $this->reset("start_date");
        $this->reset("end_date");
        $this->reset("status");
        $this->reset("is_print");
        $this->reset("display");

               toastr()->livewire()->addSuccess('اقدام با موفقیت ایجاد شد');

        }


    }

    public function sweetAlertConfirmed(array $data)
    {
            $this->action->delete();
            toastr()->livewire()->addSuccess('ویژگی با موفقیت حذف شد');
    }


     public function createAction(){
      $actions=Action::latest()->where('device_id' , $this->device->id)->paginate(10);
      return view('livewire.admin.actions.action-controll', compact('actions'));
     }
}
