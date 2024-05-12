<?php

namespace App\Livewire\Admin\Guides;

use App\Http\Controllers\Admin\ImageController;
use App\Models\Guide;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Livewire\Forms\PostForm;
use Livewire\WithPagination;


class GuideImage extends Component
{
    use WithFileUploads, WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $url;
    public $category;
    public $type;
    public $img = [];
    public $guide_id;

    public function rules(): array
    {
        return [
            'img.*' => 'required|image|mimes:jpg,jpeg,png,svg|max:3000',
        ];
    }
    public function delete(Guide $guide)
    {
        if (Storage::exists('guides/images/' . $guide->url)) {
            Storage::delete('guides/images/' . $guide->url);
        }
        $guide->delete();
        toastr()->rtl()->addSuccess('تصاویر با موفقیت حذف گردید');
    }
    public function save()
    {
        $this->validate();
        try {
            if (count($this->img) > 0) {
                foreach ($this->img as $image) {
                    $ImageController = new ImageController();
                    $image_name = $ImageController->UploadeImage($image, "guides/images");
                    Guide::create([
                        'url' => $image_name,
                        'category' => '',
                        'type' => 'image',
                    ]);
                }
            }
            $this->reset("img");
            toastr()->rtl()->addSuccess('تصاویر با موفقیت آپلود گردید');
            return redirect()->back();
        } catch (\Throwable $th) {
            $this->reset("img");
            alert()->warning('مشکل در آپلود تصویر ')->showConfirmButton('تایید');
            return redirect()->back();
        }
    }
    public function render()
    {
        $images = Guide::where('type', 'image')->latest()->paginate(8);
        return view('livewire.admin.guides.guide-image', compact('images'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
