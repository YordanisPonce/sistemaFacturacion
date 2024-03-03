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

    public static function url($path)
    {
        return Storage::url($path);
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

    public static function saveBase64Image($base64_string, $folderName)
    {

        if (strpos($base64_string, 'data:image/jpeg;base64,') !== false) {
            $image = str_replace('data:image/jpeg;base64,', '', $base64_string);
            $extension = 'jpeg';
        } else if (strpos($base64_string, 'data:image/png;base64,') !== false) {
            $image = str_replace('data:image/png;base64,', '', $base64_string);
            $extension = 'png';
        } else if (strpos($base64_string, 'data:image/gif;base64,') !== false) {
            $image = str_replace('data:image/gif;base64,', '', $base64_string);
            $extension = 'gif';
        } else {
            // formato no soportado
            return null;
        }
        // $image = str_replace('data:image/png;base64,', '', $base64_string);
        $image = str_replace(' ', '+', $image);
        $imageName = Str::random(40) . '.' . $extension;
        $path = $folderName . '/' . $imageName;
        Storage::disk('public')->put($path, base64_decode($image));

        return $path;
    }

    public static function isBase64Encoded($string)
    { // Check if there is no invalid character in string
        if (!preg_match('/^(?:[data]{4}:(text|image|application)\/[a-z]*)/', $string)) {
            return false;
        } else {
            return true;
        }
    }

}