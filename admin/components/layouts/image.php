<!-- <div class="photoUpload-zone clearfix row">
	<div class="photoUpload-detail col-md-8" id="photoUpload-preview"><img class="rounded" src="<?= $photoDetail ?>" onerror="src='assets/images/noimage.png'" alt="Alt Photo"/></div>
	<label class="photoUpload-file col-md-4" id="photo-zone" for="file-zone">
		<input type="file" name="file" id="file-zone">
		<i class="fas fa-cloud-upload-alt"></i>
		<p class="photoUpload-drop">Kéo và thả hình vào đây</p>
		<p class="photoUpload-or">hoặc</p>
		<p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>
	</label>
	<div class="photoUpload-dimension"><?= $dimension ?></div>
</div> -->

<div class="photoUpload-zone">

    <?php if ($item['photo']) : ?>
        <div class="photoUpload-detail" id="photoUpload-preview"><img class="rounded" src="<?= $photoDetail ?>" onerror="noImg(this, <?= $config_current['image']['width'] ?>, <?= $config_current['image']['height'] ?>)" alt="Alt Photo"></div>
    <?php endif; ?>

    <input id="input_image" name="image" type="file" class="file">
</div>



<script>
    $("#input_image").fileinput({
        theme: "fas",
        showUpload: false,
        showRemove: false,
        showPreview: false,
        browseOnZoneClick: false,
        maxFileSize: 10000, // KB
        initialPreviewAsData: true,
        allowedFileExtensions: <?= json_encode(explode('|', $config_current['image']['mine_type'])) ?>,
        <?php if ($item['photo']) : ?>
            initialPreview: [<?= "'" . $photoDetail . "'" ?>],
        <?php endif; ?>
    });
</script>
