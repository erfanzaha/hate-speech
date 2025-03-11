<!DOCTYPE html>
<html>
<!-- BEGIN : Head-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets/logo-usu.png">
    <title><?= APP_NAME ?></title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/admin/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/admin/plugins/node-waves/waves.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/admin/plugins/animate-css/animate.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/admin/css/style.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/admin/css/themes/all-themes.css" rel="stylesheet" />
    
    <link href="<?= base_url() ?>assets/admin/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="<?= base_url() ?>assets/emojilib/css/emoji.css" rel="stylesheet">    

</head>

<body class="theme-red">
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <div class="overlay"></div>

    <div class="main-wrapper">
        <?= $header ?>
        <?= $navbar ?>
        <section class="content">
            <div class="container-fluid">
                <?= $_config_content ?>
                <?= $modal ?>
            </div>
        </section>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>

    <script src="<?= base_url() ?>assets/admin/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/admin/plugins/bootstrap/js/bootstrap.js"></script>
    <script src="<?= base_url() ?>assets/admin/plugins/bootstrap-select/js/bootstrap-select.js"></script>
    <script src="<?= base_url() ?>assets/admin/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="<?= base_url() ?>assets/admin/plugins/node-waves/waves.js"></script>
    <script src="<?= base_url() ?>assets/admin/js/admin.js"></script>
    <script src="<?= base_url() ?>assets/auth/js/sweetalert.min.js"></script>
    
    <!-- <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script> -->
    <script src="<?= base_url() ?>assets/emojilib/js/config.js"></script>
    <script src="<?= base_url() ?>assets/emojilib/js/util.js"></script>
    <script src="<?= base_url() ?>assets/emojilib/js/jquery.emojiarea.js"></script>
    <script src="<?= base_url() ?>assets/emojilib/js/emoji-picker.js"></script>
    <?= $js ?>
</body>
<!-- END : Body-->

</html>