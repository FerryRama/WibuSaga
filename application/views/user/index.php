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
                        <div class="anime__details__pic set-bg" data-setbg="<?= base_url('assets/img/profile/') . $user['image'] ?>">
                            <div class="comment"><i class="fa fa-comments"></i> 11</div>
                            <div class="view"><i class="fa fa-eye"></i> 9141</div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <?= $this->session->flashdata('message'); ?>
                                <h3>Welcome <?= $user['userID']; ?></h3>
                                <span>Role : <?php
                                                $user = $this->db->get_where('userMemberDB', ['userID' => $this->session->userdata('userID')])->row_array();
                                                if ($user['role_id'] == 1) {
                                                    echo 'Adminstrator/Developer';
                                                } elseif ($user['role_id'] == 2) {
                                                    echo 'GameMaster';
                                                } else {
                                                    echo 'User';
                                                } ?></span>
                            </div>
                            <p>Your Profile Info</p>
                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>AccountIDX:</span> <?= $user['accountIDX']; ?></li>
                                            <li><span>Username:</span> <?= $user['userID']; ?></li>
                                            <li><span>Nickname:</span> <?= $user['nickName']; ?></li>
                                            <li><span>Email:</span> <?= $user['email']; ?></li>
                                            <li><span>Register Date:</span> <?= $user['regDate']; ?></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>UserEXP:</span> <?= number_format($user1['userEXP'], '0', '.', '.') ?></li>
                                            <li><span>Peso:</span> <?= number_format($user1['gameMoney'], '0', '.', '.') ?></li>
                                            <li><span>Cash:</span> <?= number_format($user1['realCash'], '0', '.', '.') ?></li>
                                            <li><span>BonusCash:</span> <?= number_format($user1['bonusCash'], '0', '.', '.') ?></li>
                                            <li><span>Faction:</span> <?php
                                                                        if ($user1['regionType'] == 1) {
                                                                            echo 'The Orde';
                                                                        } else if ($user1['regionType'] == 2) {
                                                                            echo 'The Legion';
                                                                        } else {
                                                                            echo 'Noset';
                                                                        }
                                                                        ?> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="anime__details__btn">
                                <?php
                                $user = $this->db->get_where('userMemberDB', ['userID' => $this->session->userdata('userID')])->row_array();
                                if ($user['role_id'] == 1) {
                                    echo '<a href="admin" class="follow-btn"><i class="fa fa-heart-o"></i>Adminstrator Panel</a>';
                                } elseif ($user['role_id'] == 2) {
                                    echo '<a href="gamemaster" class="follow-btn"><i class="fa fa-heart-o"></i>Game Master Panel</a>';
                                } else {
                                } ?>

                                <a href="<?= base_url('auth/logout'); ?>" class="watch-btn"><span>Logout</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>
    <!-- Anime Section End -->