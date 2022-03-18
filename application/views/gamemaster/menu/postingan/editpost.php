<div class="content-body" style="min-height: 1092px;">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('gamemaster'); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('gamemaster/addnewpostingan'); ?>">Add Post</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('gamemaster/allpost'); ?>">History Post</a></li>
                <li class="breadcrumb-item active"><a href="">Edit Post ID : <?= $editpost['id'] ?></a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Edit</h4>
                    </div>
                    <div class="card-body">
                        <div id="smartwizard" class="form-wizard order-create sw sw-theme-default sw-justified">
                            <form action="<?= base_url('gamemaster/editspost'); ?>" method="post">
                                <div class="tab-content" style="height: 1040px;">
                                    <div id="wizard_Service" class="tab-pane" role="tabpanel" style="display: block;">
                                        <div class="row">
                                            <div class="col-lg-12 mb-3">
                                                <div class="form-group">
                                                    <input type="text" name="idx" class="form-control" value="<?= $editpost['id'] ?>" hidden>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <div class="form-group">
                                                    <label class="text-label">Authors* : <?= $editpost['authors'] ?></label> <?= form_error('authors', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    <input type="text" name="authors" class="form-control" value="<?= $editpost['authors'] ?>" hidden>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Judul / Title</label> <?= form_error('judul', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    <input type="text" value="<?= $editpost['judul'] ?>" name="judul" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Choose a Tagline:*<?= set_value('tags'); ?> </label><?= form_error('tags', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    <div class="form-group">
                                                        <select class="form-control default-select" name="tags">
                                                            <option name="tags" value="<?= $editpost['tags']; ?>"> <?php
                                                                                                                    if ($editpost['tags'] == 1) {
                                                                                                                        echo 'News';
                                                                                                                    } else if ($editpost['tags'] == 2) {
                                                                                                                        echo 'Update';
                                                                                                                    } else if ($editpost['tags'] == 3) {
                                                                                                                        echo 'Event';
                                                                                                                    } else if ($editpost['tags'] == 4) {
                                                                                                                        echo 'Notice';
                                                                                                                    }
                                                                                                                    ?></option>
                                                            <option name="tags" value="1">News</option>
                                                            <option name="tags" value="2">Update</option>
                                                            <option name="tags" value="3">Event</option>
                                                            <option name="tags" value="4">Notice</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <img src="<?= $editpost['img'] ?>" alt="Girl in a jacket" width="75" height="50">
                                                    <label class="text-label">Link Images Banner Home (230 x 325)*</label><?= form_error('img', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    <input type="text" value="<?= $editpost['img'] ?>" name="img" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <img src="<?= $editpost['banner'] ?>" alt="Girl in a jacket" width="75" height="50">
                                                    <label class="text-label">Link Images Banner Home (1170 x 600)*</label><?= form_error('banner', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    <input type="text" value="<?= $editpost['banner'] ?>" name="banner" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <div class="form-group">
                                                    <label class="text-label">Detail Post*</label><?= form_error('detail', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    <textarea id="detail" name="detail"><?= $editpost['detail'] ?></textarea>
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