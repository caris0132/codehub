<?php

namespace App\Core;

use App\Core\Permission;

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

    public static function isPermissionByAction($act)
    {
        return $_SESSION['login_admin']['is_root'] == 1 || Permission::getRoleByAction($act);
    }

    public static function getMenuPermission($name, $com, $act, $type = '', $icon_class = 'far fa-caret-square-right', $array = null, $case = 'phrase-1')
    {

        if (!self::isPermissionByAction($act)) {
            return false;
        }

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

    public static function createLink($option = [], $url = null)
    {
        if (empty($url)) {
            $url = $_SERVER['SCRIPT_NAME'];
        }
        if (!is_array($option)) {
            throw new \Exception("Option is array", 1);
        }

        $get = $_GET;

        foreach ($option as $key => $value) {
            $get[$key] = $value;
        }

        return $url . '?' . http_build_query($get);
    }

    public static function pagination($totalq, $per_page = 10, $page = 1, $url = null)
    {
        $total = $totalq;
        $adjacents = "2";
        $prevlabel = "Prev";
        $nextlabel = "Next";
        $lastlabel = "Last";
        $page = ($page == 0 ? 1 : $page);
        $start = ($page - 1) * $per_page;
        $prev = $page - 1;
        $next = $page + 1;
        $lastpage = ceil($total / $per_page);
        $lpm1 = $lastpage - 1;
        $pagination = "";

        if ($lastpage > 1) {
            $pagination .= "<ul class='pagination justify-content-center mb-0'>";
            $pagination .= "<li class='page-item'><a class='page-link'>Page {$page} / {$lastpage}</a></li>";



            if ($page > 1) {
                $url_page = self::createLink(['p' => $prev]);
                $pagination .= "<li class='page-item'><a class='page-link' href='{$url_page}'>{$prevlabel}</a></li>";
            }

            if ($lastpage < 7 + ($adjacents * 2)) {
                for ($counter = 1; $counter <= $lastpage; $counter++) {
                    $url_page = self::createLink(['p' => $counter]);
                    if ($counter == $page) {
                        $pagination .= "<li class='page-item active'><a class='page-link'>{$counter}</a></li>";
                    } else {
                        $pagination .= "<li class='page-item'><a class='page-link' href='{$url_page}'>{$counter}</a></li>";
                    }
                }
            } elseif ($lastpage > 5 + ($adjacents * 2)) {
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        $url_page = self::createLink(['p' => $counter]);
                        if ($counter == $page) $pagination .= "<li class='page-item active'><a class='page-link'>{$counter}</a></li>";
                        else $pagination .= "<li class='page-item'><a class='page-link' href='{$url_page}'>{$counter}</a></li>";
                    }
                    $url_page = self::createLink(['p' => 1]);
                    $pagination .= "<li class='page-item'><a class='page-link' href='{$url_page}'>...</a></li>";

                    $url_page = self::createLink(['p' => $lpm1]);
                    $pagination .= "<li class='page-item'><a class='page-link' href='{$url_page}'>{$lpm1}</a></li>";

                    $url_page = self::createLink(['p' => $lastpage]);
                    $pagination .= "<li class='page-item'><a class='page-link' href='{$url_page}'>{$lastpage}</a></li>";
                } elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $url_page = self::createLink(['p' => 1]);
                    $pagination .= "<li class='page-item'><a class='page-link' href='{$url_page}'>1</a></li>";
                    $url_page = self::createLink(['p' => 2]);
                    $pagination .= "<li class='page-item'><a class='page-link' href='{$url_page}'>2</a></li>";
                    $url_page = self::createLink(['p' => 1]);
                    $pagination .= "<li class='page-item'><a class='page-link' href='{$url_page}'>...</a></li>";

                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        $url_page = self::createLink(['p' => $counter]);
                        if ($counter == $page) $pagination .= "<li class='page-item active'><a class='page-link'>{$counter}</a></li>";
                        else $pagination .= "<li class='page-item'><a class='page-link' href='{$url_page}'>{$counter}</a></li>";
                    }

                    $url_page = self::createLink(['p' => 1]);
                    $pagination .= "<li class='page-item'><a class='page-link' href='{$url_page}'>...</a></li>";

                    $url_page = self::createLink(['p' => $lpm1]);
                    $pagination .= "<li class='page-item'><a class='page-link' href='{$url_page}'>{$lpm1}</a></li>";

                    $url_page = self::createLink(['p' => $lastpage]);
                    $pagination .= "<li class='page-item'><a class='page-link' href='{$url_page}'>{$lastpage}</a></li>";
                } else {
                    $url_page = self::createLink(['p' => 1]);
                    $pagination .= "<li class='page-item'><a class='page-link' href='{$url_page}'>1</a></li>";
                    $url_page = self::createLink(['p' => 2]);
                    $pagination .= "<li class='page-item'><a class='page-link' href='{$url_page}'>2</a></li>";
                    $url_page = self::createLink(['p' => 1]);
                    $pagination .= "<li class='page-item'><a class='page-link' href='{$url_page}'>...</a></li>";

                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                        $url_page = self::createLink(['p' => $counter]);
                        if ($counter == $page) $pagination .= "<li class='page-item active'><a class='page-link'>{$counter}</a></li>";
                        else $pagination .= "<li class='page-item'><a class='page-link' href='{$url_page}'>{$counter}</a></li>";
                    }
                }
            }

            if ($page < $counter - 1) {
                $url_page = self::createLink(['p' => $next]);
                $pagination .= "<li class='page-item'><a class='page-link' href='{$url_page}'>{$nextlabel}</a></li>";

                $url_page = self::createLink(['p' => $lastpage]);
                $pagination .= "<li class='page-item'><a class='page-link' href='{$url_page}'>{$lastlabel}</a></li>";
            }

            $pagination .= "</ul>";
        }
    }

    public static function transfer($msg, $page = "index.html", $stt = 1)
    {
        global $config_base;

        $basehref = $config_base;
        $showtext = $msg;
        $page_transfer = $page;
        $stt = $stt;

        include("./templates/transfer_tpl.php");
        exit();
    }
}
