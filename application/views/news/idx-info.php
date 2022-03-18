<!-- Blog Details Section Begin -->
<section class="blog-details spad">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8">
                <div class="blog__details__title">
                    <h6>
                        <?php
                        if ($getpost['tags'] == 1) {
                            echo 'News';
                        } else if ($getpost['tags'] == 2) {
                            echo 'Update';
                        } else if ($getpost['tags'] == 3) {
                            echo 'Event';
                        } else if ($getpost['tags'] == 4) {
                            echo 'Notice';
                        }
                        ?>
                        <span><?= $getpost['date'] ?></span><br><br>
                        <span>Authors : <?= $getpost['authors'] ?></span><span></span>
                    </h6>
                    <h2><?= $getpost['judul'] ?></h2>

                </div>
            </div>
            <div class="col-lg-12">
                <div class="blog__details__pic">
                    <img src="<?= $getpost['banner'] ?>" alt="">
                </div>
            </div>
            <div class="col-lg-8">
                <div class="blog__details__content">
                    <div class="blog__details__text">
                        <p><?= $getpost['detail'] ?></p>
                    </div>

                    <div class="blog__details__tags">
                        <a href="#">
                            <?php
                            if ($getpost['tags'] == 1) {
                                echo 'News';
                            } else if ($getpost['tags'] == 2) {
                                echo 'Update';
                            } else if ($getpost['tags'] == 3) {
                                echo 'Event';
                            } else if ($getpost['tags'] == 4) {
                                echo 'Notice';
                            }
                            ?>

                        </a>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
</section>
<!-- Blog Details Section End -->



<!-- Search model Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch"><i class="icon_close"></i></div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
<!-- Search model end -->

<!-- Js Plugins -->
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/player.js"></script>
<script src="../js/jquery.nice-select.min.js"></script>
<script src="../js/mixitup.min.js"></script>
<script src="../js/jquery.slicknav.js"></script>
<script src="../js/owl.carousel.min.js"></script>
<script src="../js/main.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>