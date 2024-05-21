<?php

namespace App\Livewire\Admin\Guides;

use App\Http\Controllers\Admin\ImageController;
use App\Models\Guide;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;


class GuideFile extends Component
{
    use WithFileUploads, WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $url;
    public $category;
    public $type;
    public $fil = [];
    public $guide_id;
    public Guide $guide;
    public $is_edit;
    public $display;

    public function ref()
    {
        $this->is_edit = false;
        $this->reset("category");
        $this->reset("fil");
        $this->resetValidation();
    }

    public function rules(): array
    {
        return [
            'fil.*' => 'required|mimes:pdf,zip,rar,xlsx|max:3000',
        ];
    }

    public function delete(Guide $guide)
    {
        $this->authorize('guides-file-delete');

        if (Storage::exists('guides/files/' . $guide->url)) {
            Storage::delete('guides/files/' . $guide->url);
        }
        $guide->delete();
        toastr()->rtl()->addSuccess('فایل ها با موفقیت حذف گردید');
    }

    public function save()
    {
        $this->validate();
        if ($this->is_edit) {
            $this->authorize('guides-file-edit');

            $this->validate([
                'category' => 'required|string',
            ]);
            $this->guide->update([
                'category' => $this->category,
            ]);
            $this->is_edit = false;
            $this->reset("category");
            $this->reset("display");
            toastr()->rtl()->addSuccess('تغییرات با موفقیت ذخیره شد', ' ');
        } else {
            $this->authorize('guides-file-create');

            try {
                if (count($this->fil) > 0) {
                    foreach ($this->fil as $file) {
                        $ImageController = new ImageController();
                        $file_name = $ImageController->UploadeFile($file, "guides/files");
                        Guide::create([
                            'url' => $file_name,
                            'category' => $this->category,
                            'type' => 'file',
                        ]);
                    }
                }
                $this->reset("category");
                $this->reset("display");

                $this->reset("fil");
                toastr()->rtl()->addSuccess('فایل ها با موفقیت آپلود گردید');
                return redirect()->back();
            } catch (\Throwable $th) {
                $this->reset("category");
                $this->reset("display");

                $this->reset("fil");
                alert()->warning('مشکل در آپلود تصویر ')->showConfirmButton('تایید');
                return redirect()->back();
            }
        }
    }

    public function edit_file(Guide $guide)
    {
        $this->authorize('guides-file-edit');

        $this->is_edit = true;
        $this->category = $guide->category;
        $this->display = "disabled";
        $this->guide = $guide;
    }

    public function render()
    {
        $guides = Guide::where('type', 'file')->latest()->paginate(8);
        return view('livewire.admin.guides.guide-file', compact('guides'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
