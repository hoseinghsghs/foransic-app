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
        try {

            $ImageController = new ImageController();
            $video_name = $ImageController->UploadeVideo($this->vid, 'guides\videos');

            Guide::create([
                'url' => $video_name,
                'category' => '',
                'type' => 'video',
            ]);


            toastr()->rtl()->addSuccess('فیلم با موفقیت آپلود گردید');
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->warning('مشکل در آپلود تصویر ')->showConfirmButton('تایید');
            return redirect()->back();
        }
    }
    public function render()
    {
        $videos = Guide::where('type', 'video')->latest()->paginate(8);
        return view('livewire.admin.guides.guide-video', compact('videos'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
