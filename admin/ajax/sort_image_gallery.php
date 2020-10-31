<?php

use App\Core\Helper;

require_once 'ajax_config.php';

$id = (int)$_POST['id'];
$arr_gallery = $_POST['stack'];
$result;


foreach ($arr_gallery as $key => $value) {
    $data = ['stt' => $key];
    $d->where('id', $value['key']);
    if ($d->update('gallery', $data)) {
        # code...
    } else {
        $result['error'][] = " update fail at {$value['name']} ";
    }
}

echo json_encode($result);
