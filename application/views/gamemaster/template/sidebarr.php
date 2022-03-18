<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('gamemaster') ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-solid fa-camera"></i>
        </div>
        <div class="sidebar-brand-text mx-3">GM-Panel<sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-fw fa-sticky-note"></i>
            <span>Postingan Menu</span>
        </a>
        <div id="collapseThree" class="collapse <?= $postinganshow ?>" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">List Features:</h6>
                <a class="collapse-item <?= $postingan1 ?>" href="<?= base_url('gamemaster/addnewpostingan'); ?>">New Post</a>
                <a class="collapse-item <?= $postingan2 ?>" href="<?= base_url('gamemaster/allpost'); ?>">All Post DB</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLauncher" aria-expanded="true" aria-controls="collapseLauncher">
            <i class="fas fa-fw fa-sticky-note"></i>
            <span>Launcher Configuration</span>
        </a>
        <div id="collapseLauncher" class="collapse <?= $launchershow ?>" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">List Features:</h6>
                <a class="collapse-item <?= $launcher1 ?>" href="javascript:;" onclick="buka('change_status_launcher');">Status Launcher[MT/Online]</a>
                <a class="collapse-item <?= $launcher2 ?>" href="./edit_banner_launcher?idx=1">Banner Launcher</a>
                <a class="collapse-item <?= $launcher3 ?>" href="./edit_keys?idx=1">Api Keys For Launcher</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTen" aria-expanded="true" aria-controls="collapseTen">
            <i class="fas fa-fw fa-sitemap"></i>
            <span>Redeem Code</span>
        </a>
        <div id="collapseTen" class="collapse <?= $redeemshow ?>" aria-labelledby="headingTen" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">List Features:</h6>
                <a class="collapse-item <?= $redem1 ?>" href="<?= base_url('gamemaster/addredeemcode'); ?>">Create Redeem Code</a>
                <a class="collapse-item <?= $redem2 ?>" href="<?= base_url('gamemaster/historyredeemcode'); ?>">History Reddem Code</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
            <i class="fas fa-fw fa-sitemap"></i>
            <span>Gift Item</span>
        </a>
        <div id="collapseSix" class="collapse <?= $giftitemshow ?>" aria-labelledby="headingSix" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">List Features:</h6>
                <a class="collapse-item <?= $giftitem1 ?>" href="javascript:;" onclick="buka('send_item');">Gift Item</a>
                <a class="collapse-item <?= $giftitem1 ?>" href="javascript:;" onclick="buka('gift_item_log');">Gift Item Log</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
            <i class="fas fa-fw fa-sitemap"></i>
            <span>Gift Cash</span>
        </a>
        <div id="collapseSeven" class="collapse <?= $giftcashshow ?>" aria-labelledby="headingSeven" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">List Features:</h6>
                <a class="collapse-item <?= $giftcash1 ?>" href="javascript:;" onclick="buka('send_cash');">Send Cash</a>
                <a class="collapse-item <?= $giftcash2 ?>" href="javascript:;" onclick="buka('gift_cash_log');">Gift Cash Log</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
            <i class="fas fa-fw fa-link"></i>
            <span>Link Update</span>
        </a>
        <div id="collapseFive" class="collapse <?= $linkupdateshow ?>" aria-labelledby="headingFive" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">List Features:</h6>
                <a class="collapse-item <?= $linkupdate ?>" href="javascript:;" onclick="buka('link_add');">Add Link Download</a>
                <a class="collapse-item <?= $linkupdate2 ?>" href="javascript:;" onclick="buka('view_link');">All Link Download</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-link"></i>
            <span>Donate Link</span>
        </a>
        <div id="collapseTwo" class="collapse <?= $donateshow ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">List Features:</h6>
                <a class="collapse-item <?= $donate1 ?>" href="javascript:;" onclick="buka('add_donate');">Add Donate</a>
                <a class="collapse-item <?= $donate2 ?>" href="javascript:;" onclick="buka('donate_view');">List Donate</a>

            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
            <i class="fas fa-fw fa-cog"></i>
            <span>Additional Menu</span>
        </a>
        <div id="collapseFour" class="collapse <?= $aditionalshow ?>" aria-labelledby="headingFour" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">List Features:</h6>
                <a class="collapse-item <?= $aditional1 ?>" href="javascript:;" onclick="buka('decrypt_pc');" hidden>Generate Decrypt PC</a>
                <a class="collapse-item <?= $aditional2 ?>" href="javascript:;" onclick="buka('ban_player');">Ban Player</a>
            </div>
        </div>
    </li>

</ul>
<!-- End of Sidebar -->