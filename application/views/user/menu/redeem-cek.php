<!-- Normal Breadcrumb Begin -->
<section class="normal-breadcrumb set-bg" data-setbg="<?= base_url('vendor/wibu/'); ?>img/normal-breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="normal__breadcrumb__text">
                    <h2>Redeem Information</h2>
                    <p>Code Redeem: <?= $this->session->userdata('saved_code'); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Normal Breadcrumb End -->

<!-- Login Section Begin -->
<section class="login spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-11">
                <center>


                    <div class="login__form">
                        <h3><?= $this->session->flashdata('message'); ?>
                            <div class="input__item" style="color: white;">
                                <span class="icon_gift" style="color: white;"> </span><?= $codee['item_name']; ?>
                        </h3>


                        <form class="user" method="post" action="<?= base_url('user/cekredeemcode'); ?>">
                            <div class="input__item">
                                <input id="accountIDX" name="accountIDX" type="text" value="<?= $user['accountIDX']; ?>" placeholder="Account IDX" hidden />
                                <span class="icon_gift" hidden></span><?= form_error('accountIDX', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="input__item">
                                <input id="nickname_received" name="nickname_received" type="text" value="<?= $user['nickName']; ?>" placeholder="Received" hidden />
                                <span class="icon_gift" hidden></span><?= form_error('nickname_received', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="input__item">
                                <input id="nickname_sender" name="nickname_sender" type="text" value="<?= $codee['nickname']; ?>" placeholder="GM Sender" hidden />
                                <span class="icon_gift" hidden></span><?= form_error('nickname_sender', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="input__item">
                                <input id="item_code" name="item_code" type="text" value="<?= $codee['item_code']; ?>" placeholder="Item Code" hidden />
                                <span class="icon_gift" hidden></span> <?= form_error('item_code', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="input__item">
                                <input id="item_name" name="item_name" type="text" value="<?= $codee['item_name']; ?>" placeholder="Item Name" hidden />
                                <span class="icon_gift" hidden></span><?= form_error('item_name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="input__item">
                                <input id="expired" name="expired" type="text" value="<?= $codee['expired']; ?>" placeholder="Expired" hidden />
                                <span class="icon_gift" hidden></span><?= form_error('expired', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="input__item">
                                <input id="code" name="code" type="text" value="<?= $codee['code']; ?>" placeholder="Code" hidden />
                                <span class="icon_gift" hidden></span><?= form_error('code', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="input__item">
                                <input id="present_type" name="present_type" type="text" value="<?= $codee['present_type']; ?>" placeholder="Present Type" hidden />
                                <span class="icon_gift" hidden></span><?= form_error('present_type', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="input__item">
                                <input id="item_amount" name="item_amount" type="text" value="<?= $codee['item_amount']; ?>" placeholder="item Amount" hidden />
                                <span class="icon_gift" hidden></span><?= form_error('item_amount', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <button type="submit" class="btn site-btn">Redeem Now?</button>
                        </form>
                </center>
            </div>
        </div>


    </div>
</section>
<!-- Login Section End -->