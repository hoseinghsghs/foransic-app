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
    public Guide $guide;
    protected $paginationTheme = 'bootstrap';
    public $url;
    public $category;
    public $is_edit;
    public $display;
    public $type;
    public $img = [];
    public $guide_id;


    public function ref()
    {
        $this->is_edit = false;
        $this->reset("category");
        $this->reset("img");
        $this->resetValidation();
    }

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
        if ($this->is_edit) {
            $this->authorize('attributes-edit');
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
            if (count($this->img) > 0) {
                foreach ($this->img as $image) {
                    $ImageController = new ImageController();
                    $image_name = $ImageController->UploadeImage($image, "guides/images");
                    Guide::create([
                        'url' => $image_name,
                            'category' => $this->category,
                        'type' => 'image',
                    ]);
                }
            }
                $this->reset("category");
                $this->reset("display");
            $this->reset("img");
            toastr()->rtl()->addSuccess('تصاویر با موفقیت آپلود گردید');
            return redirect()->back();
        } catch (\Throwable $th) {
                $this->reset("category");
                $this->reset("display");
            $this->reset("img");
            alert()->warning('مشکل در آپلود تصویر ')->showConfirmButton('تایید');
            return redirect()->back();
        }
    }
    }

    public function edit_image(Guide $guide)
    {
        $this->authorize('image-edit');

        $this->is_edit = true;
        $this->category = $guide->category;
        $this->display = "disabled";
        $this->guide = $guide;
    }
    public function render()
    {
        $guides = Guide::where('type', 'image')->latest()->paginate(8);
        return view('livewire.admin.guides.guide-image', compact('guides'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
