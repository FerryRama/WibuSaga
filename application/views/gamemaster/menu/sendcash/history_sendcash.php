<div class="content-body" style="min-height: 1092px;">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('gamemaster'); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="" data-toggle="modal" data-target="#AddCashNew">Add Send Cash</a></li>
                <li class="breadcrumb-item active"><a href="<?= base_url('gamemaster/historysendcash'); ?>">History Send Cash</a></li>
            </ol>
        </div>
        <!-- row -->



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">History Send Cash By : <?= $user['nickName']; ?></h4>
                        <div id='date-time'></div>
                    </div>
                    <div class="card-header">
                        <div><?= $this->session->flashdata('message'); ?></div>
                        <a class="btn btn-primary" href="" data-toggle="modal" data-target="#AddCashNew">Send Cash</a>
                    </div>
                    <div class="card-body">
                        <div class="card-header">
                            <div style="color: red;">Note : used only for events and may not be used for personal purposes, given 3x sanctions if a violation will be issued as a gamemaster<br> Log automatic send to discord <br> Maximal Send 10.000 Cash</div>
                        </div>
                        <div class="table-responsive">
                            <table id="example" class="display min-w850">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sender</th>
                                            <th>Received</th>
                                            <th>Total Cash</th>
                                            <th>Date Send</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sender</th>
                                            <th>Received</th>
                                            <th>Total Cash</th>
                                            <th>Date Send</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <?php foreach ($gethistorycash as $cash) : ?>
                                        <tbody>
                                            <tr>
                                                <td><?= $cash['nick'] ?></td>
                                                <td><?= $cash['nickname'] ?></td>
                                                <td><?= number_format($cash['cash'], '0', '.', '.') ?></td>
                                                <td><?= $cash['date'] ?></td>
                                                <td>
                                                    <a href="" data-toggle="modal" data-target="#DeleteModal<?= $cash['id']; ?>" class="btn btn-danger shadow btn-xs sharp fa fa-trash"></a>
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

<div class="modal fade" id="AddCashNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Send Cash Form</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('gamemaster/addsendcash'); ?>" method="post">
                    <div class="col-lg-12 mb-2">
                        <div class="form-group">
                            <label class="text-label">UserID*</label>
                            <input type="text" value="<?= set_value('userID'); ?>" name="userID" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-lg-12 mb-2">
                        <div class="form-group">
                            <label class="text-label">Cash*</label>
                            <input type="number" value="<?= set_value('cash'); ?>" name="cash" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-lg-12 mb-2">
                        <div class="form-group">
                            <input type="text" value="<?= $user['nickName']; ?>" name="sendnick" class="form-control" placeholder="" hidden>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-2">
                        <div class="form-group">
                            <input type="text" value="<?= $user['accountIDX']; ?>" name="accountIDX" class="form-control" placeholder="" hidden>
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

<?php foreach ($gethistorycash as $cash) : ?>
    <!-- Delete Modal-->
    <div class="modal fade" id="DeleteModal<?= $cash['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <a class="btn btn-primary" href="<?= base_url('gamemaster/deletehistorycash/') ?><?= $cash['id'] ?>">Delete?</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>