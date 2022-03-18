<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('gamemaster'); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="" data-toggle="modal" data-target="#AddLinkDownload">Add Link Download</a></li>
                <li class="breadcrumb-item active"><a href="<?= base_url('gamemaster/historydownloadlink'); ?>">History Download Link</a></li>
            </ol>
        </div>
        <!-- row -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">History Download Link</h4>
                        <div id='date-time'> </div>
                    </div>
                    <div class="card-header">
                        <div><?= $this->session->flashdata('message'); ?></div>
                        <a class="btn btn-primary" href="" data-toggle="modal" data-target="#AddLinkDownload">Add Link Download</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display min-w850">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Link</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Link</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <?php foreach ($linkdownload as $linkdownloads) : ?>
                                        <tbody>
                                            <tr>
                                                <td><?= $linkdownloads['id'] ?></td>
                                                <td><?= $linkdownloads['nama'] ?></td>
                                                <td><?= $linkdownloads['description'] ?></td>
                                                <td><?= $linkdownloads['link'] ?></td>
                                                <td><a href="" data-toggle="modal" data-target="#EditModal<?= $linkdownloads['id'] ?>" class="btn btn-primary shadow btn-xs sharp mr-1 fa fa-pencil"></a>
                                                    <a href="" data-toggle="modal" data-target="#DeleteModal<?= $linkdownloads['id']; ?>" class="btn btn-danger shadow btn-xs sharp fa fa-trash"></a>
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

<!-- modol -->
<div class="modal fade" id="AddLinkDownload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Link Download Form</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('gamemaster/addlinkdownload'); ?>" method="post">
                    <div class="col-lg-12 mb-2">
                        <div class="form-group">
                            <label class="text-label">Name*</label>
                            <input type="text" value="<?= set_value('name'); ?>" name="name" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-lg-12 mb-2">
                        <div class="form-group">
                            <label class="text-label">Description*</label>
                            <input type="text" value="<?= set_value('desc'); ?>" name="desc" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-lg-12 mb-2">
                        <div class="form-group">
                            <label class="text-label">Link Download*</label>
                            <input type="text" value="<?= set_value('link'); ?>" name="link" class="form-control" placeholder="">
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

<?php foreach ($linkdownload as $linkdownloads) : ?>
    <!-- Edit Modal-->
    <div class="modal fade" id="EditModal<?= $linkdownloads['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Link Download <?= $linkdownloads['nama'] ?>?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('gamemaster/editlinkdownload'); ?>" method="post">
                        <div class="col-lg-12 mb-2">
                            <div class="form-group">
                                <input type="text" value="<?= $linkdownloads['id']; ?>" name="id" class="form-control" placeholder="" readonly hidden>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-2">
                            <div class="form-group">
                                <label class="text-label">Name*</label>
                                <input type="text" value="<?= $linkdownloads['nama']; ?>" name="name" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-lg-12 mb-2">
                            <div class="form-group">
                                <label class="text-label">Description*</label>
                                <input type="text" value="<?= $linkdownloads['description']; ?>" name="desc" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-lg-12 mb-2">
                            <div class="form-group">
                                <label class="text-label">Link Download*</label>
                                <input type="text" value="<?= $linkdownloads['link']; ?>" name="link" class="form-control" placeholder="">
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


<?php foreach ($linkdownload as $linkdownloads) : ?>
    <!-- Delete Modal-->
    <div class="modal fade" id="DeleteModal<?= $linkdownloads['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <a class="btn btn-primary" href="<?= base_url('gamemaster/deletelinkdownload/') ?><?= $linkdownloads['id'] ?>">Delete?</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>