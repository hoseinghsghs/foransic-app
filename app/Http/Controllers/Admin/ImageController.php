<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\DeviceImage;
use Flasher\Toastr\Prime\ToastrFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{

    public function UploadeImage($image, $directory, $height = null, $width = null)
    {

        if ($image) {
            //درایور پیش فرض ذخیره
            $filesystem = config('filesystems.default');
            //مسیر ذخیره سازی درایور پیش فرض
            $pach = config('filesystems.disks.' . $filesystem)['root'];
            //پسوند تصویر
            $extension = $image->extension();
            //ساخت نام تصویر از هلپر فانکشن
            $image_name = Persian_generateImageName($extension);

            if (!Storage::exists($directory)) {
                // این پوشه را بساز
                Storage::makeDirectory($directory);
            }

            if ($height && $width) {
                $img = Image::make($image)->resize($width, $height);

                $img->save($pach . '/' . $directory . '/' . $image_name);
            } else {

                $image->storeAs($directory, $image_name);
            }

            return $image_name;
        } else {

            return null;
        }
    }

    public function UploadeVideo($video, $directory)
    {
        if ($video) {
            //درایور پیش فرض ذخیره
            $filesystem = config('filesystems.default');
            //مسیر ذخیره سازی درایور پیش فرض
            $pach = config('filesystems.disks.' . $filesystem)['root'];
            //پسوند تصویر
            $extension = $video->extension();
            //ساخت نام تصویر از هلپر فانکشن
            $video_name = Persian_generateImageName($extension);


            if (!Storage::exists($directory)) {
                // این پوشه را بساز
                Storage::makeDirectory($directory);
            }
            $video->storeAs(path: $directory, name: $video_name);
            return $video_name;
        } else {

            return null;
        }
    }


    public function UploadeFile($file, $directory)
    {
        if ($file) {
            //درایور پیش فرض ذخیره
            $filesystem = config('filesystems.default');
            //مسیر ذخیره سازی درایور پیش فرض
            $pach = config('filesystems.disks.' . $filesystem)['root'];
            //پسوند تصویر
            $extension = $file->extension();
            //ساخت نام تصویر از هلپر فانکشن
            $file_name = Persian_generateImageName($extension);


            if (!Storage::exists($directory)) {
                // این پوشه را بساز
                Storage::makeDirectory($directory);
            }
            $file->storeAs(path: $directory, name: $file_name);
            return $file_name;
        } else {

            return null;
        }
    }


    //////////////////ویرایش تصویر
    public function edit(Device $device)
    {
        return view('admin.page.devices.edit_images', compact('device'));
    }

    public function edit_uploadImage(Request $request)
    {
        $images = $request->file();
        if (count($images) > 0) {
            foreach ($images as $image) {
                $image_upload = DeviceImage::where('image', $image)->get();
                $ImageController = new ImageController();
                $image_name = $ImageController->UploadeImage($image, "other_device_image", 900, 800);
                DeviceImage::create([
                    'device_id' => $request->device,
                    'image' => $image_name
                ]);

                $paths[] = ['url' => $image_name];
            }
        }
        return response()->json($image_name, 200);
    }

    public function edit_deleteImage(Request $request)
    {

        $device = Device::find($request->id);
        $namefile = $request->name;
        DeviceImage::where('image', $namefile)->delete();
        Storage::delete('test/' . $namefile);
        return response()->json(['success' => "تصویر حذف شد"]);
    }

    public function setPrimary(Request $request, Device $device, ToastrFactory $flasher)
    {

        $device = Device::find($request->device);

        if ($request->has('primary_image')) {

            $ImageController = new ImageController();
            $image_name = $ImageController->UploadeImage($request->primary_image, "primary_image", 900, 800);


            $device->update([
                'primary_image' => $image_name,
            ]);
            $flasher->addSuccess(' شواهد مورد نظر ویرایش شد');
            return redirect()->back();
        }
        $flasher->addSuccess('تصویر قبلی بدون ویرایش');
        return redirect()->back();
    }

    public function flyManipulation(Request $request)
    {
        //        dd(public_path('banners/'.$request->name));
        $img = Image::make(env('BANNER_IMAGES_PATCH') . $request->name);

        //manipulate image
        $img->resize($request->width, function ($constraint) {
            $constraint->aspectRatio();
        });

        // create response and add encoded image data
        $response = Response::make($img->encode('jpg'));

        // set content-type
        $response->header('Content-Type', 'image/jpg');

        // output
        return $response;
    }
}
