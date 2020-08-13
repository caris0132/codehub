<?php
use App\Core\Helper;
?>
<!-- Main Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 text-sm">
    <!-- Logo -->
    <a class="brand-link" href="index.php">
        <img class="brand-image" src="assets/images/nina.png" alt="Nina">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent text-sm" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Bảng điều khiển -->
                <?php
                $active = "";
                if ($com == 'index' || $com == '') $active = 'active';
                ?>
                <li class="nav-item <?= $active ?>">
                    <a class="nav-link <?= $active ?>" href="index.php" title="Bảng điều khiển">
                        <i class="nav-icon text-sm fas fa-tachometer-alt"></i>
                        <p>Bảng điều khiển</p>
                    </a>
                </li>

                <!-- Sản phẩm -->
                <li class="nav-item has-treeview">
                    <?php $active = ($type == 'san-pham') ? 'active' : ''; ?>
                    <a class="nav-link <?= $active ?>" href="#" title="Quản lý sản phẩm">
                        <i class="nav-icon text-sm fas fa-boxes"></i>
                        <p>Quản lý Sản phẩm<i class="right fas fa-angle-left"></i></p>
                    </a>

                    <ul class="nav nav-treeview">
                        <?php Helper::getMenuPermission('Danh mục cấp 1', 'product_list', 'man', 'san-pham') ?>
                        <?php Helper::getMenuPermission('Danh mục cấp 2', 'product_cat', 'man', 'san-pham') ?>
                        <?php Helper::getMenuPermission('Danh mục cấp 3', 'product_item', 'man', 'san-pham') ?>
                        <?php Helper::getMenuPermission('Danh mục cấp 4', 'product_sub', 'man', 'san-pham') ?>
                        <?php Helper::getMenuPermission('Danh mục hãng', 'product_brand', 'man', 'san-pham') ?>
                        <?php Helper::getMenuPermission('Danh mục màu sắc', 'product_color', 'man', 'san-pham') ?>
                        <?php Helper::getMenuPermission('Danh mục kích thước', 'product_size', 'man', 'san-pham') ?>
                        <?php Helper::getMenuPermission('Sản phẩm', 'product', 'man', 'san-pham') ?>
                        <?php Helper::getMenuPermission('Import', 'import', 'man', 'san-pham') ?>
                        <?php Helper::getMenuPermission('Export', 'export', 'man', 'san-pham') ?>
                    </ul>
                </li>

                <!-- Bài viết (Có cấp) -->
                <li class="nav-item has-treeview">
                    <?php $active = ($type == 'tin-tuc') ? 'active' : ''; ?>
                    <a class="nav-link <?= $active ?>" href="#" title="Quản lý tin tức">
                        <i class="nav-icon text-sm fas fa-boxes"></i>
                        <p>Quản lý tin tức<i class="right fas fa-angle-left"></i></p>
                    </a>

                    <ul class="nav nav-treeview">
                        <?php Helper::getMenuPermission('Danh mục cấp 1', 'news_list', 'man', 'tin-tuc') ?>
                        <?php Helper::getMenuPermission('Danh mục cấp 2', 'news_cat', 'man', 'tin-tuc') ?>
                        <?php Helper::getMenuPermission('Danh mục cấp 3', 'news_item', 'man', 'tin-tuc') ?>
                        <?php Helper::getMenuPermission('Danh mục cấp 4', 'news_sub', 'man', 'tin-tuc') ?>
                        <?php Helper::getMenuPermission('Tin tức', 'news', 'man', 'tin-tuc') ?>
                    </ul>
                </li>

                <!-- Bài viết (Không cấp) -->
                <li class="nav-item has-treeview">
                    <?php $active = in_array($type, array_keys($config_type_baiviet)) ? 'active' : ''; ?>
                    <a class="nav-link <?= $active ?>" href="#" title="Quản lý bài viết">
                        <i class="nav-icon text-sm fas fa-boxes"></i>
                        <p>Quản lý bài viết<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php foreach ($config_type_baiviet as $key_bv => $item_bv) : ?>
                            <?php //Helper::getMenuPermission($item_bv['title_main'], 'news', 'man', $key_bv)
                            ?>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <!-- Cart -->
                <?php Helper::getMenuPermission('Quản lý đơn hàng', 'order', 'man', '', 'fas fa-shopping-bag') ?>

                <!-- Coupon -->
                <?php Helper::getMenuPermission('Quản lý mã ưu đãi', 'coupon', 'man', '', 'fas fa-qrcode') ?>

                <!-- Tags -->
                <li class="nav-item has-treeview">
                    <?php $active = ($com == 'tags') ? 'active' : ''; ?>
                    <a class="nav-link <?= $active ?>" href="#" title="Tags">
                        <i class="nav-icon text-sm fas fa-tags"></i>
                        <p>Tags<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php Helper::getMenuPermission('Tags Sản phẩm', 'tags', 'man', 'san-pham') ?>
                        <?php Helper::getMenuPermission('Tags tin tức', 'tags', 'man', 'tin-tuc') ?>
                    </ul>
                </li>

                <!-- Newsletter -->
                <li class="nav-item has-treeview">
                    <?php $active = ($com == 'newsletter') ? 'active' : ''; ?>
                    <a class="nav-link <?= $active ?>" href="#" title="Quản lý nhận tin">
                        <i class="nav-icon text-sm fas fa-envelope"></i>
                        <p>Quản lý nhận tin<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php Helper::getMenuPermission('Đăng ký nhận tin', 'newsletter', 'man', 'dangkynhantin') ?>
                    </ul>
                </li>

                <!-- Static -->
                <li class="nav-item has-treeview">
                    <?php $active = ($com == 'static') ? 'active' : ''; ?>
                    <a class="nav-link <?= $active ?>" href="#" title="Quản lý trang tĩnh">
                        <i class="nav-icon text-sm fas fa-envelope"></i>
                        <p>Quản lý trang tĩnh<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php foreach ($config_type['static'] as $key_type => $item_type) : ?>
                            <?php Helper::getMenuPermission($item_type['title_main'], 'static', 'capnhat', $key_type) ?>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <!-- Gallery -->
                <li class="nav-item has-treeview">
                    <?php $active = ($com == 'photo') ? 'active' : ''; ?>
                    <a class="nav-link <?= $active ?>" href="#" title="Quản lý hình ảnh - video">
                        <i class="nav-icon text-sm fas fa-photo-video"></i>
                        <p>Quản lý hình ảnh - video<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php foreach ($config_type['photo'] as $key_photo => $item_photo) : ?>
                            <?php foreach ($item_photo as $key_type => $item_type) : ?>
                                <?php Helper::getMenuPermission($item_type['title_main'], 'photo', $key_photo, $key_type) ?>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <!-- Địa điểm -->
                <?php if ($config_type['places']['active']) : ?>
                    <li class="nav-item has-treeview">
                        <?php $active = ($com == 'places') ? 'active' : ''; ?>
                        <a class="nav-link <?= $active ?>" href="#" title="Quản lý địa điểm">
                            <i class="nav-icon text-sm fas fa-building"></i>
                            <p>Quản lý địa điểm<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php Helper::getMenuPermission('Tỉnh thành', 'places', 'man_city') ?>
                            <?php Helper::getMenuPermission('Quận huyện', 'places', 'man_district') ?>
                            <?php Helper::getMenuPermission('Phường xã', 'places', 'man_wards') ?>
                            <?php Helper::getMenuPermission('Đường', 'places', 'man_street') ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <!-- User -->
                <?php if ($config_type['user']['active'] && $config_type['permission'] && !check_permission()) : ?>
                    <li class="nav-item has-treeview">
                        <?php $active = ($com == 'user' && $act != 'login' && $act != 'logout') ? 'active' : ''; ?>
                        <a class="nav-link <?= $active ?>" href="#" title="Quản lý user">
                            <i class="nav-icon text-sm fas fa-users"></i>
                            <p>Quản lý user<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php Helper::getMenuPermission('Nhóm quyền', 'user', 'permission_group') ?>
                            <?php Helper::getMenuPermission('Thông tin admin', 'user', 'admin_edit') ?>
                            <?php Helper::getMenuPermission('Tài khoản admin', 'user', 'man_admin') ?>
                            <?php Helper::getMenuPermission('Tài khoản khách', 'user', 'man') ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <!-- Onesignal -->
                <?php Helper::getMenuPermission('Quản lý thông báo đẩy', 'pushOnesignal', 'man', '', 'fas fa-bell') ?>

                <!-- SEO page -->
                <li class="nav-item has-treeview">
                    <?php $active = ($com == 'seopage') ? 'active' : ''; ?>
                    <a class="nav-link <?= $active ?>" href="#" title="Quản lý SEO page">
                        <i class="nav-icon text-sm fas fa-share-alt"></i>
                        <p>Quản lý SEO page<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php foreach ($config_type['seopage']['page'] as $key_type => $item_type) : ?>
                            <?php Helper::getMenuPermission($item_type, 'seopage', 'capnhat', $key_type) ?>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <!-- Thiết lập thông tin -->
                <?php Helper::getMenuPermission('Thiết lập thông tin', 'setting', 'capnhat', '', 'fas fa-cogs') ?>

            </ul>
        </nav>
    </div>
</aside>
