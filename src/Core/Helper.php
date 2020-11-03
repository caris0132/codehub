<?php

namespace App\Core;

class Helper
{
    /**
     * Static instance of Server
     *
     * @var \League\Glide\ServerServer
     */
    static $server_glide  = null;

    public static function initGlideServer($config = [])
    {
        if (empty($config)) {
            $config = [
                'source' => ROOT,
                'cache' => ROOT . '/' . UPLOAD_CACHE_L,
            ];
        }
        self::$server_glide = \League\Glide\ServerFactory::create($config);
    }

    /**
     * Static instance of Filesystem
     *
     * @var \League\Flysystem\Filesystem
     */
    static $filesystem = null;

    public static function initFilesystem()
    {
        $adapter = new \League\Flysystem\Adapter\Local(ROOT);
        return self::$filesystem = new \League\Flysystem\Filesystem($adapter);
    }

    public static function getFilesystem()
    {
        if (empty(self::$filesystem)) {
            return self::initFilesystem();
        }
        return self::$filesystem;
    }

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

    public static function getStaticUrl($path)
    {
        global $config_base;
        return $config_base . '/' . $path;
    }

    public static function getTotalRuleByTypeAndCom($type, $com)
    {
        return 7;
    }

    public static function isPermissionByAction($type, $com, $act_rule)
    {
        $value = self::getTotalRuleByTypeAndCom($type, $com);
        return $_SESSION['login_admin']['is_root'] == 1 || Permission::checkRole($value, $act_rule);
    }

    public static function getMenuPermission($name, $com, $act, $type = '', $icon_class = 'far fa-caret-square-right')
    {

        $act_rule = Permission::getRoleByAction($act);
        if (!self::isPermissionByAction($type, $com, $act_rule)) {
            return false;
        }

        $add_class = 'nav-link';

        $str = '<li class="nav-item"><a class="{%class%}" href="{%url%}"><i class="nav-icon text-sm {%icon_class%}"></i><p>{%title%}</p></a></li>';

        // if ($com == $_GET['com'] && $type == $_GET['type']) {
        //     $add_class .= ' active';
        // }

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
            throw new \Exception("Option is not null", 1);
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
        $lastpage = $total;
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

        return $pagination;
    }

    public static function transfer($msg, $page = "index.html", $stt = 1)
    {
        global $config_base;

        $basehref = $config_base;
        $showtext = $msg;
        $page_transfer = $page;
        $stt = $stt;

        include("./components/layouts/transfer.php");

        exit();
    }

    public static function changeTitle($string)
    {
        $text = urldecode($string);
        $text = htmlspecialchars_decode($text);
        $text = strtolower(self::utf8convert($text));
        $text = preg_replace("/[^a-z0-9-\s]/", "", $text);
        $text = preg_replace('/([\s]+)/', '-', $text);
        $text = preg_replace('/([\-]+)/', '-', $text);
        $text = trim($text, '-');
        return $text;
    }

    public static function utf8convert($str)
    {
        if (!$str) return false;
        $utf8 = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd' => 'đ|Đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i' => 'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
            '' => '`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\“|\”|\:|\;|_',
        );
        foreach ($utf8 as $ascii => $uni)
            $str = preg_replace("/($uni)/i", $ascii, $str);
        return $str;
    }

    public static function randonName($name)
    {
        $rand = rand(1000, 9999);
        $ten_anh = explode(".", $name);
        $duoi_anh = $ten_anh[1];
        $result = self::changeTitle($ten_anh[0]) . "-" . $rand;
        return $result;
    }

    public static function checkFileNameIsType($filename, $type)
    {
        $ext = explode('.', $filename);
        $ext = $ext[count($ext) - 1];

        if (strpos($type, $ext) === false) {
            return false;
        }

        return true;
    }

    public static function uploadFile($file, $extension, $folder, $newname = '')
    {
        if (isset($file) && !$file['error']) {
            $ext = explode('.', $file['name']);
            $ext = $ext[count($ext) - 1];
            $name = basename($file['name'], '.' . $ext);

            if (strpos($extension, $ext) === false) {
                self::alert('Chỉ hỗ trợ upload file dạng ' . $extension);
                return false;
            }

            if ($newname == '' && self::getFilesystem()->has($folder . $file['name']))
                for ($i = 0; $i < 100; $i++) {
                    if (!self::getFilesystem()->has($folder . $name . $i . '.' . $ext)) {
                        $file['name'] = $name . $i . '.' . $ext;
                        break;
                    }
                }
            else {
                $file['name'] = $newname . '.' . $ext;
            }


            $stream = fopen($file['tmp_name'], 'r+');
            self::getFilesystem()->writeStream(
                $folder . $file['name'],
                $stream
            );
            if (is_resource($stream)) {
                fclose($stream);
            }

            return $file['name'];
        }
        return false;
    }

    public static function deleteFile($file)
    {
        return @unlink($file);
    }

    public static function alert($message)
    {
        echo '<script language="javascript"> alert("' . $message . '") </script>';
    }



    public static function deleteCacheImage($path)
    {
        if (!self::$server_glide) {
            self::initGlideServer();
        }

        return self::$server_glide->deleteCache($path);
    }

    public static function getRelativePath($path)
    {
        $path = realpath($path);
        if (substr($path, 0, strlen(ROOT)) == ROOT) {
            $path = substr($path, strlen(ROOT));
        }
        return $path;
    }
}
