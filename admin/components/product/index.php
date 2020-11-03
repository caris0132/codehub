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
    global $d, $item, $type, $com, $act, $gallery, $config_current;

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
        $d->orderBy("stt", "asc");
        $d->orderBy("id", "asc");
        $gallery = $d->get('gallery', null, '*');
    }
}

function save_man()
{
    global $d, $strUrl, $curPage, $config, $com, $act, $type, $config_current;
    $result = false; //ket qua sử lý
    if (empty($_POST)) {
        Helper::transfer("Không nhận được dữ liệu", Helper::createLink(['act' => 'man', 'p' => $curPage]), 1);
    }
    $savehere = (isset($_POST['save-here'])) ? true : false;
    $image_name = Helper::randonName($_FILES['image']["name"]);
    $id = (int)$_POST['id'];

    /**  common dùng chung cho cả edit và add */
    $data = $_POST['data'];

    $data['giaban'] = (int)str_replace(",", "", $data['giaban']);
    $data['giacu'] = (int)str_replace(",", "", $data['giacu']);
    $data['type'] = $type;

    foreach ($config_current['check'] as $key => $value) {
        $data[$key] = $data[$key] ? 1 : 0;
    }

    if (empty($data['tenkhongdau'])) {
        $data['tenkhongdau'] = Helper::changeTitle($data['ten_vi']);
    }

    if ($image_name && $photo = Helper::uploadFile($_FILES['image'], $config_current['image']['mine_type'], $config_current['image']['folder'], $image_name)) {
        $data['photo'] = $photo;
    }
    /** end common dùng chung cho cả edit và add */

    // sử lý riêng từng action
    /** edit */
    if ($id) {
        // nếu up hình mới xóa hình cũ
        if ($data['photo']) {
            $row = $d->rawQueryOne("select id, photo from #_{$com} where id = ? ", array($id));
            $file_path = $config_current['image']['folder'] . $row['photo'];
            if ($row['photo'] && Helper::getFilesystem()->has($file_path)) {
                Helper::deleteCacheImage($file_path);
                Helper::getFilesystem()->delete($file_path);
            }
        }
        $data['ngaysua'] = time();
        $d->where('id', $id);
        $d->where('type', $type);

        $result = $d->update($com, $data);
    }
    /** end edit */

    /** add */
    if (empty($id)) {
        $data['ngaytao'] = time();
        if ($result = $d->insert($com, $data)) {
            $id = $d->getInsertId();
        }
    }
    /** end add */

    // sử lý các thành phần/Bảng phụ thuộc và điều hướng
    if ($result) {
        //  bang gallery
        if ($_FILES['gallery']) {
            $d->where('own_id', $id);
            $d->where('com', $com);
            $stt_start = (int)$d->getValue("gallery", "count(*)");
            foreach ($_FILES['gallery']['name'] as $key => $gallery_name) {
                if ($gallery_name) {
                    $gallery['name'] = $gallery_name;
                    $gallery['type'] = $_FILES['gallery']['type'][$key];
                    $gallery['tmp_name'] = $_FILES['gallery']['tmp_name'][$key];
                    $gallery['error'] = $_FILES['gallery']['error'][$key];
                    $gallery['size'] = $_FILES['gallery']['size'][$key];
                    $gallery_name_rand = Helper::randonName($gallery_name);

                    $gallery_photo = Helper::uploadFile($gallery, $config_current['gallery']['mine_type'], $config_current['gallery']['folder'], $gallery_name_rand);

                    if ($gallery_photo) {
                        $data1['photo'] = $gallery_photo;
                        $data1['stt'] = $stt_start + $key;
                        $data1['ten'] = $_POST['gallery_name'][$stt_start + $key];

                        $data1['type'] = $_GET['type'];
                        $data1['com'] = $com;
                        $data1['own_id'] = $id;
                        $data1['hienthi'] = 1;
                        $data1['ngaytao'] = time();
                        $d->insert('gallery', $data1);
                    }
                }
            }
        }

        // bang seo
        if ($_POST['dataSeo']) {
            $dataSeo = $_POST['dataSeo'];

            foreach ($dataSeo as $lang => $value) {
                $value['com'] = $com;
                $value['lang'] = $lang;
                $value['own_id'] = $id;
                Seo::saveSEOByComID($com, $id, $lang, $value);
            }
        }

        $direct_link = $savehere ? Helper::createLink(['act' => 'edit', 'id' => $id]) : Helper::createLink(['act' => 'man']);
        Helper::transfer('Cập nhật dữ liệu thành công!', $direct_link);
    } else {
        $direct_link = $id ? Helper::createLink(['act' => 'edit', 'id' => $id]) : Helper::createLink(['act' => 'add']);
        Helper::transfer('Cập nhật dữ liệu bị lỗi!', $direct_link, 0);
    }
}

function delete_man()
{
    global $d, $strUrl, $func, $config_current, $curPage, $com, $type;
    $id = (int)$_GET['id'];
    $listid = explode(',', $_GET['listid']);
    if ($id) {
        delete_by_id($id, $com);
        Helper::transfer('Xóa dữ liệu thành công!', Helper::createLink(['act' => 'man', 'p' => $curPage, 'id' => null, 'listid' => null]));
    } elseif ($listid) {
        foreach ($listid as $id) {
            $id = (int)$id;
            if ($id) {
                delete_by_id($id, $com);
            }
        }
        Helper::transfer('Xóa dữ liệu thành công!', Helper::createLink(['act' => 'man', 'p' => $curPage, 'id' => null, 'listid' => null]));
    } else {
        Helper::transfer('Xóa dữ liệu bị lỗi!', Helper::createLink(['act' => 'man']), 0);
    }
}

function delete_by_id($id, $com)
{
    global $config_current;

    if (empty($id) || empty($com)) {
        throw new Exception("id and component not empty", 0);
    }

    $d = Database::getInstance();
    $d->where('id', $id);
    $row = $d->getOne($com, 'photo, id');
    if ($row['id']) {
        $file_path = $config_current['image']['folder'] . $row['photo'];
        if ($row['photo'] && Helper::getFilesystem()->has($file_path)) {
            Helper::getFilesystem()->delete($file_path);
            Helper::deleteCacheImage($file_path);
        }

        $d->where('id', $id);
        $d->delete($com);

        // delete gallery
        if ($config_current['gallery']['enable'] == true) {
            $d->where('own_id', $id);
            $d->where('com', $com);
            $gallery = $d->get('gallery', null, 'photo');
            foreach ($gallery as $key => $value) {
                $file_path = $config_current['gallery']['folder'] . $value['photo'];
                if ($value['photo'] && Helper::getFilesystem()->has($file_path)) {
                    Helper::getFilesystem()->delete($file_path);
                    Helper::deleteCacheImage($file_path);
                }
            }
            if ($gallery) {
                $d->where('own_id', $id);
                $d->where('com', $com);
                $d->delete('gallery');
            }
        }

        // delete seo
        if ($config_current['seo']) {
            Seo::deleteSEOByComID($com, $id);
        }
    }
}
