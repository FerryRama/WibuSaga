    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href=""><i class="fa fa-home"></i> Home</a>
                        <a href="<?= base_url('user'); ?>"><i class="fa"></i> Profile</a>
                        <span>Change Password</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Anime Section Begin -->
    <section class="anime-details spad">
        <div class="container">
            <div class="anime__details__content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="anime__details__pic set-bg" data-setbg="<?= base_url('vendor/wibu/'); ?>img/anime/details-pic.jpg">
                            <div class="comment"><i class="fa fa-comments"></i> 11</div>
                            <div class="view"><i class="fa fa-eye"></i> 9141</div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <?= $this->session->flashdata('message'); ?>
                                <h3>Change Password : <?= $user['userID']; ?></h3>
                                <div class="anime__details__widget">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <form action="<?= base_url('user/changepassword'); ?>" method="post">
                                                <ul>
                                                    <li>
                                                        <div class="form-group">
                                                            <label for="current_password">Current Password</label>
                                                            <input type="password" class="form-control" id="current_password" aria-describedby="current_password" name="current_password">
                                                            <?= form_error('current_password', '<small class="text-danger pl-3">', '</small>'); ?>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-group">
                                                            <label for="new_password1">New Password</label>
                                                            <input type="password" class="form-control" id="new_password1" aria-describedby="new_password1" name="new_password1">
                                                            <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-group">
                                                            <label for="new_password2">Repeat Password</label>
                                                            <input type="password" class="form-control" id="new_password2" aria-describedby="new_password2" name="new_password2">
                                                        </div>
                                                    </li>
                                                </ul>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group anime__details__btn">

                                    <button type="submit" class="btn watch-btn"><span>Change Password</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Anime Section End -->