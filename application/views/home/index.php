    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="hero__slider owl-carousel">
                <?php foreach ($slider as $s) : ?>
                    <div class="hero__items set-bg" data-setbg="<?= $s['banner'] ?>">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="hero__text">
                                    <div class="label"> <?php
                                                        if ($s['tags'] == 1) {
                                                            echo 'News';
                                                        } else if ($s['tags'] == 2) {
                                                            echo 'Update';
                                                        } else if ($s['tags'] == 3) {
                                                            echo 'Event';
                                                        } else if ($s['tags'] == 4) {
                                                            echo 'Notice';
                                                        }
                                                        ?></div>
                                    <h2><?= $s['judul'] ?></h2>
                                    <p>Authors : <?= $s['authors'] ?></p>
                                    <a href="<?= base_url('/news/idx/'); ?><?= $s['id'] ?>"><span>Read Now</span> <i class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>

            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="trending__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>NOTICE INFO</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__allcategory">
                                    <a href="#" class="primary-btn">News</a> <a href="#" class="primary-btn">Update</a> <a href="#" class="primary-btn">Event</a> <a href="#" class="primary-btn">Notice</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php foreach ($getallpost as $post) : ?>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">


                                        <div class="product__item__pic set-bg">
                                            <a href="<?= base_url('news/idx/') ?><?= $post['id'] ?>"><img src="<?= $post['img'] ?>" class="product__item__pic set-bg;"></a>
                                        </div>
                                        <div class="product__item__text">
                                            <ul>
                                                <li>
                                                    <?php
                                                    if ($post['tags'] == 1) {
                                                        echo 'News';
                                                    } else if ($post['tags'] == 2) {
                                                        echo 'Update';
                                                    } else if ($post['tags'] == 3) {
                                                        echo 'Event';
                                                    } else if ($post['tags'] == 4) {
                                                        echo 'Notice';
                                                    }
                                                    ?></li>
                                            </ul>
                                            <h5><a href="<?= base_url('news/idx/' . $post['id']); ?>"><?= $post['judul'] ?></a></h5>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>

                        </div>
                        <?= $this->pagination->create_links(); ?>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="product__sidebar">
                        <div class="product__sidebar__view">
                            <div class="section-title">
                                <h5>TOP Event</h5>
                            </div>
                            <ul class="filter__controls">
                            </ul>
                            <div class="filter__gallery" id="MixItUpA7B148">
                                <?php foreach ($top as $t) : ?>
                                    <div class="product__sidebar__view__item set-bg mix">
                                        <a href="<?= base_url('news/idx/') ?><?= $t['id'] ?>"><img src="<?= $t['banner'] ?>" class="product__sidebar__view__item set-bg mix"></a>
                                        <div class="ep"><?php
                                                        if ($t['tags'] == 1) {
                                                            echo 'News';
                                                        } else if ($t['tags'] == 2) {
                                                            echo 'Update';
                                                        } else if ($t['tags'] == 3) {
                                                            echo 'Event';
                                                        } else if ($t['tags'] == 4) {
                                                            echo 'Notice';
                                                        }
                                                        ?></div>
                                        <div class="view"><i class="fa fa-calendar"></i> <?= $post['date'] ?></div>
                                        <h5><a href="<?= base_url('news/idx/') ?><?= $t['id'] ?>"><?= $t['judul'] ?></a></h5>
                                    </div>
                                <?php endforeach ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
    <!-- Product Section End -->