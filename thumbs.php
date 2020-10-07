<?php

use League\Flysystem\Filesystem;
use League\Glide\ServerFactory;
use League\Flysystem\Adapter\Local;

if (!defined('LIBRARIES')) die("Error");

$server = ServerFactory::create([
    'source' => new Filesystem(new Local(ROOT)),
    'cache' => new Filesystem(new Local(ROOT . '/' . UPLOAD_CACHE_L)),
]);

try {
    $thumb_option = array_merge($_GET, $match['params']);
    $path = $match['params']['src'];
    if ($thumb_option['style'] == 2) {
        $thumb_option['fit'] = 'fill';
    } else {
        $thumb_option['fit'] = 'crop';
    }
    $server->outputImage($path, $thumb_option);
} catch (\Exception $th) {
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
    echo $th->getMessage();
}
