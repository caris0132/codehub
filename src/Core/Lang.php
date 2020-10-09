<?php
namespace App\Core;
use App\Core\Database;

class Lang
{
    private static $defaultLang;
    private static $currentLang;
    public static $arrayLang;
    public static $arrayKeyLang;
    public static function init($listLang, $currentLang = null, $defaultLang = null)
    {
        // $d = Database::getInstance();
        self::$arrayKeyLang = array_keys($listLang);
        self::$arrayLang = $listLang;

        $defaultLang = array_search($defaultLang, self::$arrayKeyLang) ? $defaultLang : self::$arrayKeyLang[0];
        self::setDefaultLang($defaultLang);


        if ($currentLang) {
            self::$currentLang = $currentLang;
        } else {
            self::setCurrentLang($_SESSION['lang'] ? $_SESSION['lang'] : self::getDefaultLang());
        }
    }

    public static function getCurrentLang()
    {
        return self::$currentLang;
    }
    public static function setCurrentLang($lang) {
        self::$currentLang = $lang;
        $_SESSION['lang'] = $lang;
    }

    public static function getDefaultLang()
    {
        return self::$defaultLang;
    }
    public static function setDefaultLang($lang) {
        self::$defaultLang = $lang;
        $_SESSION['lang_default'] = $lang;
    }

    public static function Link($tenkhongdau ,$lang = null)
    {
        $lang = $lang ? $lang : self::$currentLang;
        $link = '';
        $link = $lang == self::$defaultLang ? '' : "{$lang}/";
        return $link .= "{$tenkhongdau}";
    }

}
