<?php
$linkView = $config_base;
$linkMan = $linkFilter = "index.php?com=$com&act=man&type=$type&p=$curPage";
$linkAdd = "index.php?com=$com&act=add&type=$type&p=$curPage";
$linkCopy = "index.php?com=$com&act=copy&type=$type&p=$curPage";
$linkEdit = "index.php?com=$com&act=edit&type=$type&p=$curPage";
$linkDelete = "index.php?com=$com&act=delete&type=$type&p=$curPage";

function get_main_list()
{
    global $d, $type;

    $row = $d->rawQuery("select ten_vi, id from #_product_list where type = ? order by stt,id desc", array($type));

    $str = '<select id="id_list" name="data[id_list]" data-level="0" data-type="' . $type . '" data-table="#_product_cat" data-child="id_cat" class="form-control select2 select-category"><option value="0">Chọn danh mục</option>';
    foreach ($row as $v) {
        if ($v["id"] == (int)$_REQUEST['id_list']) $selected = "selected";
        else $selected = "";

        $str .= '<option value=' . $v["id"] . ' ' . $selected . '>' . $v["ten_vi"] . '</option>';
    }
    $str .= '</select>';

    return $str;
}

function get_main_cat()
{
    global $d, $type;

    $id_list = htmlspecialchars($_REQUEST['id_list']);
    $row = $d->rawQuery("select ten_vi, id from #_product_cat where id_list = ? and type = ? order by stt,id desc", array($id_list, $type));

    $str = '<select id="id_cat" name="data[id_cat]" data-level="1" data-type="' . $type . '" data-table="#_product_item" data-child="id_item" class="form-control select2 select-category"><option value="0">Chọn danh mục</option>';
    foreach ($row as $v) {
        if ($v["id"] == (int)$_REQUEST['id_cat']) $selected = "selected";
        else $selected = "";

        $str .= '<option value=' . $v["id"] . ' ' . $selected . '>' . $v["ten_vi"] . '</option>';
    }
    $str .= '</select>';

    return $str;
}

function get_main_item()
{
    global $d, $type;

    $id_list = htmlspecialchars($_REQUEST['id_list']);
    $id_cat = htmlspecialchars($_REQUEST['id_cat']);
    $row = $d->rawQuery("select ten_vi, id from #_product_item where id_list = ? and id_cat = ? and type = ? order by stt,id desc", array($id_list, $id_cat, $type));

    $str = '<select id="id_item" name="data[id_item]" data-level="2" data-type="' . $type . '" data-table="#_product_sub" data-child="id_sub" class="form-control select2 select-category"><option value="0">Chọn danh mục</option>';
    foreach ($row as $v) {
        if ($v["id"] == (int)$_REQUEST['id_item']) $selected = "selected";
        else $selected = "";

        $str .= '<option value=' . $v["id"] . ' ' . $selected . '>' . $v["ten_vi"] . '</option>';
    }
    $str .= '</select>';

    return $str;
}

function get_main_sub()
{
    global $d, $type;

    $id_list = htmlspecialchars($_REQUEST['id_list']);
    $id_cat = htmlspecialchars($_REQUEST['id_cat']);
    $id_item = htmlspecialchars($_REQUEST['id_item']);
    $row = $d->rawQuery("select ten_vi, id from #_product_sub where id_list = ? and id_cat = ? and id_item = ? and type = ? order by stt,id desc", array($id_list, $id_cat, $id_item, $type));

    $str = '<select id="id_sub" name="data[id_sub]" class="form-control select2 select-category"><option value="0">Chọn danh mục</option>';
    foreach ($row as $v) {
        if ($v["id"] == (int)$_REQUEST['id_sub']) $selected = "selected";
        else $selected = "";

        $str .= '<option value=' . $v["id"] . ' ' . $selected . '>' . $v["ten_vi"] . '</option>';
    }
    $str .= '</select>';

    return $str;
}
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active"><?= $labelAct ?> <?= $config_type[$type][$com]['title_main'] ?></li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <form class="validation-form" novalidate method="post" action="<?= $linkSave ?>" enctype="multipart/form-data">
        <div class="card-footer text-sm sticky-top">
            <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="submit" class="btn btn-sm bg-gradient-success submit-check" name="save-here"><i class="far fa-save mr-2"></i>Lưu tại trang</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?= $linkMan ?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline text-sm">
                    <div class="card-header">
                        <h3 class="card-title">Danh mục <?= $config_type[$type][$com]['title_main'] ?></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group-category row">
                            <?php if ($config_type[$type][$com]['list']) { ?>
                                <div class="form-group col-xl-4 col-sm-4">
                                    <label class="d-block" for="id_list">Danh mục cấp 1:</label>
                                    <?= get_main_list() ?>
                                </div>
                            <?php } ?>
                            <?php if ($config_type[$type][$com]['cat']) { ?>
                                <div class="form-group col-xl-4 col-sm-4">
                                    <label class="d-block" for="id_cat">Danh mục cấp 2:</label>
                                    <?= get_main_cat() ?>
                                </div>
                            <?php } ?>
                            <?php if ($config_type[$type][$com]['item']) { ?>
                                <div class="form-group col-xl-4 col-sm-4">
                                    <label class="d-block" for="id_item">Danh mục cấp 3:</label>
                                    <?= get_main_item() ?>
                                </div>
                            <?php } ?>
                            <?php if ($config_type[$type][$com]['sub']) { ?>
                                <div class="form-group col-xl-4 col-sm-4">
                                    <label class="d-block" for="id_sub">Danh mục cấp 4:</label>
                                    <?= get_main_sub() ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <?php if ($config_type[$type][$com]['images']) { ?>
                    <div class="card card-primary card-outline text-sm">
                        <div class="card-header">
                            <h3 class="card-title">Hình ảnh <?= $config_type[$type][$com]['title_main'] ?></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                            $photoDetail = $config_type[$type][$com]['images']['folder'] . $item['photo'];
                            $dimension = "Width: " . $config_type[$type][$com]['images']['width'] . " px - Height: " . $config_type[$type][$com]['images']['height'] . " px (" . $config_type[$type][$com]['type'] . ")";
                            include COMPONENTS . "layouts/image.php";
                            ?>
                        </div>
                    </div>
                <?php } ?>

                <?php if ($config_type[$type][$com]['gallery']) { ?>
                    <div class="card card-primary card-outline text-sm">
                        <div class="card-header">
                            <h3 class="card-title">Bộ sưu tập <?= $config_type[$type][$com]['title_main'] ?></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="filer-gallery" class="label-filer-gallery mb-3">Album hình: (<?= $config_type[$type][$com]['gallery']['type']['img_type_photo'] ?>)</label>
                                <input type="file" name="files[]" id="filer-gallery" multiple="multiple">
                                <input type="hidden" class="col-filer" value="col-xl-3 col-sm-3 col-6">
                                <input type="hidden" class="act-filer" value="man">
                            </div>
                            <?php if (count($gallery)) { ?>
                                <div class="form-group form-group-gallery">
                                    <label class="label-filer">Album hiện tại:</label>
                                    <div class="action-filer mb-3">
                                        <a class="btn btn-sm bg-gradient-primary text-white check-all-filer mr-1"><i class="far fa-square mr-2"></i>Chọn tất cả</a>
                                        <button type="button" class="btn btn-sm bg-gradient-success text-white sort-filer mr-1"><i class="fas fa-random mr-2"></i>Sắp xếp</button>
                                        <a class="btn btn-sm bg-gradient-danger text-white delete-all-filer" data-folder="product"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
                                    </div>
                                    <div class="alert my-alert alert-sort-filer alert-info text-sm text-white bg-gradient-info"><i class="fas fa-info-circle mr-2"></i>Có thể chọn nhiều hình để di chuyển</div>
                                    <div class="jFiler-items my-jFiler-items jFiler-row">
                                        <ul class="jFiler-items-list jFiler-items-grid row scroll-bar" id="jFilerSortable">
                                            <?php foreach ($gallery as $v) galleryFiler($v['stt'], $v['id'], $v['photo'], $v['tenvi'], 'product', 'col-xl-3 col-sm-3 col-6'); ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-12">
                <?php
                if ($config_type[$type][$com]['slug']) {
                    $slugchange = ($act == 'edit') ? 1 : 0;
                    $copy = ($act != 'copy') ? 0 : 1;
                    include TEMPLATE . LAYOUT . "slug.php";
                }
                ?>
                <div class="card card-primary card-outline text-sm">
                    <div class="card-header">
                        <h3 class="card-title">Nội dung <?= $config_type[$type][$com]['title_main'] ?></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                                    <?php foreach ($config['lang'] as $k => $v) { ?>
                                        <li class="nav-item">
                                            <a class="nav-link <?= ($k == 'vi') ? 'active' : '' ?>" id="tabs-lang" data-toggle="pill" href="#tabs-lang-<?= $k ?>" role="tab" aria-controls="tabs-lang-<?= $k ?>" aria-selected="true"><?= $v ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="card-body card-article">
                                <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                                    <?php foreach ($config['lang'] as $k => $v) { ?>
                                        <div class="tab-pane fade show <?= ($k == 'vi') ? 'active' : '' ?>" id="tabs-lang-<?= $k ?>" role="tabpanel" aria-labelledby="tabs-lang">
                                            <div class="form-group">
                                                <label for="ten_<?= $k ?>">Tiêu đề (<?= $k ?>):</label>
                                                <input type="text" class="form-control for-seo" name="data[ten_<?= $k ?>]" id="ten_<?= $k ?>" placeholder="Tiêu đề (<?= $k ?>)" value="<?= $item['ten_' . $k] ?>" <?= ($k == 'vi') ? 'required' : '' ?>>
                                            </div>
                                            <?php if ($config_type[$type][$com]['mota']) { ?>
                                                <div class="form-group">
                                                    <label for="mota_<?= $k ?>">Mô tả (<?= $k ?>):</label>
                                                    <textarea class="form-control for-seo <?= ($config_type[$type][$com]['mota_cke']) ? 'form-control-ckeditor' : '' ?>" name="data[mota_<?= $k ?>]" id="mota_<?= $k ?>" rows="5" placeholder="Mô tả (<?= $k ?>)"><?= htmlspecialchars_decode($item['mota_' . $k]) ?></textarea>
                                                </div>
                                            <?php } ?>
                                            <?php if ($config_type[$type][$com]['noidung']) { ?>
                                                <div class="form-group">
                                                    <label for="noidung_<?= $k ?>">Nội dung (<?= $k ?>):</label>
                                                    <textarea class="form-control for-seo <?= ($config_type[$type][$com]['noidung_cke']) ? 'form-control-ckeditor' : '' ?>" name="data[noidung_<?= $k ?>]" id="noidung_<?= $k ?>" rows="5" placeholder="Nội dung (<?= $k ?>)"><?= htmlspecialchars_decode($item['noidung_' . $k]) ?></textarea>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card card-primary card-outline text-sm">
            <div class="card-header">
                <h3 class="card-title">Thông tin <?= $config_type[$type][$com]['title_main'] ?></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="hienthi" class="d-inline-block align-middle mb-0 mr-2">Hiển thị:</label>
                    <div class="custom-control custom-checkbox d-inline-block align-middle">
                        <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi]" id="hienthi-checkbox" <?= (!isset($item['hienthi']) || $item['hienthi'] == 1) ? 'checked' : '' ?>>
                        <label for="hienthi-checkbox" class="custom-control-label"></label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="stt" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
                    <input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="data[stt]" id="stt" placeholder="Số thứ tự" value="<?= isset($item['stt']) ? $item['stt'] : 1 ?>">
                </div>
                <?php if ($config_type[$type][$com]['file']) { ?>
                    <div class="form-group">
                        <label class="change-file mb-1 mr-2" for="file-taptin">
                            <p>Upload tập tin:</p>
                            <strong class="ml-2">
                                <span class="btn btn-sm bg-gradient-success"><i class="fas fa-file-upload mr-2"></i>Chọn tập tin</span>
                                <div><b class="text-sm text-split"></b></div>
                            </strong>
                        </label>
                        <strong class="d-block mt-2 mb-2 text-sm"><?php echo $config_type[$type][$com]['file_type']; ?></strong>
                        <div class="custom-file my-custom-file d-none">
                            <input type="file" class="custom-file-input" name="file-taptin" id="file-taptin">
                            <label class="custom-file-label" for="file-taptin">Chọn file</label>
                        </div>
                        <?php if ($item['taptin']) { ?>
                            <a class="btn btn-sm bg-gradient-primary text-white d-inline-block align-middle p-2 rounded mb-1" href="<?= UPLOAD_FILE . $item['taptin'] ?>" title="Download tập tin hiện tại"><i class="fas fa-download mr-2"></i>Download tập tin hiện tại</a>
                        <?php } ?>
                    </div>
                <?php } ?>
                <div class="row">
                    <?php if ($config_type[$type][$com]['ma']) { ?>
                        <div class="form-group col-md-4">
                            <label class="d-block" for="masp">Mã sản phẩm:</label>
                            <input type="text" class="form-control" name="data[masp]" id="masp" placeholder="Mã sản phẩm" value="<?= $item['masp'] ?>">
                        </div>
                    <?php } ?>
                    <?php if ($config_type[$type][$com]['gia']) { ?>
                        <div class="form-group col-md-4">
                            <label class="d-block" for="gia">Giá bán:</label>
                            <div class="input-group">
                                <input type="text" class="form-control format-price gia_ban" name="data[gia]" id="gia" placeholder="Giá bán" value="<?= $item['gia'] ?>">
                                <div class="input-group-append">
                                    <div class="input-group-text"><strong>VNĐ</strong></div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($config_type[$type][$com]['giamoi']) { ?>
                        <div class="form-group col-md-4">
                            <label class="d-block" for="giamoi">Giá mới:</label>
                            <div class="input-group">
                                <input type="text" class="form-control format-price gia_moi" name="data[giamoi]" id="giamoi" placeholder="Giá mới" value="<?= $item['giamoi'] ?>">
                                <div class="input-group-append">
                                    <div class="input-group-text"><strong>VNĐ</strong></div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($config_type[$type][$com]['giakm']) { ?>
                        <div class="form-group col-md-4">
                            <label class="d-block" for="giakm">Chiết khấu:</label>
                            <div class="input-group">
                                <input type="text" class="form-control gia_km" name="data[giakm]" id="giakm" placeholder="Chiết khấu" value="<?= $item['giakm'] ?>" maxlength="3" readonly>
                                <div class="input-group-append">
                                    <div class="input-group-text"><strong>%</strong></div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($config_type[$type][$com]['link']) { ?>
                        <div class="form-group col-md-4">
                            <label for="link">Link:</label>
                            <input type="text" class="form-control" name="data[link]" id="link" placeholder="Link" value="<?= $item['link'] ?>">
                        </div>
                    <?php } ?>
                    <?php if ($config_type[$type][$com]['video']) { ?>
                        <div class="form-group col-md-4">
                            <label for="link_video">Video:</label>
                            <input type="text" class="form-control" name="data[link_video]" id="link_video" placeholder="Video" value="<?= $item['link_video'] ?>">
                        </div>
                    <?php } ?>
                    <?php if ($config_type[$type][$com]['tinhtrang']) { ?>
                        <div class="form-group col-md-4">
                            <label for="tinhtrang">Tình trạng:</label>
                            <select class="form-control" name="data[tinhtrang]" id="tinhtrang">
                                <option value="0">Chọn tình trạng</option>
                                <option <?= ($item['tinhtrang'] == 1) ? "selected" : "" ?> value="1">Còn hàng</option>
                                <option <?= ($item['tinhtrang'] == 2) ? "selected" : "" ?> value="2">Hết hàng</option>
                            </select>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php if ($config_type[$type][$com]['seo']) { ?>
            <div class="card card-primary card-outline text-sm">
                <div class="card-header">
                    <h3 class="card-title">Nội dung SEO</h3>
                    <a class="btn btn-sm bg-gradient-success d-inline-block text-white float-right create-seo" title="Tạo SEO">Tạo SEO</a>
                </div>
                <div class="card-body">
                    <?php
                    $seoDB = $seo->getSeoDB($id, $com, 'man', $type);
                    include TEMPLATE . LAYOUT . "seo.php";
                    ?>
                </div>
            </div>
        <?php } ?>
        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="submit" class="btn btn-sm bg-gradient-success submit-check" name="save-here"><i class="far fa-save mr-2"></i>Lưu tại trang</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?= $linkMan ?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
            <input type="hidden" name="id" value="<?= $item['id'] ?>">
        </div>
    </form>
</section>

<?php if ($config_type[$type][$com]['giakm']) { ?>
    <script type="text/javascript">
        function roundNumber(rnum, rlength) {
            return Math.round(rnum * Math.pow(10, rlength)) / Math.pow(10, rlength);
        }
        $(document).ready(function() {

            $(".gia_ban, .gia_moi").keyup(function() {
                var gia_ban = $('.gia_ban').val();
                var gia_moi = $('.gia_moi').val();
                var gia_km = 0;

                if (gia_ban == '' || gia_ban == '0' || gia_moi == '' || gia_moi == '0') {
                    gia_km = 0;
                } else {
                    gia_ban = gia_ban.replace(/,/g, "");
                    gia_moi = gia_moi.replace(/,/g, "");
                    gia_ban = parseInt(gia_ban);
                    gia_moi = parseInt(gia_moi);

                    if (gia_moi < gia_ban) {
                        gia_km = 100 - ((gia_moi * 100) / gia_ban);
                        gia_km = roundNumber(gia_km, 0);
                    } else {
                        gia_km = 0;
                    }
                }
                $('.gia_km').val(gia_km);
            })
        })
    </script>
<?php } ?>
