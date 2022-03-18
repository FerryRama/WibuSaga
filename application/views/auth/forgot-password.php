<!-- Normal Breadcrumb Begin -->
<section class="normal-breadcrumb set-bg" data-setbg="<?= base_url('vendor/wibu/'); ?>img/normal-breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="normal__breadcrumb__text">
                    <h2>Forgot Password</h2>
                    <p>Check Email To Verify Forgot Password.</p>
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
                <div class="login__form">
                    <center>
                        <h3>Forgot Password</h3>
                        <?= $this->session->flashdata('message'); ?>
                        <form class="user" method="post" action="<?= base_url('auth/forgotpassword'); ?>">
                            <div class="input__item">
                                <input id="email" name="email" value="<?= set_value('email'); ?>" type="text" placeholder="Email" />
                                <span class="icon_mail"></span> <?= form_error('email', '<small class="text-warning pl-3">', '</small>'); ?>
                            </div>
                            <button type="submit" class="site-btn">Forgot Password</button>
                        </form>
                        <center>
                            <a href="<?= base_url('auth'); ?>" class="forget_pass">
                                <- Back Login</a>
                </div>
            </div>


        </div>
</section>
<!-- Login Section End -->