    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href=""><i class="fa fa-home"></i> Home</a>
                        <span>Profile</span>
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
                                <h3>Edit Profile <?= $user['userID']; ?></h3>
                                <div class="anime__details__widget">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <?= form_open_multipart('user/edit'); ?>
                                            <ul>
                                                <li>
                                                    <div class="form-group row">
                                                        <label for="email" class="col-sm-2 col-form-label" style="color: white;">Email</label>
                                                        <div class="col-sm-10">
                                                            <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                                                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group row">
                                                        <label for="username" class="col-sm-2 col-form-label" style="color: white;">UserID</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="username" name="username" value="<?= $user['userID']; ?>" readonly>
                                                            <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                                        </div>
                                                </li>
                                                <li>
                                                    <div class="form-group row">
                                                        <div class="col-sm-2">Picture</div>
                                                        <div class="col-sm-10">
                                                            <div class="row">
                                                                <div class="col-sm3">
                                                                    <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class="img-thumbnail" style="height: 37px" ;>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" id="image" name="image">
                                                                        <label class="custom-file-label" for="image">Choose file</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                                <div class="anime__details__btn">
                                    <button type="sumbit" class="btn btn-primary">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Anime Section End -->