<!-- Footer Section Begin -->
<footer class="footer">
    <div class="page-up">
        <a href="#" id="scrollToTopButton"><span class="arrow_carrot-up"></span></a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="footer__logo">
                    <a href="./index.html"><img src="<?= base_url('vendor/wibu/'); ?>img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="footer__nav">
                    <ul>
                        <li class="active"><a href="./index.html">Homepage</a></li>
                        <li><a href="./categories.html">Categories</a></li>
                        <li><a href="./blog.html">Our Blog</a></li>
                        <li><a href="#">Contacts</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>

            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Search model Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch"><i class="icon_close"></i></div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
<!-- Search model end -->

<!-- Js Plugins -->
<script src="<?= base_url('vendor/wibu/'); ?>js/jquery-3.3.1.min.js"></script>
<script src="<?= base_url('vendor/wibu/'); ?>js/bootstrap.min.js"></script>
<script src="<?= base_url('vendor/wibu/'); ?>js/player.js"></script>
<script src="<?= base_url('vendor/wibu/'); ?>js/jquery.nice-select.min.js"></script>
<script src="<?= base_url('vendor/wibu/'); ?>js/mixitup.min.js"></script>
<script src="<?= base_url('vendor/wibu/'); ?>js/jquery.slicknav.js"></script>
<script src="<?= base_url('vendor/wibu/'); ?>js/owl.carousel.min.js"></script>
<script src="<?= base_url('vendor/wibu/'); ?>js/main.js"></script>
<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>
</body>

</html>