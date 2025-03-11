<!DOCTYPE html>
<html lang="en" class="loading">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Apex admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Apex admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title><?= basicConfig('title web')->description ?></title>
    <link rel="apple-touch-icon" href="<?= base_url() ?>assets/portal/images/favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets/portal/images/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link
        href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Montserrat:300,400,500,600,700,800,900"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/admin/fonts/feather/style.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/admin/fonts/simple-line-icons/style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/admin/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/admin/vendors/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/admin/vendors/css/prism.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/admin/css/app.css">
</head>
<body data-col="1-column" class=" 1-column  blank-page">
    <div class="wrapper">
        <div class="main-panel">
            <!-- BEGIN : Main Content-->
            <div class="main-content">
                <div class="content-wrapper">
                    <!--Error page starts-->
                    <section id="error">
                        <div class="container-fluid forgot-password-bg overflow-hidden">
                            <div class="row full-height-vh">
                                <div class="col-12 d-flex align-items-center justify-content-center">
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <img src="<?= base_url() ?>assets/admin/img/gallery/error.png" alt=""
                                                class="img-fluid error-img mt-2" height="300" width="500">
                                            <h1 class="text-white mt-4">404 - Page Not Found!</h1>
                                            <button class="btn btn-primary btn-lg mt-3"><a href="<?= base_url('admin/dashboard') ?>"
                                                    class="text-decoration-none text-white">Back
                                                    To Home</a></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--Error page ends-->

                </div>
            </div>
            <!-- END : End Main Content-->
        </div>
    </div>
    <script src="<?= base_url() ?>assets/admin/vendors/js/core/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/admin/vendors/js/core/popper.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/admin/vendors/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/admin/vendors/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/admin/vendors/js/prism.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/admin/vendors/js/jquery.matchHeight-min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/admin/vendors/js/screenfull.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/admin/vendors/js/pace/pace.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/admin/js/app-sidebar.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/admin/js/notification-sidebar.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/admin/js/customizer.js" type="text/javascript"></script>
</body>
</html>