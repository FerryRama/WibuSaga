<!-- Normal Breadcrumb Begin -->
<section class="normal-breadcrumb set-bg" data-setbg="<?= base_url('vendor/wibu/'); ?>img/normal-breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="normal__breadcrumb__text">
                    <h2>Login</h2>
                    <p>Welcome to the official Anime blog.</p>
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
            <div class="col-lg-6">
                <div class="login__form">
                    <h3>Login</h3>
                    <?= $this->session->flashdata('message'); ?>
                    <form class="user" method="post" action="login">
                        <div class="input__item">
                            <input id="username" name="username" value="<?= set_value('username'); ?>" type="text" placeholder="Username" minlength="7" maxlength="14" />
                            <span class="icon_profile"></span> <?= form_error('username', '<small class="text-warning pl-3">', '</small>'); ?>
                        </div>
                        <div class="input__item">
                            <input id="password" name="password" type="password" placeholder="Password" />
                            <span class="icon_lock"></span> <?= form_error('password', '<small class="text-warning pl-3">', '</small>'); ?>
                        </div>
                        <button type="submit" class="site-btn">Login Now</button>
                    </form>
                    <a href="<?= base_url('auth/forgotpassword'); ?>" class="forget_pass">Forgot Your Password?</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login__register">
                    <h3>Dont’t Have An Account?</h3>
                    <a href="<?= base_url('auth/register'); ?>" class="primary-btn">Register Now</a>
                </div>
            </div>
        </div>
        <div class="login__social">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6">
                    <div class="login__social__links">
                        <span>or</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Login Section End -->