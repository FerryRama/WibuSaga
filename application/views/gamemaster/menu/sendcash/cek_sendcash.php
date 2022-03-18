<body onload="countDown();">
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
                            <h4 class="card-title">Please wait cash otw send to <?= $cekcash['userID']; ?></h4>
                            <div id='date-time'></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <h1 class="col-xl-12 col-xxl-12">
                    <div class="card">
                        <div class=" card-header">
                            <div><?= $this->session->flashdata('message'); ?></div>
                        </div>
                        <div class="card-body">
                            <div id="smartwizard" class="form-wizard order-create sw sw-theme-default sw-justified">
                                <form name="YourFormID" id="YourFormID" action="<?= base_url('gamemaster/sendcashsuccess'); ?>" method="post">
                                    <div class="tab-content" style="height: 460px;">
                                        <div id="wizard_Service" class="tab-pane" role="tabpanel" style="display: block;">
                                            <div class="row">
                                                <div class="col-lg-6 mb-2">
                                                    <div class="form-group">
                                                        <center>Please Wait <span id="timer"></span> Second.</br>
                                                            <input type="text" value="<?= $cekcash['userID']; ?>" name="userID" class="form-control" placeholder="" readonly hidden>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-2">
                                                    <div class="form-group">

                                                        <input type="number" value="<?= $this->session->userdata('total_cash') ?>" name="cash" class="form-control" placeholder="" readonly hidden>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    <div class="form-group">
                                                        <input type="text" value="<?= $user['accountIDX']; ?>" name="accountIDX" class="form-control" placeholder="" hidden>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    <div class="form-group">
                                                        <input type="text" value="<?= $user['nickName']; ?>" name="sendnick" class="form-control" placeholder="" hidden readonly hidden>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    <div class="form-group">
                                                        <input type="text" value="<?= $cekcash['accountIDX']; ?>" name="accountIDXSend" class="form-control" placeholder="" hidden>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    <div class="form-group">
                                                        <input type="text" value="<?= $cekcash['bonusCash']; ?>" name="bonusCash" class="form-control" placeholder="" readonly hidden>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    <div class="form-group">
                                                        <input type="text" value="<?= $cekcash['nickName']; ?>" name="nicknameto" class="form-control" placeholder="" readonly hidden>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <!-- <div class="toolbar toolbar-bottom" role="toolbar" style="text-align: right;"> <button type="submit" name="YourFormID" value="YourFormID" class="btn btn-primary">Send Now</button></div> -->
                        </div>
                    </div>

            </div>
        </div>
    </div>
    </div>
    </div>
    </form>

    <script type="text/javascript">
        var counter = 5;

        function countDown() {
            if (counter >= 0) {
                document.getElementById("timer").innerHTML = counter;
            } else {
                download();
                return;
            }
            counter -= 1;

            var counter2 = setTimeout("countDown()", 1000);
            return;
        }

        function download() {
            var frm = document.getElementById("YourFormID");
            frm.submit();
        }
    </script>

    <!--  <script type="text/javascript">
        function formAutoSubmit() {
            var frm = document.getElementById("YourFormID");
            frm.submit();
        }
        var counter = 3;
        document.getElementById("timer").innerHTML = counter;
        window.onload = setInterval(formAutoSubmit, 5000);
    </script> -->