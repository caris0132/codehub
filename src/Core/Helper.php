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
    public static function encrypt_password($secret, $str, $salt)
    {
        return md5($secret . $str . $salt);
    }

    public static function getMenuPermission($name, $com, $act, $type = '', $icon_class = 'far fa-caret-square-right', $array = null, $case = 'phrase-1')
    {
        $add_class = 'nav-link';

        $str = '<li class="nav-item"><a class="{%class%}" href="{%url%}"><i class="nav-icon text-sm {%icon_class%}"></i><p>{%title%}</p></a></li>';

        if ($com == $_GET['com'] && $act == $_GET['act'] && $type == $_GET['type']) {
            $add_class .= ' active';
        }

        $arr_option = [
            'title' => $name,
            'class' => $add_class,
            'url' => "index.php?com={$com}&act={$act}&type={$type}",
            'icon_class' => $icon_class,
        ];

        foreach ($arr_option as $key => $value) {
            $str = str_replace('{%' . $key . '%}', $value, $str);
        }

        echo $str;
    }
}
