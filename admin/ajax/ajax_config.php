<?php

use App\Core\AntiSQLInjection;
use App\Core\Database;
use App\Core\Helper;

session_start();
require '../../vendor/autoload.php';

@define('LIBRARIES', '../../libraries/');
@define('SOURCES', '../sources/');

require_once LIBRARIES . "config.php";

AntiSQLInjection::sqlinjection();
$d = new Database($config['database']);
