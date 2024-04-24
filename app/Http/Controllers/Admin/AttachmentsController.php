<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Action;
use App\Models\ActionAttachment;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AttachmentsController extends Controller
{
   public function uploadAttachment ($attachment, $directory)
    {

        if ($attachment) {
            //درایور پیش فرض ذخیره
            $filesystem = config('filesystems.default');
            //مسیر ذخیره سازی درایور پیش فرض
            $pach = config('filesystems.disks.' . $filesystem)['root'];
            //پسوند تصویر
            $extension = $attachment->extension();

            //ساخت نام تصویر از هلپر فانکشن
            $attachment_name = Persian_generateImageName($extension);

            if (!Storage::exists($directory)) {
                // این پوشه را بساز
                Storage::makeDirectory($directory);
            }

            $attachment->storeAs($directory, $attachment_name);

            return $attachment_name;
        } else {

            return null;
        }
    }

    public function edit_uploadImage(Request $request)
    {
        $attachments = $request->file();
        if (count($attachments) > 0) {
            foreach ($attachments as $attachment) {
                $attachment_upload = ActionAttachment::where('attachment', $attachment)->get();
                $ImageController = new ImageController();
                $attachment_name = $ImageController->UploadeImage($attachment, "other_action_attachment", 900, 800);
                ActionAttachment::create([
                    'action_id' => $request->action,
                    'attachment' => $attachment_name
                ]);

                $paths[] = ['url' => $attachment_name];
            }
        }
        return response()->json($attachment_name, 200);
    }

    public function edit_deleteImage(Request $request)
    {

        $action = Action::find($request->id);
        $namefile = $request->name;
        ActionAttachment::where('attachment', $namefile)->delete();
        Storage::delete('test/' . $namefile);
        return response()->json(['success' => "تصویر حذف شد"]);
    }


}
