<?php

namespace App\Core;

class Helper
{
    public static function redirect($url = '', $response = 301)
    {
        header("location:$url", true, $response);
        exit();
    }

    public static function getRealIPAddress()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    public static function encrypt_password() {
        return md5($secret . $str . $salt);
    }
}
