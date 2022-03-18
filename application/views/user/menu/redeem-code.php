<!-- Signup Section Begin -->
<section class="signup spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login__form">
                    <h3>Redeem Code</h3>
                    <?= $this->session->flashdata('message'); ?>
                    <form action="<?= base_url('user/redeemcode'); ?>" method="post">
                        <div id="result"></div>
                        <div class="input__item">
                            <input id="code" type="text" placeholder="Code" name="code" />
                            <span class="icon_star"></span>
                            <?= form_error('code', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <button type="submit" class="btn site-btn">Cek Reward Now?</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login__register">
                    <h3>History Redeeem</h3>
                    <a href="<?= base_url('user/historyredeem'); ?>" class="primary-btn">History</a>
                </div>
            </div>
        </div>
        <div style="height:180px;"></div>

    </div>
</section>