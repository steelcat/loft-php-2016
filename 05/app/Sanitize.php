<?php
namespace App;

class Sanitize
{
    public static function input($val) {
        return htmlentities(strip_tags(trim($val)));
    }
}
