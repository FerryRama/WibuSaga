<!DOCTYPE html>
<html lang="ko">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <title><?= $title ?></title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('vendor/wibu/banner'); ?>/css/common.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('vendor/wibu/banner'); ?>/css/etc.css">
    <script type="text/javascript" src="<?= base_url('vendor/wibu/banner'); ?>/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?= base_url('vendor/wibu/banner'); ?>/js/jquery.bxslider.min.js"></script>
    <script type="text/javascript" src="<?= base_url('vendor/wibu/banner'); ?>/js/autoupgrade.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-45196362-49"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-45196362-49');
    </script>

    <!-- 190425 배틀모드 마케팅 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-748971650"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'AW-748971650');
    </script>
    <!-- Facebook Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '2224696041179974');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=2224696041179974&ev=PageView&noscript=1" /></noscript>
    <!-- End Facebook Pixel Code -->


</head>

<body>
    <div id="autoupgrade">
        <h1 class="blind">Banner WibuSaga</h1>
        <div class="bnrArea">
            <h2 class="blind">배너</h2>
            <ul id="autoBnrList">
                <?php foreach ($slider as $s) : ?>
                    <li><a href="<?= base_url('/news/idx/'); ?><?= $s['id'] ?>" target="_blank"><img src="<?= $s['banner'] ?>" alt="Banner" /></a></li>
                <?php endforeach ?>
            </ul>
        </div>
        <ul class="mainNotice">
            <li class="tabCon01">
                <h2><a href="#">New Info</a></h2>
                <div>

                    <ul>
                        <?php foreach ($getallpost as $post) : ?>
                            <li><a href="<?= base_url('news/idx/' . $post['id']); ?>" target="_blank"><strong class="fcRed"> <?php
                                                                                                                                if ($post['tags'] == 1) {
                                                                                                                                    echo '[News] ';
                                                                                                                                } else if ($post['tags'] == 2) {
                                                                                                                                    echo '[Update] ';
                                                                                                                                } else if ($post['tags'] == 3) {
                                                                                                                                    echo '[Event] ';
                                                                                                                                } else if ($post['tags'] == 4) {
                                                                                                                                    echo '[Notice] ';
                                                                                                                                }
                                                                                                                                ?></strong><?= $post['judul'] ?></a></li>
                        <?php endforeach ?>

                    </ul>

                </div>
            </li>

            <li class="tabCon02">
                <h2><a href="#">Event</a></h2>
                <div>
                    <ul>
                        <?php foreach ($top as $t) : ?>

                            <li><a href="<?= base_url('news/idx/') ?><?= $t['id'] ?>" target="_blank"><strong class="fcRed"><?php
                                                                                                                            if ($t['tags'] == 1) {
                                                                                                                                echo '[News] ';
                                                                                                                            } else if ($t['tags'] == 2) {
                                                                                                                                echo '[Update] ';
                                                                                                                            } else if ($t['tags'] == 3) {
                                                                                                                                echo '[Event] ';
                                                                                                                            } else if ($t['tags'] == 4) {
                                                                                                                                echo '[Notice] ';
                                                                                                                            }
                                                                                                                            ?></strong><?= $t['judul'] ?></a></li>
                        <?php endforeach ?>

                    </ul>
                </div>
            </li>
        </ul>

        <div class="plazaTalk">
            <h2>Server Status</h2>
            <div>

                <ul>

                    <li><strong class="fcRed">
                            <?php foreach ($statuslauncher as $stats) : ?>

                                <?php
                                if ($stats['status'] == 0) {
                                    echo '<img src="' . base_url('vendor/wibu/banner') . '/images/offline.png">';
                                } else if ($stats['status'] == 1) {
                                    echo '<img src="' . base_url('vendor/wibu/banner') . '/images/Online.png">';
                                } else {
                                    echo '<img src="' . base_url('vendor/wibu/banner') . '/images/offline.png">';
                                }
                                ?>
                            <?php endforeach ?>

                        </strong></a></li>


                </ul>

            </div>

        </div>
    </div>
</body>



</html>