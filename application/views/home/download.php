    <!-- Normal Breadcrumb Begin -->
    <section class="normal-breadcrumb set-bg" data-setbg="<?= base_url('vendor/wibu/'); ?>/img/normal-breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>Download</h2>
                        <p>Client Or Other Files</p><br>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Normal Breadcrumb End -->
    <div class="card mb-5" style="background: hsl(240deg 64% 8%);border-radius: 15px;"></div>
    <div class="card-body">
        <div class="text-uppercase fw-bold px-5">
            <p class="text-white">Here you can see the download link.
            </p>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-dark border-dark border border-primary">
                    <thead>
                        <tr class="text-white">
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Description</th>
                            <th scope="col">Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($getexp as $m) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $m['nama'] ?></td>
                                <td><?= $m['description'] ?>
                                <td><a href="<?= $m['link'] ?>" class="site-btn">Download</a>
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