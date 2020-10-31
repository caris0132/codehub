<?php

use App\Core\Database;
use App\Core\Helper;
use App\Core\Seo;

$linkMan = Helper::createLink(['act' => 'man', 'id' => null]);
$linkAdd = Helper::createLink(['act' => 'add']);
$linkCopy = Helper::createLink(['act' => 'copy']);
$linkSave = Helper::createLink(['act' => 'save']);
$linkEdit = Helper::createLink(['act' => 'edit']);
$linkDelete = Helper::createLink(['act' => 'delete']);

$linkView = $linkEdit;


switch ($act) {
    case 'man':
        $template = 'man';
        get_mans();
        break;

    case 'add':
        $template = 'add';
        break;

    case 'edit':
    case 'copy':
        get_man();
        $template = 'add';
        break;

    case 'save':
        save_man();
        break;

    case 'delete':
        delete_man();
        break;

    default:
        # code...
        break;
}


function get_mans()
{
    global $d, $strUrl, $curPage, $items, $paging, $type, $com;

    $curPage = $curPage ? (int)$curPage : 1;

    $idlist = intval($_REQUEST['id_list']);
    $idcat = intval($_REQUEST['id_cat']);
    $iditem = intval($_REQUEST['id_item']);

    $per_page = 10;

    $d->pageLimit = $per_page;
    $d->orderBy('stt', 'asc');
    $d->orderBy('id', 'desc');
    $items = $d->arrayBuilder()->paginate($com, $curPage);
    $paging = Helper::pagination($d->totalPages, $per_page, $curPage);
}

function get_man()
{
    global $d, $item, $type, $com,$act, $gallery, $config_current;

    $id = htmlspecialchars($_GET['id']);
    if (empty($id)) {
        Helper::transfer("Không nhận được dữ liệu", Helper::createLink(['act' => 'man']));
    }
    $d->where('id', $id);
    $item = $d->getOne($com, '*');

    if ($item) {
        $d->where('type', $item['type']);
        $d->where('com', $com);
        $d->where('own_id', $item['id']);
        $d->orderBy("stt","asc");
        $d->orderBy("id","asc");
        $gallery = $d->get('gallery',null, '*');
    }

    if ($act == 'copy') {
        unset($item['photo']);
        unset($item['id']);
        unset($item['tenkhongdau']);
        unset($gallery);
    }

}

function save_man()
{
    global $d, $strUrl, $curPage, $config, $com, $act, $type, $config_current;

    if (empty($_POST)) {
        Helper::transfer("Không nhận được dữ liệu", Helper::createLink(['act' => 'man', 'p' => $curPage]), 1);
    }

    $savehere = (isset($_POST['save-here'])) ? true : false;

    $image_name = Helper::randonName($_FILES['image']["name"]);
    $id = (int)$_POST['id'];

    // common
    $data = $_POST['data'];

    $data['giaban'] = (int)str_replace(",", "", $data['giaban']);
    $data['giacu'] = (int)str_replace(",", "", $data['giacu']);
    $data['type'] = $type;

    // check box hiển thị / nb ...
    foreach ($config_current['check'] as $key => $value) {
        $data[$key] = $data[$key] ? 1 : 0;
    }

    if (empty($data['tenkhongdau'])) {
        $data['tenkhongdau'] = Helper::changeTitle($data['ten_vi']);
    }

    if ($id) {
        if ($image_name && $photo = Helper::uploadFile($_FILES['image'], $config_current['image']['mine_type'], $config_current['image']['folder'], $image_name)) {
            $data['photo'] = $photo;

            $row = $d->rawQueryOne("select id, photo from #_{$com} where id = ? ", array($id));
            if ($row['photo']) {
                $path_cache = Helper::getRelativePath($config_current['image']['folder'] . $row['photo']);
                if ($path_cache) {
                    Helper::deleteCacheImage($path_cache);
                }
                Helper::deleteFile($config_current['image']['folder'] . $row['photo']);
            }
        }

        $data['ngaysua'] = time();
		$d->where('id', $id);
        $d->where('type', $type);
        if ($d->update($com, $data)) {

            if ($_FILES['gallery']) {
                $stt_start = (int)$d->getValue ("gallery", "count(*)");
                foreach ($_FILES['gallery']['name'] as $key => $gallery_name) {
                    if ($gallery_name) {
                        $gallery['name'] = $gallery_name;
                        $gallery['type'] = $_FILES['gallery']['type'][$key];
                        $gallery['tmp_name'] = $_FILES['gallery']['tmp_name'][$key];
                        $gallery['error'] = $_FILES['gallery']['error'][$key];
                        $gallery['size'] = $_FILES['gallery']['size'][$key];
                        $gallery_name_rand = Helper::randonName($gallery_name);

                        $gallery_photo = Helper::uploadFile($gallery, $config_current['gallery']['mine_type'], $config_current['gallery']['folder'],$gallery_name_rand);
                        $data1['photo'] = $gallery_photo;
						$data1['stt'] = $stt_start + $key;
                        $data1['type'] = $_GET['type'];
                        $data1['com'] = $com;
						$data1['own_id'] = $id;
                        $data1['hienthi'] = 1;
                        $data1['ngaytao'] = time();
						$d->insert('gallery', $data1);
                    }
                }
            }

            if ($_POST['dataSeo']) {
                $dataSeo = $_POST['dataSeo'];
                foreach ($dataSeo as $key => $value) {
                    Seo::saveSEOByComID($com, $id, $key, $value);
                }
            }

            if ($savehere) {
                Helper::transfer('Cập nhật dữ liệu thành công!', Helper::createLink(['act' => 'edit', 'id' => $id]));
            } else {
                Helper::transfer('Cập nhật dữ liệu thành công!', Helper::createLink(['act' => 'man', 'p' => $curPage]));
            }
        } else {
            Helper::transfer('Cập nhật dữ liệu bị lỗi!', Helper::createLink(['act' => 'edit', 'id' => $id]), 0);
        }

    } else {
        if ($image_name && $photo = Helper::uploadFile($_FILES['image'], $config_current['image']['mine_type'], $config_current['image']['folder'], $image_name)) {
            $data['photo'] = $photo;
        }

        $data['ngaytao'] = time();

        if($d->insert($com,$data)) {
            $id_insert = $d->getInsertId();
            if ($savehere) {
                Helper::transfer('Lưu dữ liệu thành công!', Helper::createLink(['act' => 'edit', 'id' => $id_insert]));
            } else {
                Helper::transfer('Lưu dữ liệu thành công!', Helper::createLink(['act' => 'man', 'p' => $curPage]));
            }
        } else {
            Helper::transfer('Lưu dữ liệu bị lỗi!', Helper::createLink(['act' => 'add']), 0);
        }
    }
}

function delete_man() {
    global $d, $strUrl, $func,$config_current, $curPage, $com, $type;
    $id = (int)$_GET['id'];
    $listid = explode(',', $_GET['listid']);
    if ($id) {
        delete_by_id($id, $com);
        Helper::transfer('Xóa dữ liệu thành công!', Helper::createLink(['act' => 'man', 'p' => $curPage, 'id' => null, 'listid' => null]));
    } elseif ($listid) {
        foreach ($listid as $id) {
            $id = (int)$id;
            if($id) {
                delete_by_id($id, $com);
            }
        }
        Helper::transfer('Xóa dữ liệu thành công!', Helper::createLink(['act' => 'man', 'p' => $curPage, 'id' => null, 'listid' => null]));
    }
    else {
        Helper::transfer('Xóa dữ liệu bị lỗi!', Helper::createLink(['act' => 'man']), 0);
    }

}

function delete_by_id ($id, $com) {
    global $config_current;

    if (empty($id) || empty($com)) {
        throw new Exception("id and component not empty", 0);
    }

    $d = Database::getInstance();
    $d->where('id', $id);
    $row = $d->getOne($com, 'photo, id');
    if ($row['id']) {
        if ($row['photo']) {
            Helper::deleteFile($config_current['image']['folder'] . $row['photo']);
        }

        $d->where('id', $id);
        $d->delete($com);

        // delete gallery
        $d->where('own_id', $id);
        $d->where('com', $com);
        $gallery = $d->get('gallery', null, 'photo');
        foreach ($gallery as $key => $value) {
            Helper::deleteFile($config_current['gallery']['folder'] . $value['photo']);
        }
        if ($gallery) {
            $d->where('own_id', $id);
            $d->where('com', $com);
            $d->delete('gallery');
        }
    }

}
