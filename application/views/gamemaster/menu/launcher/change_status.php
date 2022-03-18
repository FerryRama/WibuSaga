<div class="content-body" style="min-height: 1092px;">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('gamemaster'); ?>">Home</a></li>
                <li class="breadcrumb-item active"><a href=""><?php if ($total_online['status'] == 1) {
                                                                    echo 'Launcher Online';
                                                                } elseif ($total_online['status'] == 0) {
                                                                    echo 'Launcher Offline';
                                                                } else {
                                                                    echo 'Server Offline';
                                                                } ?></a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Status Launcher : <?php if ($total_online['status'] == 1) {
                                                                        echo 'Launcher Online';
                                                                    } elseif ($total_online['status'] == 0) {
                                                                        echo 'Launcher Offline';
                                                                    } else {
                                                                        echo 'Server Offline';
                                                                    } ?></h4>
                        <div><?= $this->session->flashdata('message'); ?></div>
                    </div>
                    <div class="card-body">
                        <div id="smartwizard" class="form-wizard order-create sw sw-theme-default sw-justified">
                            <form action="<?= base_url('gamemaster/statuslauncher'); ?>" method="post">
                                <div class="tab-content" style="height: 150px;">
                                    <div id="wizard_Service" class="tab-pane" role="tabpanel" style="display: block;">
                                        <div class="row">
                                            <div class="col-lg-12 mb-3">
                                                <div class="form-group">
                                                    <?= form_error('idx', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    <input type="text" name="idx" class="form-control" value="<?= $total_online['idx']; ?>" hidden>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <div class="form-group">
                                                    <label class="text-label">Change Status?:* <?php if ($total_online['status'] == 1) {
                                                                                                    echo 'Launcher Online';
                                                                                                } elseif ($total_online['status'] == 0) {
                                                                                                    echo 'Launcher Offline';
                                                                                                } else {
                                                                                                    echo 'Server Offline';
                                                                                                } ?> </label><?= form_error('status', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    <div class="form-group">
                                                        <select class="form-control default-select" name="status">
                                                            <option name="status" value="<?= $total_online['status']; ?>"></option>
                                                            <option name="status" value="1">Status Online</option>
                                                            <option name="status" value="0">Status Offline</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="toolbar toolbar-bottom" role="toolbar" style="text-align: right;"> <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#statuslauncher" href="">Submit</a></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Logout Modal-->
<div class="modal fade" id="statuslauncher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Is everything correct?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Launcher Status Change ?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </div>
    </div>
</div>
</form>