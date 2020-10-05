<?php

use App\Core\Helper;

$linkMan = Helper::createLink(['act' => 'man']);
$linkAdd = Helper::createLink(['act' => 'add']);
$linkCopy = Helper::createLink(['act' => 'copy']);
$linkEdit = Helper::createLink(['act' => 'edit']);
$linkDelete = Helper::createLink(['act' => 'delete']);

$linkView = $linkEdit;

$config_current = $config_type[$type][$com];


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

    default:
        # code...
        break;
}


function get_mans() {
    global $d, $strUrl, $curPage, $items, $paging, $type;

    $curPage = $curPage ? (int)$curPage : 1;

    $idlist = intval($_REQUEST['id_list']);
	$idcat = intval($_REQUEST['id_cat']);
    $iditem = intval($_REQUEST['id_item']);

    $per_page = 10;

    $d->pageLimit = $per_page;
    $items = $d->arrayBuilder()->paginate('product', $curPage);
    $paging = Helper::pagination($d->totalPages,$per_page,$curPage);
    var_dump($paging);

}

function save_man()
{
    global $d, $strUrl, $curPage, $config, $com, $act, $type;
    if(empty($_POST)) {
        Helper::transfer("Không nhận được dữ liệu", Helper::createLink(['act' => 'man', 'p' => $curPage]),1);
    }
}

?>
