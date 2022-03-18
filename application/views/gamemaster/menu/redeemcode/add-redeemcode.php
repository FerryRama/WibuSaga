<div class="content-body" style="min-height: 1092px;">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('gamemaster'); ?>">Home</a></li>
                <li class="breadcrumb-item active"><a href="<?= base_url('gamemaster/addredeemcode'); ?>">Add Redeem Code</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('gamemaster/historyredeemcode'); ?>">History Redeem Code</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Post</h4>
                    </div>

                    <div class="card-body">
                        <div id="smartwizard" class="form-wizard order-create sw sw-theme-default sw-justified">
                            <form action="<?= base_url('gamemaster/addredeemcode'); ?>" method="post">
                                <div class="tab-content" style="height: 460px;">
                                    <div id="wizard_Service" class="tab-pane" role="tabpanel" style="display: block;">
                                        <div class="row">
                                            <div class="col-lg-12 mb-3">
                                                <div class="form-group">
                                                    <?= form_error('accountIDX', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    <input type="text" name="accountIDX" class="form-control" value="<?= $user['accountIDX']; ?>" hidden>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <div class="form-group">
                                                    <label class="text-label">RedeemCodeBy* : <?= $user['nickName']; ?></label> <?= form_error('nickName', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    <input type="text" name="nickName" class="form-control" value="<?= $user['nickName']; ?>" hidden>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Redeem Code*</label> <?= form_error('redeem_code', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    <input type="text" value="<?= set_value('redeem_code'); ?>" name="redeem_code" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Item Name?*</label> <?= form_error('item_name', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    <input type="text" value="<?= set_value('item_name'); ?>" name="item_name" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Share Discord?:*<?= set_value('discordshare'); ?> </label><?= form_error('discordshare', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    <div class="form-group">
                                                        <select class="form-control default-select" name="discordshare">
                                                            <option name="discordshare" value="<?= set_value('discordshare'); ?>"><?= set_value('discordshare'); ?></option>
                                                            <option name="discordshare" value="yesshare">Share Discord</option>
                                                            <option name="discordshare" value="noshare">No Share Discord</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Expired Date*</label><?= form_error('expired', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    <input type="date" value="<?= set_value('expired'); ?>" name="expired" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Present Type*</label><?= form_error('present_type', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    <input type="number" value="<?= set_value('present_type'); ?>" name="present_type" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Item Code (Value 1)*</label><?= form_error('item_code', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    <input type="number" value="<?= set_value('item_code'); ?>" name="item_code" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Item Code (Value 2)*</label><?= form_error('item_amount', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    <input type="number" value="<?= set_value('item_amount'); ?>" name="item_amount" class="form-control" placeholder="">
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