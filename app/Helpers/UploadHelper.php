<?php

namespace App\Helpers;

use App\Interfaces\RepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadHelper
{
    public static function upload($filename, $content, $folderName = 'uploads')
    {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $path = $folderName . '/' . Str::random(40) . '.' . $ext;
        Storage::disk('public')->put($path, $content);
        return $path;
    }

    public static function remove($path)
    {
        if (is_array($path)) {
            $result = array_map(function ($string) {
                return 'public/' . $string;
            }, $path);

        } else {
            $result = 'public/' . $path;
        }
        return Storage::delete($result);
    }
}