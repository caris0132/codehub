<?php

use App\Core\Helper;

require_once 'ajax_config.php';

$id = (int)$_POST['id'];
$folder = $_POST['folder'];
$result['error'] = 'Some thing went wrong';
if ($id) {
    $d->where('id', $id);
    $row_gallery = $d->getOne('gallery');
    if ($row_gallery['photo']) {
        $real_path = Helper::getRelativePath('../' . $folder . $row_gallery['photo']);
        Helper::deleteCacheImage($real_path);
        Helper::deleteFile('../' . $folder . $row_gallery['photo']);
        $result = '';
        $d->where('id', $id);
        $d->delete('gallery');
    }
}

echo json_encode($result);
