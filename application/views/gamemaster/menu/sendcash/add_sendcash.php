<div class="content-body" style="min-height: 1092px;">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('gamemaster'); ?>">Home</a></li>
                <li class="breadcrumb-item active"><a href="<?= base_url('gamemaster/addsendcash'); ?>">Add Send Cash</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('gamemaster/historysendcash'); ?>">History Send Cash</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Send Cash</h4>
                        <div id='date-time'></div>
                    </div>
                    <div class="card-header">
                        <div><?= $this->session->flashdata('message'); ?></div>
                    </div>
                    <div class="card-body">
                        <div id="smartwizard" class="form-wizard order-create sw sw-theme-default sw-justified">
                            <form action="<?= base_url('gamemaster/addsendcash'); ?>" method="post">
                                <div class="tab-content" style="height: 460px;">
                                    <div id="wizard_Service" class="tab-pane" role="tabpanel" style="display: block;">
                                        <div class="row">
                                            <div class="col-lg-12 mb-3">
                                                <div class="form-group">
                                                    <input type="text" value="<?= $user['accountIDX']; ?>" name="accountIDX" class="form-control" placeholder="" hidden>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <div class="form-group">
                                                    <input type="text" value="<?= $user['nickName']; ?>" name="sendnick" class="form-control" placeholder="" hidden>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">UserID*</label><?= form_error('userID', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    <input type="text" value="<?= set_value('userID'); ?>" name="userID" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Cash*</label><?= form_error('cash', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    <input type="number" value="<?= set_value('cash'); ?>" name="cash" class="form-control" placeholder="">
                                                </div>
                                            </div>



                                        </div>
                                    </div>


                                </div>
                        </div>
                        <div class="toolbar toolbar-bottom" role="toolbar" style="text-align: right;"> <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddPostinganModal" href="">Submit</a></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>

<!-- Logout Modal-->
<div class="modal fade" id="AddPostinganModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Is everything correct?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Post information will be automatically entered into discord.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </div>
    </div>
</div>
</form>