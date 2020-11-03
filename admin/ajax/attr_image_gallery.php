<?php

use App\Core\Helper;

require_once 'ajax_config.php';

$id = (int)$_POST['id'];
$data = $_POST['data'];

if ($id && $data) {
    $d->where('id', $id);
    if ($d->update('gallery', $data)) {
        $result['status'] = 'OK';
    } else {
        $result['error'] = 'Some thing went wrong';
    }
}

echo json_encode($result);
