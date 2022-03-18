<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('gamemaster'); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('gamemaster/addnewpostingan'); ?>">Add Post</a></li>
                <li class="breadcrumb-item active"><a href="<?= base_url('gamemaster/allpost'); ?>">History Post</a></li>
            </ol>
        </div>
        <!-- row -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">History Post Information</h4>
                        <div id='date-time'> </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display min-w850">
                                <div><?= $this->session->flashdata('message'); ?></div>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>IDX POST</th>
                                            <th>Authors</th>
                                            <th>Title / Judul</th>
                                            <th>Tags</th>
                                            <th>Detail Post</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>IDX POST</th>
                                            <th>Authors</th>
                                            <th>Title / Judul</th>
                                            <th>Tags</th>
                                            <th>Detail Post</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <?php foreach ($getallpost as $post) : ?>
                                        <tbody>
                                            <tr>
                                                <td><?= $post['id'] ?></td>
                                                <td><?= $post['authors'] ?></td>
                                                <td><?= $post['judul'] ?></td>
                                                <td> <?php
                                                        if ($post['tags'] == 1) {
                                                            echo '<span class="badge light badge-primary">News</span>';
                                                        } else if ($post['tags'] == 2) {
                                                            echo '<span class="badge light badge-success">Update</span>';
                                                        } else if ($post['tags'] == 3) {
                                                            echo '<span class="badge light badge-danger">Event</span>';
                                                        } else if ($post['tags'] == 4) {
                                                            echo '<span class="badge light badge-warning">Notice</span>';
                                                        }
                                                        ?></td>
                                                <td><a href="<?= base_url('news/idx/') ?><?= $post['id'] ?>" class="btn btn-primary shadow btn-xs sharp mr-1 flaticon-381-heart" target="_blank"></a></td>
                                                <td><a href="<?= base_url('gamemaster/editpost/') ?><?= $post['id'] ?>" class="btn btn-primary shadow btn-xs sharp mr-1 fa fa-pencil"></a>
                                                    <a href="<?= base_url('gamemaster/deletepost/') ?><?= $post['id'] ?>" class="btn btn-danger shadow btn-xs sharp fa fa-trash"></a>
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