<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadFileService
{
    public static function upload($file, $path, $oldFile = null)
    {
        if ($file) {
            if ($oldFile != null) {
                self::deleteImage($path, $oldFile);
            }

            $fileName = Str::random(10) . time() . '.' . $file->getClientOriginalExtension();
            $upload = Storage::disk('public')->putFileAs($path, $file, $fileName);

            return $fileName;
        } else {
            return $oldFile;
        }
    }

    public static function deleteImage($path, $file)
    {
        if (Storage::disk('public')->exists($path . '/' . $file)) {
            Storage::disk('public')->delete($path . '/' . $file);
        }
    }
}
