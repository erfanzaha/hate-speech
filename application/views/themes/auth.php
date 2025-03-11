<html>
<!-- BEGIN : Head-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets/logo-usu.png">
    <title><?= APP_NAME ?></title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/auth/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/auth/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/auth/css/style.css">
    <style>
    .account-title {
        font-size: 15px;
        font-weight: bold;
    }
    </style>
</head>

<body>
    <?= $_config_content ?>
    <script src="<?= base_url() ?>assets/auth/js/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url() ?>assets/auth/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/auth/js/adminkit.js"></script>
    <script src="<?= base_url() ?>assets/auth/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/auth/js/app.js"></script>
    <?= $js ?>
</body>
<!-- END : Body-->

</html>