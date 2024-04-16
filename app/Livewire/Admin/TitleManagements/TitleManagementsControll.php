<?php

namespace App\Livewire\Admin\TitleManagements;
use App\Models\TitleManagement;
use Livewire\Component;
use Livewire\WithPagination;


class TitleManagementsControll extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $title;
    public TitleManagement $title_management;
    public $is_edit=false;
    public $display;
    protected $listeners = [
      'sweetAlertConfirmed', // only when confirm button is clicked
  ];


    public function ref()
    {
        $this->is_edit=false;
        $this->reset("title");
        $this->reset("display");
        $this->resetValidation();
    }


    public function render()
    {
        return view('livewire.admin.title-managements.title-managements-controll',['title_managements'=>TitleManagement::latest()->paginate(10)])->extends('admin.layout.MasterAdmin')->section('Content');
    }


    public function edit_title_management(TitleManagement $title_management)
    {
        $this->is_edit=true;
        $this->title=$title_management->title;
        $this->title_management=$title_management;
        $this->display="disabled";
    }



    public function del_title_management(Tag $title_management){

        try {
          $this->title_management=$title_management;
          sweetAlert()
              ->livewire()
              ->showDenyButton(true,'انصراف')->confirmButtonText("تایید")
              ->addInfo('از حذف رکورد مورد نظر اطمینان دارید؟');



          } catch (\Exception $e) {

            redirect('admin.title_managements.create');
         }

    }

    public function addTitle_management(){

        if($this->is_edit){

          $this->validate([
            'title' => 'required|unique:title_managements,title,'.$this->title_management->id
          ]);

        $this->title_management->update([
        'title'=> $this->title,
        ]);

        $this->is_edit=false;
        $this->reset("title");
        $this->reset("display");
        toastr()->livewire()->addSuccess('تغییرات با موفقیت ذخیره شد');


        }

        else{
            $this->validate([
                'title' => 'required|unique:title_managements,title'
              ]);

            TitleManagement::create([
                "title" => $this->title,
               ]);
               $this->reset("title");
               toastr()->livewire()->addSuccess('عنوان با موفقیت ایجاد شد');



        }


    }

    public function sweetAlertConfirmed(array $data)
    {
            $this->title_management->delete();
            toastr()->livewire()->addSuccess('عنوان با موفقیت حذف شد');
    }

}
