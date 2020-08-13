
<!-- Content Header -->
<section class="content-header text-sm">
	<div class="container-fluid">
		<div class="row">
			<ol class="breadcrumb float-sm-left">
				<li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
				<li class="breadcrumb-item active"><?= $labelAct ?> <?= $config_type['product'][$type]['title_main'] ?></li>
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
				<?php
				if ($config_type['product'][$type]['slug']) {
					$slugchange = ($act == 'edit') ? 1 : 0;
					$copy = ($act != 'copy') ? 0 : 1;
					include TEMPLATE . LAYOUT . "slug.php";
				}
				?>
				<div class="card card-primary card-outline text-sm">
					<div class="card-header">
						<h3 class="card-title">Nội dung <?= $config_type['product'][$type]['title_main'] ?></h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
						</div>
					</div>
					<div class="card-body">
						<div class="card card-primary card-outline card-outline-tabs">
							<div class="card-header p-0 border-bottom-0">
								<ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
									<?php foreach ($config['website']['lang']as $k => $v) { ?>
										<li class="nav-item">
											<a class="nav-link <?= ($k == 'vi') ? 'active' : '' ?>" id="tabs-lang" data-toggle="pill" href="#tabs-lang-<?= $k ?>" role="tab" aria-controls="tabs-lang-<?= $k ?>" aria-selected="true"><?= $v ?></a>
										</li>
									<?php } ?>
								</ul>
							</div>
							<div class="card-body card-article">
								<div class="tab-content" id="custom-tabs-three-tabContent-lang">
									<?php foreach ($config['website']['lang']as $k => $v) { ?>
										<div class="tab-pane fade show <?= ($k == 'vi') ? 'active' : '' ?>" id="tabs-lang-<?= $k ?>" role="tabpanel" aria-labelledby="tabs-lang">
											<div class="form-group">
												<label for="ten<?= $k ?>">Tiêu đề (<?= $k ?>):</label>
												<input type="text" class="form-control for-seo" name="data[ten<?= $k ?>]" id="ten<?= $k ?>" placeholder="Tiêu đề (<?= $k ?>)" value="<?= $item['ten' . $k] ?>" <?= ($k == 'vi') ? 'required' : '' ?>>
											</div>
											<?php if ($config_type['product'][$type]['mota']) { ?>
												<div class="form-group">
													<label for="mota<?= $k ?>">Mô tả (<?= $k ?>):</label>
													<textarea class="form-control for-seo <?= ($config_type['product'][$type]['mota_cke']) ? 'form-control-ckeditor' : '' ?>" name="data[mota<?= $k ?>]" id="mota<?= $k ?>" rows="5" placeholder="Mô tả (<?= $k ?>)"><?= htmlspecialchars_decode($item['mota' . $k]) ?></textarea>
												</div>
											<?php } ?>
											<?php if ($config_type['product'][$type]['noidung']) { ?>
												<div class="form-group">
													<label for="noidung<?= $k ?>">Nội dung (<?= $k ?>):</label>
													<textarea class="form-control for-seo <?= ($config_type['product'][$type]['noidung_cke']) ? 'form-control-ckeditor' : '' ?>" name="data[noidung<?= $k ?>]" id="noidung<?= $k ?>" rows="5" placeholder="Nội dung (<?= $k ?>)"><?= htmlspecialchars_decode($item['noidung' . $k]) ?></textarea>
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
			<div class="<?= $colRight ?>">
				<?php if ($config_type['product'][$type]['dropdown'] || $config_type['product'][$type]['brand'] || $config_type['product'][$type]['tags'] || $config_type['product'][$type]['mau'] || $config_type['product'][$type]['size']) { ?>
					<div class="card card-primary card-outline text-sm">
						<div class="card-header">
							<h3 class="card-title">Danh mục <?= $config_type['product'][$type]['title_main'] ?></h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
							</div>
						</div>
						<div class="card-body">
							<div class="form-group-category row">
								<?php if ($config_type['product'][$type]['dropdown']) { ?>
									<?php if ($config_type['product'][$type]['list']) { ?>
										<div class="form-group col-xl-6 col-sm-4">
											<label class="d-block" for="id_list">Danh mục cấp 1:</label>
											<?= get_main_list() ?>
										</div>
									<?php } ?>
									<?php if ($config_type['product'][$type]['cat']) { ?>
										<div class="form-group col-xl-6 col-sm-4">
											<label class="d-block" for="id_cat">Danh mục cấp 2:</label>
											<?= get_main_cat() ?>
										</div>
									<?php } ?>
									<?php if ($config_type['product'][$type]['item']) { ?>
										<div class="form-group col-xl-6 col-sm-4">
											<label class="d-block" for="id_item">Danh mục cấp 3:</label>
											<?= get_main_item() ?>
										</div>
									<?php } ?>
									<?php if ($config_type['product'][$type]['sub']) { ?>
										<div class="form-group col-xl-6 col-sm-4">
											<label class="d-block" for="id_sub">Danh mục cấp 4:</label>
											<?= get_main_sub() ?>
										</div>
									<?php } ?>
								<?php } ?>
								<?php if ($config_type['product'][$type]['brand']) { ?>
									<div class="form-group col-xl-6 col-sm-4">
										<label class="d-block" for="id_brand">Danh mục hãng:</label>
										<?= get_main_brand() ?>
									</div>
								<?php } ?>
								<?php if ($config_type['product'][$type]['tags']) { ?>
									<div class="form-group col-xl-6 col-sm-4">
										<label class="d-block" for="id_tags">Danh mục tags:</label>
										<?= get_tags($item['id']) ?>
									</div>
								<?php } ?>
								<?php if ($config_type['product'][$type]['mau']) { ?>
									<div class="form-group col-xl-6 col-sm-4">
										<label class="d-block" for="id_mau">Danh mục màu sắc:</label>
										<?= get_mau($item['id']) ?>
									</div>
								<?php } ?>
								<?php if ($config_type['product'][$type]['size']) { ?>
									<div class="form-group col-xl-6 col-sm-4">
										<label class="d-block" for="id_size">Danh mục kích thước:</label>
										<?= get_size($item['id']) ?>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				<?php } ?>

				<?php if ($config_type['product'][$type]['images']) { ?>
					<div class="card card-primary card-outline text-sm">
						<div class="card-header">
							<h3 class="card-title">Hình ảnh <?= $config_type['product'][$type]['title_main'] ?></h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
							</div>
						</div>
						<div class="card-body">
							<?php
							$photoDetail = UPLOAD_PRODUCT . $item['photo'];
							$dimension = "Width: " . $config_type['product'][$type]['width'] . " px - Height: " . $config_type['product'][$type]['height'] . " px (" . $config_type['product'][$type]['img_type'] . ")";
							include TEMPLATE . LAYOUT . "image.php";
							?>
						</div>
					</div>
				<?php } ?>

				<?php if ($flagGallery) { ?>
					<div class="card card-primary card-outline text-sm">
						<div class="card-header">
							<h3 class="card-title">Bộ sưu tập <?= $config_type['product'][$type]['title_main'] ?></h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
							</div>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label for="filer-gallery" class="label-filer-gallery mb-3">Album hình: (<?= $config_type['product'][$type]['gallery'][$key]['img_type_photo'] ?>)</label>
								<input type="file" name="files[]" id="filer-gallery" multiple="multiple">
								<input type="hidden" class="col-filer" value="col-xl-6 col-sm-3 col-6">
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
											<?php foreach ($gallery as $v) galleryFiler($v['stt'], $v['id'], $v['photo'], $v['tenvi'], 'product', 'col-xl-6 col-sm-3 col-6'); ?>
										</ul>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="card card-primary card-outline text-sm">
			<div class="card-header">
				<h3 class="card-title">Thông tin <?= $config_type['product'][$type]['title_main'] ?></h3>
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
				<?php if ($config_type['product'][$type]['file']) { ?>
					<div class="form-group">
						<label class="change-file mb-1 mr-2" for="file-taptin">
							<p>Upload tập tin:</p>
							<strong class="ml-2">
								<span class="btn btn-sm bg-gradient-success"><i class="fas fa-file-upload mr-2"></i>Chọn tập tin</span>
								<div><b class="text-sm text-split"></b></div>
							</strong>
						</label>
						<strong class="d-block mt-2 mb-2 text-sm"><?php echo $config_type['product'][$type]['file_type']; ?></strong>
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
					<?php if ($config_type['product'][$type]['ma']) { ?>
						<div class="form-group col-md-4">
							<label class="d-block" for="masp">Mã sản phẩm:</label>
							<input type="text" class="form-control" name="data[masp]" id="masp" placeholder="Mã sản phẩm" value="<?= $item['masp'] ?>">
						</div>
					<?php } ?>
					<?php if ($config_type['product'][$type]['gia']) { ?>
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
					<?php if ($config_type['product'][$type]['giamoi']) { ?>
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
					<?php if ($config_type['product'][$type]['giakm']) { ?>
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
					<?php if ($config_type['product'][$type]['link']) { ?>
						<div class="form-group col-md-4">
							<label for="link">Link:</label>
							<input type="text" class="form-control" name="data[link]" id="link" placeholder="Link" value="<?= $item['link'] ?>">
						</div>
					<?php } ?>
					<?php if ($config_type['product'][$type]['video']) { ?>
						<div class="form-group col-md-4">
							<label for="link_video">Video:</label>
							<input type="text" class="form-control" name="data[link_video]" id="link_video" placeholder="Video" value="<?= $item['link_video'] ?>">
						</div>
					<?php } ?>
					<?php if ($config_type['product'][$type]['tinhtrang']) { ?>
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
		<?php if ($config_type['product'][$type]['seo']) { ?>
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

<?php if ($config_type['product'][$type]['giakm']) { ?>
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
