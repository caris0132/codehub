<body class="sidebar-mini hold-transition text-sm">
    <?php include COMPONENTS . "layout/loader.php"; ?>
    <!-- Wrapper -->
    <div class="wrapper">
        <?php
        include COMPONENTS . "layouts/header.php";
        include COMPONENTS . "layouts/menu.php";
        ?>
        <div class="content-wrapper">
            <?php if ($alertlogin) { ?>
                <section class="content">
                    <div class="container-fluid">
                        <div class="alert my-alert alert-warning alert-dismissible text-sm bg-gradient-warning mt-3 mb-0">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="icon fas fa-exclamation-triangle"></i> <?= $alertlogin ?>
                        </div>
                    </div>
                </section>
            <?php } ?>
            <?php include TEMPLATE . $template . "_tpl.php"; ?>
        </div>
        <?php include TEMPLATE . "layout/footer.php"; ?>
        <?php include "assets/js/myscript.php"; ?>
    </div>
</body>
