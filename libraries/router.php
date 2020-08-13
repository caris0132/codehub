<?php

use App\Core\Helper;

$router = new AltoRouter();

/* Router */
$router->setBasePath($config['website']['folder']);
$router->addMatchTypes(array('flug' => '[a-zA-Z0-9_-]++'));

$router->map('GET', array('admin/', 'admin'), function () {
    global $config;
    Helper::redirect($config['website']['folder'] . "admin/index.php");
    exit;
});
$router->map('GET', array('admin', 'admin'), function () {
    global $config;
    Helper::redirect($config['website']['folder'] . "admin/index.php");
    exit;
});
$router->map('GET|POST', '', 'index', 'home');
$router->map('GET|POST', 'index.php', 'index', 'index');
$router->map('GET|POST', 'sitemap.xml', 'sitemap.php', 'sitemap');
$router->map('GET|POST', '[flug:com]', function ($com) {
    #code
});

$router->map('GET|POST', '[flug:com]/[a:lang]/', 'allpagelang', 'lang');
$router->map('GET|POST', '[flug:com]/[a:action]', 'account', 'account');

$match = $router->match();

if (is_array($match)) {
    $com = $match['params']['com'];

    if (is_callable($match['target'])) {
        call_user_func_array($match['target'], $match['params']);
    } elseif (is_file($match['target'])) {
        include $match['target'];
        exit;
    } else {
        $com = $match['target'];
    }
} else {
    header($_SERVER["SERVER_PROTOCOL"] . '404 Not Found');
    include("404.php");
    exit;
}
