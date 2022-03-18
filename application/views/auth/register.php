<!-- Normal Breadcrumb Begin -->
<section class="normal-breadcrumb set-bg" data-setbg="<?= base_url('vendor/wibu/'); ?>img/normal-breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="normal__breadcrumb__text">
                    <h2>Sign Up</h2>
                    <p>Welcome to the official WibuSaga.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Normal Breadcrumb End -->

<!-- Signup Section Begin -->
<section class="signup spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login__form">
                    <h3>Sign Up</h3>
                    <form class="user" method="post" action="<?= base_url('auth/register'); ?>">
                        <div class="input__item">
                            <input id="username" name="username" value="<?= set_value('username'); ?>" type="text" placeholder="Username" minlength="7" maxlength="14" />
                            <span class="icon_profile"></span> <?= form_error('username', '<small class="text-warning pl-3">', '</small>'); ?>
                        </div>
                        <div class="input__item">
                            <input id="password" name="password" type="password" placeholder="Password" />
                            <span class="icon_lock"></span> <?= form_error('password', '<small class="text-warning pl-3">', '</small>'); ?>
                        </div>
                        <div class="input__item">
                            <input id="repassword" name="repassword" type="password" placeholder="Re-Password" />
                            <span class="icon_lock"></span>
                        </div>
                        <div class="input__item">
                            <input id="email" name="email" type="email" value="<?= set_value('email'); ?>" placeholder="Email" minlength="7" maxlength="50" />
                            <span class="icon_mail"></span>
                            <?= form_error('email', '<small class="text-warning pl-3">', '</small>'); ?>
                        </div>
                        <div class="input__item">
                            <input id="Nickname" name="Nickname" value="<?= set_value('Nickname'); ?>" type="text" placeholder="Nickname" minlength="7" maxlength="14" />
                            <span class="icon_profile"></span> <?= form_error('Nickname', '<small class="text-warning pl-3">', '</small>'); ?>
                        </div>
                        <button type="submit" class="site-btn">Sign Up Now</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login__register">
                    <h3>Have An Account?</h3>
                    <a href="<?= base_url('auth/login'); ?>" class="primary-btn">Login Now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Signup Section End -->