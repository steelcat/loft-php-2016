<?php
namespace App;

class File
{
    public static function ext($filename)
    {
        $filename = (string) $filename;
        return substr(strrchr($filename, '.'), 1);
    }
}
