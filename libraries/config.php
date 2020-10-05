<?php
if (!defined('LIBRARIES')) die("Error");

/* Timezone */
date_default_timezone_set('Asia/Ho_Chi_Minh');

/* Cấu hình coder */
define('NN_MSHD', 'MSHD');
define('NN_AUTHOR', 'nguyenductri.nina@gmail.com');

/* Cấu hình chung */

$config['author'] = [
    'name' => 'NDT',
    'email' => 'nguyenductri.nina@gmail.com',
    'timefinish' => '06/2020'
];

$config['website'] = [
    'folder' => '/codehub',
    'secret' => '$nina@',
    'salt' => 'swKJjeS!t',
    'debug' => true,
];

$config['database'] = [
    'type' => 'mysql',
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'db' => 'codehub',
    'port' => 3306,
    'prefix' => 'table_',
    'charset' => 'utf8'
];

$config['lang'] = [
    'vi' => 'Tiếng Việt',
    'en' => 'Tiếng Anh'
];

$config['api'] = [
    'recaptcha' => [
        'urlapi' => 'https://www.google.com/recaptcha/api/siteverify',
        'sitekey' => '6LezS5kUAAAAAF2A6ICaSvm7R5M-BUAcVOgJT_31',
        'secretkey' => '6LezS5kUAAAAAGCGtfV7C1DyiqlPFFuxvacuJfdq'
    ],
    'oneSignal' => [
        'id' => 'af12ae0e-cfb7-41d0-91d8-8997fca889f8',
        'restId' => 'MWFmZGVhMzYtY2U0Zi00MjA0LTg0ODEtZWFkZTZlNmM1MDg4'
    ],
];

$config['ckeditor'] = [
    'folder' => "upload/ckfinder/",
];

$config['login'] = [
    'admin' => 'LoginAdmin' . NN_MSHD,
    'member' => 'LoginMember' . NN_MSHD,
    'attempt' => 5,
    'delay' => 15
];

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

if ($config['website']['debug']) {
    // You're developing, so you want all errors to be shown
    //ini_set('display_errors', 'On');
    // Logging is usually overkill during development
    ini_set('log_errors', 'Off');
} else {
    // You don't want to display errors on a production environment
    ini_set('display_errors', 'Off');
    // You definitely want to log any occurring
    ini_set('log_errors', 'On');
}

/* Cấu hình base */
if ($config['arrayDomainSSL']) require_once LIBRARIES . "checkSSL.php";
$http = 'http';
if ($_SERVER["HTTPS"] == "on") $http .= "s";
$http .= "://";
$config_base = $http . $_SERVER['SERVER_NAME'] . $config['website']['folder'];

/* Cấu hình ckeditor */
$_SESSION['baseUrl'] = $config_base . $config['ckeditor']['folder'];

/* Cấu hình login */
$login_admin = $config['login']['admin'];
$login_member = $config['login']['member'];

/* Cấu hình upload */
require_once LIBRARIES . "constant.php";

if (empty($_SESSION['lang'])) {
    $_SESSION['lang'] = 'vi';
}
