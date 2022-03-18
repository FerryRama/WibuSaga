<!-- Normal Breadcrumb Begin -->
<section class="normal-breadcrumb set-bg" data-setbg="<?= base_url('vendor/wibu/'); ?>img/normal-breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="normal__breadcrumb__text">
                    <h2>Change Password</h2>
                    <p>Your Email : <?= $this->session->userdata('reset_email'); ?></p>
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
                        <h3>Change Password</h3>
                        <?= $this->session->flashdata('message'); ?>
                        <form class="user" method="post" action="<?= base_url('auth/changepassword'); ?>">
                            <div class="input__item">
                                <input id="password1" name="password1" type="password" placeholder="Password" />
                                <span class="icon_lock"></span> <?= form_error('password1', '<small class="text-warning pl-3">', '</small>'); ?>
                            </div>
                            <div class="input__item">
                                <input id="password2" name="password2" type="password" placeholder="Re-password" />
                                <span class="icon_lock"></span> <?= form_error('password2', '<small class="text-warning pl-3">', '</small>'); ?>
                            </div>
                            <button type="submit" class="site-btn">Change Password</button>
                        </form>
                </center>
            </div>
        </div>


    </div>
</section>
<!-- Login Section End -->