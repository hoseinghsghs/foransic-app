<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Action;
use App\Models\ActionAttachment;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ActionController extends Controller
{
    public function uploadAttachment(Request $request)
    {
        $attachments = $request->file();
        if (count($attachments) > 0) {
            foreach ($attachments as $attachment) {
                $AttachmentsController = new AttachmentsController();
                $attachment_name = $AttachmentsController->uploadAttachment($attachment, "attachment_files");
                Session::push('attachments', $attachment_name);
                $paths[] = ['url' => $attachment_name];
            }
        }
        return response()->json($attachment_name, 200);
    }
    public function deleteAttachment(Request $request)
    {
        $namefile = $request->name;
        DeviceImage::where('url', $namefile)->delete();
        Storage::delete('test/' . $namefile);

        $attachments = Session::pull('attachments', []); // Second argument is a default value
        if (($key = array_search($namefile, $attachments)) !== false) {
            unset($attachments[$key]);
        }
        Session::put('attachments', $attachments);

        return response()->json(['success' => "تصویر حذف شد"]);
    }
}
