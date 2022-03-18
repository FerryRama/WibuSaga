<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; WibuSaga <?= date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('vendor/sbadmin2/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('vendor/sbadmin2/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('vendor/sbadmin2/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('vendor/sbadmin2/'); ?>js/sb-admin-2.min.js"></script>
<script type='text/javascript' src='<?php echo base_url(); ?>assets/plugin/ckeditor/ckeditor.js'></script>
<script>
    var ckeditor = CKEDITOR.replace('detail', {
        height: '500px'

    });
    CKEDITOR.disableAutoInline = true;
    CKEDITOR.inline('editable');
</script>
<script>
    // Function to format 1 in 01
    const zeroFill = n => {
        return ('0' + n).slice(-2);
    }

    // Creates interval
    const interval = setInterval(() => {
        // Get current time
        const now = new Date();

        // Format date as in mm/dd/aaaa hh:ii:ss
        const dateTime = zeroFill(now.getUTCDate()) + '-' + zeroFill((now.getMonth() + 1)) + '-' + now.getFullYear() + ' ' + zeroFill(now.getHours()) + ':' + zeroFill(now.getMinutes()) + ':' + zeroFill(now.getSeconds());

        // Display the date and time on the screen using div#date-time
        document.getElementById('date-time').innerHTML = dateTime;
    }, 1000);
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</body>

</html>