<?php
namespace App;

class Session
{
    public static function start()
    {
        if (!session_id()) {
            return @session_start();
        }
        return true;
    }

    public static function set($key, $value)
    {
        if (!session_id()) {
            self::start();
        }
        $_SESSION[(string) $key] = $value;
    }

    public static function get($key)
    {
        if (!session_id()) {
            self::start();
        }
        $key = (string) $key;
        if (Session::exists((string) $key)) {
            return $_SESSION[(string) $key];
        }
        return false;
    }

    public static function exists()
    {
        if (!session_id()) {
            Session::start();
        }
        foreach (func_get_args() as $argument) {
            if (is_array($argument)) {
                foreach ($argument as $key) {
                    if (!isset($_SESSION[(string) $key])) {
                        return false;
                    }
                }
            } else {
                if (!isset($_SESSION[(string) $argument])) {
                    return false;
                }
            }
        }
        return true;
    }

    public static function destroy()
    {
        if (session_id()) {
            session_unset();
            session_destroy();
            $_SESSION = [];
        }
    }
}
