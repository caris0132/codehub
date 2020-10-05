<?php

use App\Core\Helper;

$linkMan = Helper::createLink(['act' => 'man']);
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
        $template = 'add';
        break;

    case 'save':
        save_man();
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
    $items = $d->arrayBuilder()->paginate($com, $curPage);
    $paging = Helper::pagination($d->totalPages, $per_page, $curPage);
}

function save_man()
{
    global $d, $strUrl, $curPage, $config, $com, $act, $type, $config_current;
    if (empty($_POST)) {
        Helper::transfer("Không nhận được dữ liệu", Helper::createLink(['act' => 'man', 'p' => $curPage]), 1);
    }

    $image_name = Helper::randonName($_FILES['image']["name"]);
    $id = (int)$_POST['id'];

    // common
    $data = $_POST['data'];

    $data['giaban'] = str_replace(",", "", $data['giaban']);
    $data['giacu'] = str_replace(",", "", $data['giacu']);
    $data['type'] = $type;

    // check box hiển thị / nb ...
    foreach ($config_current['check'] as $key => $value) {
        $data[$key] = $data[$key] ? 1 : 0;
    }


    if (empty($data['tenkhongdau'])) {
        $data['tenkhongdau'] = Helper::changeTitle($data['tenkhongdau']);
    }

    if ($id) {
        if ($image_name && $photo = Helper::uploadFile("image", $config_current['image']['mine_type'], $config_current['image']['folder'], $image_name)) {
            $data['photo'] = $photo;

            $row = $d->rawQueryOne("select id, photo from #_{$com} where id = ? and type = ?", array($id, $type));
            if ($row['id']) {
                delete_file($config_current['image']['folder'] . $row['photo']);
            }
        }

        $data['ngaysua'] = time();

		$d->where('id', $id);
        $d->where('type', $type);
        if ($d->update($com, $data)) {
            transfer('Cập nhật dữ liệu thành công!', Helper::createLink(['act' => 'man', 'p' => $curPage]));
        } else {
            transfer('Cập nhật dữ liệu bị lỗi!', Helper::createLink(['act' => 'edit', 'id' => $id]), 0);
        }

    } else {
        if ($image_name && $photo = Helper::uploadFile("image", $config_current['image']['mine_type'], $config_current['image']['folder'], $image_name)) {
            $data['photo'] = $photo;
        }

        $data['ngaytao'] = time();

        if($d->insert($com,$data)) {
            $id_insert = $d->getLastInsertId();
            transfer("Lưu dữ liệu thành công", Helper::createLink(['act' => 'man', 'p' => $curPage]));
        } else {
            transfer('Cập nhật dữ liệu bị lỗi!', Helper::createLink(['act' => 'add']), 0);
        }
    }
}
