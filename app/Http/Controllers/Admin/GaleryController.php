<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galery;
use Flasher\Toastr\Prime\ToastrFactory;
use Illuminate\Support\Facades\Storage;
class GaleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galeries=Galery::all();
        return view('admin.page.galeries.index' , compact('galeries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'images.*' => 'required|image|mimes:jpg,jpeg,png,svg|max:2000',

        ],[],[
            'images.*' => 'نوع فایل ',
        ]);

         try {
         $images = $request->file();
        if (count($images) > 0) {
            foreach ($images as $imageess) {
                 foreach ($imageess as $image) {
                $ImageController = new ImageController();
                $image_name = $ImageController->UploadeImage($image, "galery_image");
             Galery::create([
            'file_url' => $image_name,
            'taxonomy' => 'files',
            'group_type' => 'image',
            'type' =>'jpg',
        ]);

            }
            }
        }
             toastr()->rtl(true)->persistent()->closeButton()->addSuccess('تصاویر با موفقیت آپلود گردید');
        return redirect()->route('admin.galeries.index');
        } catch (\Throwable $th) {
            alert()->warning('مشکل در آپلود تصویر ')->showConfirmButton('تایید');
        return redirect()->route('admin.galeries.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Galery $galery, ToastrFactory $flasher)
    {
            if (Storage::exists('galery_image/' . $galery->file_url)) {
                Storage::delete('galery_image/' . $galery->file_url);
            }
        $galery->delete();
        $flasher->addSuccess('تصویر مورد نظر حذف شد');
        return back();
    }
}
