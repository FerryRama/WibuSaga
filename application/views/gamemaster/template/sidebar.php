<!--**********************************
            Sidebar start
        ***********************************-->
<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li class="<?= $postinganshow ?>"><a class=" has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-list-1"></i>
                    <span class=" nav-text">Menu Postingan</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="<?= base_url('gamemaster/addnewpostingan'); ?>" class="<?= $postingan1 ?>">Add New Post</a></li>
                    <li><a href="<?= base_url('gamemaster/allpost'); ?>" class="<?= $postingan2 ?>">History Post</a></li>
                </ul>
            </li>
            <li class="<?= $redeemshow ?>"><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-settings-6"></i>
                    <span class="nav-text">Launcher Configuration</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="<?= base_url('gamemaster/statuslauncher'); ?>" class="<?= $redem1 ?>">Status Launcher</a></li>
                    <li><a href="<?= base_url('gamemaster/bannerlauncher'); ?>" class="<?= $redem2 ?>">Banner Launcher</a></li>
                </ul>
            <li class="<?= $redeemshow ?>"><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-gift"></i>
                    <span class="nav-text">Redeem Code</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="<?= base_url('gamemaster/addredeemcode'); ?>" class="<?= $redem1 ?>">Add RedeemCode</a></li>
                    <li><a href="<?= base_url('gamemaster/historyredeemcode'); ?>" class="<?= $redem2 ?>">History Redeem Code</a></li>
                </ul>
            <li class="<?= $giftitemshow ?>"><a class=" has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-gift"></i>
                    <span class=" nav-text">Gift Item</span>
                </a>
                <ul aria-expanded="false">
                    <!-- <li><a href="<?= base_url('gamemaster/addredeemcode'); ?>" class="<?= $giftitem1 ?>">Add RedeemCode</a></li> -->
                    <li><a href="<?= base_url('gamemaster/historygiftitem'); ?>" class="<?= $giftitem2 ?>">History Gift Item</a></li>
                </ul>
            </li>
            <li class="<?= $giftcashshow ?>"><a class=" has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-gift"></i>
                    <span class=" nav-text">Send Cash</span>
                </a>
                <ul aria-expanded="false">
                    <!-- <li><a href="<?= base_url('gamemaster/addrcash'); ?>" class="<?= $giftcash1 ?>">Add RedeemCode</a></li> -->
                    <li><a href="<?= base_url('gamemaster/historysendcash'); ?>" class="<?= $giftcash2 ?>">History Send Cash</a></li>
                </ul>
            </li>
            <li class="<?= $linkupdateshow ?>"><a class=" has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-link"></i>
                    <span class=" nav-text">Link Update</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="<?= base_url('gamemaster/historydownloadlink'); ?>" class="<?= $linkupdate ?>">Link Download</a></li>
                    <li><a href="<?= base_url('gamemaster/historylinkdonation'); ?>" class="<?= $donate1 ?>">Link Donation</a></li>
                </ul>
            </li>
            <div class=" copyright">
                <p>Copyright &copy; WibuSaga <?= date('Y'); ?></p>
            </div>
    </div>
</div>
<!--**********************************
            Sidebar end
        ***********************************-->