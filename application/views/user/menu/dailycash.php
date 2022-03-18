    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="<?= base_url('user'); ?>"><i class="fa fa-home"></i> Home</a>
                        <a href="<?= base_url('user'); ?>"><i class="fa"></i> Profile</a>
                        <span>Daily Cash</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <center>
        <div class="d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card mb-5" style="background: hsl(238deg 58% 10%); border-radius: 15px; margin-top: 100px;">
                    <div class="card-body" style="background: #070720;">

                        <h1 class="text-custom text-uppercase fw-bold" style="color: white;">Daily Cash</h1>
                        <?= $this->session->flashdata('message'); ?><p style=color:white;>You Have BonusCash Total : <b style=color:green;> <?= $user1['bonusCash']; ?></b>
                        <p class="text-custom fw-bold" style="color: white;">Pro tip: Pray before use this feature!</p>
                        <hr>
                        <div class="register-account">
                            <form action="<?= base_url('user/dailycash'); ?>" method="post">
                                <div class="text-custom text-center" style="color: white;">
                                    You can get the free cash from 50 - 500 Cash for everyday.
                                </div>
                                <div class="form-group">
                                    <input type="accountIDX" class="form-control" id="accountIDX" value="<?= $user['accountIDX']; ?>" aria-describedby="accountIDX" name="accountIDX" hidden>
                                    <?= form_error('accountIDX', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="username" class="form-control" id="username" value="<?= $user['userID']; ?>" aria-describedby="username" name="username" hidden>
                                    <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="bonusCash" class="form-control" id="bonusCash" value="<?= $user1['bonusCash']; ?>" aria-describedby="bonusCash" name="bonusCash" hidden>
                                    <?= form_error('bonusCash', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group anime__details__btn">
                                    <button type="submit" class="btn watch-btn"><span>Submit</span></button>
                                </div>

    </center>
    </div>
    </div>
    <div style="height: 140px;"></div>
    </div>
    </div>
    </div>