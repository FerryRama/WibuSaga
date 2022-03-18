<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?> <?= $user['userID']; ?></title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="<?= base_url('vendor/wibu/'); ?>css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('vendor/wibu/'); ?>css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('vendor/wibu/'); ?>css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('vendor/wibu/'); ?>css/plyr.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('vendor/wibu/'); ?>css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('vendor/wibu/'); ?>css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('vendor/wibu/'); ?>css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('vendor/wibu/'); ?>css/style.css" type="text/css">
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
                        <a href="<?= base_url('user'); ?>">
                            <img src="<?= base_url('vendor/wibu/'); ?>img/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li class="<?= $homepage; ?>"><a href="<?= base_url('user'); ?>">Home</a></li>
                                <li class="<?= $download; ?>"><a>WibuSaga<span class="arrow_carrot-down"></span></a>
                                    <ul class="dropdown">
                                        <li><a href="<?= base_url('downloaddonation/downloads'); ?>">Download</a></li>
                                        <li><a href="<?= base_url('downloaddonation/donate'); ?>">Donation</a></li>
                                    </ul>
                                </li>
                                <li class="<?= $cash; ?>"><a href=" <?= base_url('user/dailycash'); ?>">Daily Cash</a></li>
                                <li class="<?= $redeem; ?>"><a href=" <?= base_url('user/redeemcode'); ?>">Redeem Code</a></li>
                                <li class="<?= $setting; ?>"><a>Account Setting <span class="arrow_carrot-down"></span></a>
                                    <ul class="dropdown">
                                        <li><a href="<?= base_url('user/changepassword'); ?>">Change Password</a></li>
                                        <li><a href="<?= base_url('user/historycash'); ?>">History Daily Cash</a></li>
                                        <li><a href="<?= base_url('user/historyredeem'); ?>">History Redeem</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="header__right" style="color: white;">
                        <?= $user['userID']; ?> <a href="<?= base_url('auth/logout'); ?>"><span class="icon_profile"></span></a>
                    </div>
                </div>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    <!-- Header End -->