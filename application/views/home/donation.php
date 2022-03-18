    <!-- Normal Breadcrumb Begin -->
    <section class="normal-breadcrumb set-bg" data-setbg="<?= base_url('vendor/wibu/'); ?>/img/normal-breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>Donation</h2>
                        <p>Donation With Benefit</p><br>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Normal Breadcrumb End -->
    <div class="card mb-5" style="background: hsl(240deg 64% 8%);border-radius: 15px;"></div>
    <div class="card-body">
        <div class="text-uppercase fw-bold px-5">
            <p class="text-white">Here you can see the Donation List.
            </p>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-dark border-dark border border-primary">
                    <thead>
                        <tr class="text-white">
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Price</th>
                            <th scope="col">Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($donate as $d) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $d['nama'] ?></td>
                                <td><?= $d['price'] ?>
                                <td><a href="<?= $d['link'] ?>" class="site-btn">Donation Now</a>
                                </td>
                            </tr>
                            <?php $i++ ?>
                        <?php endforeach ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </div>