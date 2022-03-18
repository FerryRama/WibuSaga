<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="WibuSaga Private Server :)">
    <meta name="keywords" content="LostSaga, Lost Saga, LS, LostSaga2021, lostsaga, lost saga private server, ls private server">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $getpost['judul'] ?></title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href=" <?= base_url('vendor/wibu/'); ?>css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href=" <?= base_url('vendor/wibu/'); ?>css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href=" <?= base_url('vendor/wibu/'); ?>css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href=" <?= base_url('vendor/wibu/'); ?>css/plyr.css" type="text/css">
    <link rel="stylesheet" href=" <?= base_url('vendor/wibu/'); ?>css/nice-select.css" type="text/css">
    <link rel="stylesheet" href=" <?= base_url('vendor/wibu/'); ?>css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href=" <?= base_url('vendor/wibu/'); ?>css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href=" <?= base_url('vendor/wibu/'); ?>css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a href="<?= base_url(); ?>">
                            <img src=" <?= base_url('vendor/wibu/'); ?>img/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li class="<?= $home ?>"><a href="<?= base_url(''); ?>">Homepage</a></li>
                                <li class="<?= $download ?>"><a href="<?= base_url('downloaddonation/download'); ?>">Download</a></li>
                                <li class="<?= $rank ?>"><a href="">Top 10 Rank<span class="arrow_carrot-down"></span></a>
                                    <ul class="dropdown">
                                        <li><a href="<?= base_url('toprank/tentoprank'); ?>">Top 10 Rank User</a></li>
                                        <li><a href="<?= base_url('toprank/tentopguild'); ?>">Top 10 Guild</a></li>
                                    </ul>
                                </li>
                                <li class="<?= $donation ?>"><a href="<?= base_url('downloaddonation/donation'); ?>">Donation</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="header__right">
                        <a href="#" class="search-switch"><span class="icon_search"></span></a>
                        <a href="<?= base_url('auth'); ?>"><span class="icon_profile"></span></a>
                    </div>
                </div>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    <!-- Header End -->