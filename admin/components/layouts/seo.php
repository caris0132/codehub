<!-- SEO -->
<?php

use App\Core\Lang;
use App\Core\Seo;

if ($com && $item['id']) {
    $seoDB = Seo::getSEOByComID($com, $item['id']);
}
if ($com == "static" || $com == "seopage") {
    foreach ($config['website']['comlang'] as $k => $v) {
        if ($type == $k) {
            $slugurlArray = $v;
            break;
        }
    }
}
?>
<div class="card-seo">
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                <?php foreach (Lang::$arrayLang as $k => $v) {
                    $seo_create .= $k . ","; ?>
                    <li class="nav-item">
                        <a class="nav-link <?= ($k == 'vi') ? 'active' : '' ?>" id="tabs-lang" data-toggle="pill" href="#tabs-seolang-<?= $k ?>" role="tab" aria-controls="tabs-seolang-<?= $k ?>" aria-selected="true">SEO (<?= $v ?>)</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                <?php foreach (Lang::$arrayLang as $k => $v) { ?>
                    <div class="tab-pane fade show <?= ($k == 'vi') ? 'active' : '' ?>" id="tabs-seolang-<?= $k ?>" role="tabpanel" aria-labelledby="tabs-lang">
                        <div class="form-group">
                            <div class="label-seo">
                                <label for="title<?= $k ?>">SEO Title (<?= $k ?>):</label>
                                <strong class="count-seo"><span><?= strlen(utf8_decode($seoDB[$k]['title'])) ?></span>/70 ký tự</strong>
                            </div>
                            <input type="text" class="form-control check-seo title-seo" name="dataSeo[<?= $k ?>][title]" id="title<?= $k ?>" placeholder="SEO Title (<?= $k ?>)" value="<?= $seoDB[$k]['title'] ?>">
                        </div>
                        <div class="form-group">
                            <div class="label-seo">
                                <label for="keywords<?= $k ?>">SEO Keywords (<?= $k ?>):</label>
                                <strong class="count-seo"><span><?= strlen(utf8_decode($seoDB[$k]['keywords'])) ?></span>/70 ký tự</strong>
                            </div>
                            <input type="text" class="form-control check-seo keywords-seo" name="dataSeo[<?= $k ?>][keywords]" id="keywords<?= $k ?>" placeholder="SEO Keywords (<?= $k ?>)" value="<?= $seoDB[$k]['keywords'] ?>">
                        </div>
                        <div class="form-group">
                            <div class="label-seo">
                                <label for="description<?= $k ?>">SEO Description (<?= $k ?>):</label>
                                <strong class="count-seo"><span><?= strlen(utf8_decode($seoDB[$k]['description'])) ?></span>/160 ký tự</strong>
                            </div>
                            <textarea class="form-control check-seo description-seo" name="dataSeo[<?= $k ?>][description]" id="description<?= $k ?>" rows="5" placeholder="SEO Description (<?= $k ?>)"><?= $seoDB[$k]['description'] ?></textarea>
                        </div>

                        <!-- SEO preview -->
                        <div class="form-group form-group-seo-preview">
                            <label class="label-seo-preview">Khi lên top, page này sẽ hiển thị theo dạng mẫu như sau:</label>
                            <div class="seo-preview">
                                <p class="slug-seo-preview" id="seourlpreview<?= $k ?>" data-seourlstatic="0"><?= $config_base ?>/<strong><?= Lang::Link($item['tenkhongdau'], $k) ?></strong></p>

                                <?php
                                $title_default = $item['ten_' . $k] ? $item['ten_' . $k] : 'Title';
                                $description_default = $item['mota_' . $k] ? strip_tags($item['mota_' . $k]) : 'Description';
                                ?>

                                <p class="title-seo-preview text-split" id="title-seo-preview<?= $k ?>"><?= $SeoDB[$k]['title'] ? $SeoDB[$k]['title'] : $title_default ?></p>

                                <p class="description-seo-preview text-split" id="description-seo-preview<?= $k ?>"><?= $SeoDB[$k]['description'] ? $SeoDB[$k]['description'] : $description_default ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <input type="hidden" id="seo-create" value="<?= ($seo_create) ? rtrim($seo_create, ",") : '' ?>">
    </div>
</div>
