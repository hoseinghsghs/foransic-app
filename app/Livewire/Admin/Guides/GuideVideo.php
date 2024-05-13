<?php

namespace App\Livewire\Admin\Guides;

use App\Http\Controllers\Admin\ImageController;
use App\Models\Guide;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class GuideVideo extends Component
{
    use WithFileUploads, WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $url;
    public $category;
    public $type;
    public $vid;
    public $guide_id;
    public Guide $guide;
    public $is_edit;
    public $display;

    public function ref()
    {
        $this->is_edit = false;
        $this->reset("category");
        $this->reset("vid");
        $this->resetValidation();
    }


    public function rules(): array
    {
        return [
            'vid'  => 'mimes:mp4| max:40000'
        ];
    }
    public function delete(Guide $guide)
    {

        if (Storage::exists('guides/videos/' . $guide->url)) {
            Storage::delete('guides/videos/' . $guide->url);
        }
        $guide->delete();
        toastr()->rtl()->addSuccess('فیلم با موفقیت حذف گردید');
    }
    public function save()
    {
        // $this->validate();
        if ($this->is_edit) {
            $this->authorize('video-edit');
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
        try {
                if (count($this->vid) > 0) {
            $ImageController = new ImageController();
            $video_name = $ImageController->UploadeVideo($this->vid, 'guides\videos');

            Guide::create([
                'url' => $video_name,
                        'category' => $this->category,
                'type' => 'video',
            ]);
                    $this->reset("category");
                    $this->reset("display");
                    $this->reset('vid');
            toastr()->rtl()->addSuccess('فیلم با موفقیت آپلود گردید');
                    return redirect()->back();
                }
        } catch (\Throwable $th) {
                $this->reset("category");
                $this->reset("display");
                $this->reset('vid');
                alert()->warning('مشکل در آپلود ویدیو ')->showConfirmButton('تایید');
            return redirect()->back();
        }
    }
    }
    public function edit_video(Guide $guide)
    {
        $this->authorize('video-edit');

        $this->is_edit = true;
        $this->category = $guide->category;
        $this->display = "disabled";
        $this->guide = $guide;
    }
    public function render()
    {
        $guides = Guide::where('type', 'video')->latest()->paginate(8);
        return view('livewire.admin.guides.guide-video', compact('guides'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
