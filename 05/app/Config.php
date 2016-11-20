<?php
/**
 * Project: loft-php-2016
 * Author: Zorca (vs@zorca.org)
 */

namespace App;

/**
 * Class Config
 * @package App
 */
class Config
{
    /**
     * @return bool|string
     */
    public static function get()
    {
        if (file_exists(BASE . 'config.php')) {
                return include(BASE . 'config.php');
        }
        return false;
    }
}
