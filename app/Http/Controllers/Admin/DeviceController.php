<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class DeviceController extends Controller
{
    public function show(Device $device)
    {
        Gate::authorize('devices-show');
        Gate::authorize('is-same-laboratory',$device->laboratory_id);

        $images = $device->images;
        $actions = Action::where('device_id', $device->id)->get();
        return view('admin.page.devices.show', compact('device', 'images', 'actions'));
    }

    // for create device
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

    // for create device
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
}
