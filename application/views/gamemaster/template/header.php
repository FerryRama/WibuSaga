<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= $title ?></title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('vendor/xhtml/'); ?>images/favicon.png">
    <link rel="stylesheet" href="<?= base_url('vendor/xhtml/'); ?>vendor/chartist/css/chartist.min.css">
    <link href="<?= base_url('vendor/xhtml/'); ?>vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="<?= base_url('vendor/xhtml/'); ?>vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="<?= base_url('vendor/xhtml/'); ?>css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="<?= base_url('gamemaster'); ?>" class="brand-logo">
                <img class="logo-abbr" src="<?= base_url('vendor/wibu/'); ?>img/logo.png" alt="">
                <img class="logo-compact" src="<?= base_url('vendor/wibu/'); ?>img/logo.png" alt="">
                <img class="brand-title" src="<?= base_url('vendor/wibu/'); ?>img/logo.png" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->