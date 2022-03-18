<div class="content-body" style="min-height: 1092px;">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('gamemaster'); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('gamemaster/addredeemcode'); ?>">Add Redeem Code</a></li>
                <li class="breadcrumb-item active"><a href="<?= base_url('gamemaster/historyredeemcode'); ?>">History Redeem Code</a></li>
            </ol>
        </div>
        <!-- row -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">History Redeem Code By : <?= $user['nickName'] ?></h4>
                        <div id='date-time'> </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display min-w850">
                                <div><?= $this->session->flashdata('message'); ?></div>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Item Name</th>
                                            <th>Code Redeem</th>
                                            <th>Expired Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Item Name</th>
                                            <th>Code Redeem</th>
                                            <th>Expired Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <?php foreach ($gethistory as $post) : ?>
                                        <tbody>
                                            <tr>
                                                <td><?= $post['item_name'] ?></td>
                                                <td><?= $post['code'] ?></td>
                                                <td><?= $post['expired'] ?></td>
                                                <td><a href="" data-toggle="modal" data-target="#EditRedeem<?php echo $post['code']; ?>" class=" btn btn-primary shadow btn-xs sharp mr-1 fa fa-pencil"></a>
                                                    <a href="" data-toggle="modal" data-target="#DeleteModal" class="btn btn-danger shadow btn-xs sharp fa fa-trash"></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    <?php endforeach ?>

                                </table>
                        </div> <?= $this->pagination->create_links(); ?>

                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
    </div>
</div>
<!-- End of Main Content -->
<!-- ADD Modal-->
<?php foreach ($gethistory as $post) : ?>
    <div class="modal fade" id="EditRedeem<?php echo $post['code']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Redeem Code : <?php echo $post['code']; ?></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('gamemaster/editredeemcode'); ?>" method="post">
                        <div class="col-lg-12 mb-2">
                            <div class="form-group">
                                <input type="text" value="<?= $post['id']; ?>" name="id" class="form-control" placeholder="" hidden>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-2">
                            <div class="form-group">
                                <label class="text-label">Redeem Code</label> <?= form_error('redeem_code', '<small class="text-danger pl-3">', '</small>'); ?>
                                <input type="text" value="<?= $post['code']; ?>" name="redeem_code" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-lg-12 mb-2">
                            <div class="form-group">
                                <label class="text-label">Item Name?*</label> <?= form_error('item_name', '<small class="text-danger pl-3">', '</small>'); ?>
                                <input type="text" value="<?= $post['item_name']; ?>" name="item_name" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-lg-12 mb-2">
                            <div class="form-group">
                                <label class="text-label">Present Type*</label> <?= form_error('present_type', '<small class="text-danger pl-3">', '</small>'); ?>
                                <input type="number" value="<?= $post['present_type']; ?>" name="present_type" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-lg-12 mb-2">
                            <div class="form-group">
                                <label class="text-label">Item Value (1)*</label> <?= form_error('item_code', '<small class="text-danger pl-3">', '</small>'); ?>
                                <input type="number" value="<?= $post['item_code']; ?>" name="item_code" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-lg-12 mb-2">
                            <div class="form-group">
                                <label class="text-label">Item Value (2)*</label> <?= form_error('item_amount', '<small class="text-danger pl-3">', '</small>'); ?>
                                <input type="number" value="<?= $post['item_amount']; ?>" name="item_amount" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-lg-12 mb-2">
                            <div class="form-group">
                                <label class="text-label">Expired*</label> <?= form_error('expired', '<small class="text-danger pl-3">', '</small>'); ?>
                                <input type="date" value="<?= $post['expired']; ?>" name="expired" class="form-control" placeholder="">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </div>
    </div>
    </form>
<?php endforeach ?>

<!-- Delete Modal-->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">are you sure want to delete?.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('gamemaster/deleteredeemcode/') ?><?= $post['code'] ?>">Delete?</a>
            </div>
        </div>
    </div>
</div>