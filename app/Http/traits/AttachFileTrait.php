<?php

namespace App\Http\traits;

use Illuminate\Support\Facades\Storage;

trait AttachFileTrait
{

    public function uploadFile($request, $name)
    {
        $file_name = $request->file($name)->getClientOriginalName();

        $request->file($name)->storeAs('library/' . $file_name, $file_name, "attachments");
    }
    public function deleteFile($name)
    {
        $exists = Storage::disk('attachments')->exists('attachments/library/' . $name);

        if ($exists) {
            Storage::disk('attachments')->delete('attachments/library/' . $name);
        }
    }
}
