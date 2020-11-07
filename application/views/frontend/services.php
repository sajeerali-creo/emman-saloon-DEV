<section class="bg-dark">
    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__logo">
            <a href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>assets/web/img/logo.svg" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__widget">
            <span>Call us for any questions</span>
            <h4>+971 564849878</h4>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header inner-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>assets/web/img/logo.svg"
                                alt=""></a>
                    </div>
                </div>
                <div class="col-lg-9">
                    <nav class="header__menu mobile-menu text-right">
                        <ul>
                            <li><a href="<?php echo base_url() ?>about">About</a></li>
                            <li><a href="<?php echo base_url() ?>services" class="active-menu">Services</a></li>
                            <li><a href="<?php echo base_url() ?>gallery">Gallery</a></li>
                            <li><a href="<?php echo base_url() ?>contact">Contact Us</a></li>
                            <?php 
                        if(!isset($frontLogin) || $frontLogin != true){
                        ?> <li class="text-white btn btn-dark no-space w-sm-100 d-none"><a
                                    href="<?php echo base_url() ?>login">Login</a></li>
                            <li class="text-white btn btn-primary no-space w-sm-100 d-none"><a
                                    href="<?php echo base_url() ?>register">Register</a></li><?php
                        }
                        else{
                            ?><li><a href="<?php echo base_url() ?>order-history d-none">Booking History</a></li>
                            <li class="text-white btn btn-dark no-space w-sm-100 d-none"><a
                                    href="<?php echo base_url() ?>logout">Logout</a></li>
                            <?php
                        }
                        ?>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->

    <div class="banner-about services">
        <div>Services</div>
    </div>

    <div class="container mt-5">
        <div class="row mt-5">
            <div class="col-md-12 col-sm-12 colxs-12">
                <div class="font-weight-bold text-white h5 mb-3 text-center">Services Include</div>
                <p class="text-white mb-3 text-center opacity-1">At Eman Salon we believe that our tranquil
                    environment, dedicated staff, extensive range of treatments and outstanding, high quality skin care
                    products will give our guests the ultimate experience.</p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="service-box-big">
                    <div class="overlay-1">
                        <a href="<?php echo base_url() ?>face">
                            Face & Body care
                        </a>
                    </div>
                    <img src="<?php echo base_url() ?>assets/web/img/service/s-1.jpg" alt="">
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="service-box-big">
                    <div class="overlay-1">
                    <a href="<?php echo base_url() ?>hair">
                        Hair Care
                        </a>
                    </div>
                    <img src="<?php echo base_url() ?>assets/web/img/service/s-2.jpg" alt="">
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="service-box-big">
                    <div class="overlay-1">
                    <a href="<?php echo base_url() ?>nail">
                        Nail Care
                        </a>
                    </div>
                    <img src="<?php echo base_url() ?>assets/web/img/service/s-3.jpg" alt="">
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="service-box-big">
                    <div class="overlay-1">
                    <a href="<?php echo base_url() ?>waxing">
                        Waxing
                        </a>
                    </div>
                    <img src="<?php echo base_url() ?>assets/web/img/service/s-4.jpg" alt="">
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="service-box-big">
                    <div class="overlay-1">
                    <a href="<?php echo base_url() ?>moroccan">
                        Moroccan Bath
                        </a>
                    </div>
                    <img src="<?php echo base_url() ?>assets/web/img/service/s-5.jpg" alt="">
                </div>
            </div>

        </div>

    </div>

</section>



<!-- Footer Section Begin -->
<footer class="footer set-bg" data-setbg="<?php echo base_url() ?>assets/web/img/footer-bg.jpg">
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-lg-12 col-md-12 text-center">
                    <div class="copyright__text text-small">
                        <p class="text-small">Copyright © <script>
                            document.write(new Date().getFullYear());
                            </script>Copyright © 2015 Eman Salon. All rights reserved. | This design is made with <i
                                class="far fa-heart"></i> by <a href="https://timelino-12f7f.web.app/"
                                target="_blank">Timelino</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->