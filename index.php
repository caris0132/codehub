<?php
use App\Core\AntiSQLInjection;
use App\Core\Database;
use App\Core\Seo;
use App\Core\Helper;

session_start();
@define('LIBRARIES', './libraries/');
@define('SOURCES', './sources/');
@define('LAYOUT', 'layout/');
@define('TEMPLATE', 'templates/');
@define('THUMBS', 'thumbs');
@define('WATERMARK', 'watermark');

/* Config */
require_once 'vendor/autoload.php';
require_once LIBRARIES . "config.php";

AntiSQLInjection::sqlinjection();

$d = new Database($config['database']);
$seo = new Seo($d);

/* Router */
require_once LIBRARIES . "router.php";
/* Template */
include TEMPLATE . "index.php";

