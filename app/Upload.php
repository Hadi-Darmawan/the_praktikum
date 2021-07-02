<?php

namespace App;

use Str;

class Upload
{
    public static function uploadFile($file, $folder)
    {
        $file_name = strtolower(time().'_'.$file->getClientOriginalName());
        $file_name = Str::slug($file_name).'.'.strtolower($file->getClientOriginalExtension());
        $file->move(storage_path($folder), $file_name);

        return $folder.$file_name;
    }
}
