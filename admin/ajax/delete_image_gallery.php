<?php

use App\Core\Helper;
use Symfony\Component\HttpFoundation\Response;

require_once 'ajax_config.php';

$id = (int)$_POST['id'];
$folder = $_POST['folder'];
$result[] = 'ada';
if ($id) {
    $d->where('id', $id);
    $row_gallery = $d->getOne('gallery');
    $file_path = $folder . $row_gallery['photo'];
    if ($row_gallery['photo'] && Helper::getFilesystem()->has($file_path)) {
        Helper::getFilesystem()->delete($file_path);
        Helper::deleteCacheImage($file_path);
    }

    $d->where('id', $id);
    if ($d->delete('gallery')) {
        $d->where('own_id', $row_gallery['own_id']);
        $d->where('com', $row_gallery['com']);
        $d->orderBy('stt', 'ASC');
        $arr_gallery = $d->get('gallery', null, 'stt, id');
        foreach ($arr_gallery as $key => $value) {
            $data = ['stt' => $key];
            $d->where('id', $value['id']);
            $d->update('gallery', $data);
        }
    }
}

return Helper::jsonResponse($result, Response::HTTP_OK)->send();
