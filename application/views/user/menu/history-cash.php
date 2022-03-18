    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="<?= base_url('user'); ?>"><i class="fa fa-home"></i> Home</a>
                        <a href="<?= base_url('user'); ?>"><i class="fa"></i> Profile</a>
                        <span>History Daily Cash</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                <div class="card mb-5" style="background: hsl(240deg 64% 8%);border-radius: 15px;"></div>
                <div class="card-body">
                    <div class="text-uppercase fw-bold px-5">
                        <p class="text-white">Here you can see your history dailycash.
                        </p> <?= $this->session->flashdata('message'); ?>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-dark border-dark border border-primary">
                                <thead>
                                    <tr class="text-white">
                                        <th scope="col">No</th>
                                        <th scope="col">Bonus Cash</th>
                                        <th scope="col">Date Claim</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($gethistory as $cash) : ?>
                                        <tr>
                                            <th scope="row"><?= ++$start; ?></th>
                                            <td><?= $cash['cash'] ?></td>
                                            <td><?= $cash['date'] ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                            <?= $this->pagination->create_links(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="height:346px;"></div>
    </div>