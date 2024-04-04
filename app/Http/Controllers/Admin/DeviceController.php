<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DeviceController extends Controller
{
       public function index()
    {
        return view('admin.page.devices.index');
    }
    public function show(Device $device)
    {
        $images = $device->images;
        return view('admin.page.devices.show', compact('device', 'images'));
    }

    public function uploadImage(Request $request)
    {
        $images = $request->file();
        if (count($images) > 0) {
            foreach ($images as $image) {
                $ImageController = new ImageController();
                $image_name = $ImageController->UploadeImage($image, "other_device_image", 900, 800);
                Session::push('images', $image_name);
                $paths[] = ['url' => $image_name];
            }
        }
        return response()->json($image_name, 200);
    }
    public function deleteImage(Request $request)
    {

        $namefile = $request->name;
        DeviceImage::where('image', $namefile)->delete();
        Storage::delete('test/' . $namefile);

        $images = Session::pull('images', []); // Second argument is a default value
        if (($key = array_search($namefile, $images)) !== false) {
            unset($images[$key]);
        }
        Session::put('images', $images);

        return response()->json(['success' => "تصویر حذف شد"]);
    }

    public function archive()
    {
        return view('admin.page.devices.archive');
    }
}
