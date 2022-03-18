<!--**********************************
            Footer start
        ***********************************-->
<div class="footer">
    <div class="copyright">
        <p>Copyright &copy; WibuSaga <?= date('Y'); ?></p>
    </div>
</div>
<!--**********************************
            Footer end
        ***********************************-->

<!--**********************************
           Support ticket button start
        ***********************************-->

<!--**********************************
           Support ticket button end
        ***********************************-->


</div>
<!--**********************************
        Main wrapper end
    ***********************************-->

<!--**********************************
        Scripts
    ***********************************-->
<!-- Required vendors -->
<script src="<?= base_url('vendor/xhtml/'); ?>vendor/global/global.min.js"></script>
<script src="<?= base_url('vendor/xhtml/'); ?>vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="<?= base_url('vendor/xhtml/'); ?>vendor/chart.js/Chart.bundle.min.js"></script>
<script src="<?= base_url('vendor/xhtml/'); ?>js/custom.min.js"></script>
<script src="<?= base_url('vendor/xhtml/'); ?>js/deznav-init.js"></script>
<script src="<?= base_url('vendor/xhtml/'); ?>vendor/owl-carousel/owl.carousel.js"></script>

<!-- Chart piety plugin files -->
<script src="<?= base_url('vendor/xhtml/'); ?>vendor/peity/jquery.peity.min.js"></script>

<!-- Apex Chart -->
<script src="<?= base_url('vendor/xhtml/'); ?>vendor/apexchart/apexchart.js"></script>

<!-- Dashboard 1 -->
<script src="<?= base_url('vendor/xhtml/'); ?>js/dashboard/dashboard-1.js"></script>
<script>
    function carouselReview() {
        /*  testimonial one function by = owl.carousel.js */
        jQuery('.testimonial-one').owlCarousel({
            loop: true,
            autoplay: true,
            margin: 30,
            nav: false,
            dots: false,
            left: true,
            navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
            responsive: {
                0: {
                    items: 1
                },
                484: {
                    items: 2
                },
                882: {
                    items: 3
                },
                1200: {
                    items: 2
                },

                1540: {
                    items: 3
                },
                1740: {
                    items: 4
                }
            }
        })
    }
    jQuery(window).on('load', function() {
        setTimeout(function() {
            carouselReview();
        }, 1000);
    });
</script>
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

</body>

</html>