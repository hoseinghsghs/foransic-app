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

    public function rules(): array
    {
        return [
            'fil.*' => 'required|mimes:pdf,zip,rar,xlsx|max:3000',
        ];
    }
    public function delete(Guide $guide)
    {
        if (Storage::exists('guides/files/' . $guide->url)) {
            Storage::delete('guides/files/' . $guide->url);
        }
        $guide->delete();
        toastr()->rtl()->addSuccess('فایل ها با موفقیت حذف گردید');
    }
    public function save()
    {
        $this->validate();
        try {

            if (count($this->fil) > 0) {
                foreach ($this->fil as $file) {
                    $ImageController = new ImageController();
                    $file_name = $ImageController->UploadeFile($file, "guides/files");
                    Guide::create([
                        'url' => $file_name,
                        'category' => '',
                        'type' => 'file',
                    ]);
                }
            }
            $this->reset("fil");
            toastr()->rtl()->addSuccess('فایل ها با موفقیت آپلود گردید');
            return redirect()->back();
        } catch (\Throwable $th) {
            $this->reset("fil");
            alert()->warning('مشکل در آپلود تصویر ')->showConfirmButton('تایید');
            return redirect()->back();
        }
    }
    public function render()
    {
        $files = Guide::where('type', 'file')->latest()->paginate(8);
        return view('livewire.admin.guides.guide-file', compact('files'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
