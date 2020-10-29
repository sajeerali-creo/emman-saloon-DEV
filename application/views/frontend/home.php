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
<header class="header">
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
                        <li><a href="https://emansalon.com/profile/">About</a></li>
                        <li><a href="<?php echo base_url() ?>service">Services</a></li>
                        <li><a href="https://emansalon.com/gallery-style/">Gallery</a></li>
                        <li><a href="https://emansalon.com/contact-us/">Contact Us</a></li>
                        <?php 
                        if(!isset($frontLogin) || $frontLogin != true){
                        ?> <li class="text-white btn btn-dark no-space w-sm-100"><a href="<?php echo base_url() ?>login">Login</a></li>
                            <li class="text-white btn btn-primary no-space w-sm-100"><a href="<?php echo base_url() ?>register">Register</a></li><?php
                        }
                        else{
                            ?><li><a href="<?php echo base_url() ?>order-history">Booking History</a></li>
                            <li class="text-white btn btn-dark no-space w-sm-100"><a href="<?php echo base_url() ?>logout">Logout</a></li>
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

<!-- Hero Section Begin -->
<section class="hero">
    <div class="hero__slider owl-carousel">
        <div class="hero__items set-bg" data-setbg="<?php echo base_url() ?>assets/web/img/bg.jpg">
            <div class="hero__text">
                <h2>Book your <br>Next services with Us</h2>
                <h4 class="text-white">Select where you want our Services</h4>
                <a href="<?php echo base_url() ?>map" class="primary-btn">@ Home Services</a>

                <div class="hero__social">
                    <a href="https://www.facebook.com/emansalondubai" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/emansalondubai" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/eman_salon/?ref=badge" target="_blank"><i
                            class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- watsap -->
<a href="https://api.whatsapp.com/send?phone=971564849878&text=book%20your%20service%20though%20whatsapp"
    target="_blank" class="align-items-center d-flex text-decoration-none text-white watsap-button">
    <i class="fab fa-whatsapp h3"></i>
</a>
<!-- end watsap -->

<!-- Start of ChatBot (www.chatbot.com) code -->
<!-- Start of ChatBot (www.chatbot.com) code -->
<script type="text/javascript">
    window.__be = window.__be || {};
    window.__be.id = "5f988e3956000300079938d4";
    (function() {
        var be = document.createElement('script'); be.type = 'text/javascript'; be.async = true;
        be.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.chatbot.com/widget/plugin.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(be, s);
    })();
</script>
<!-- End of ChatBot code -->
<!-- End of ChatBot code -->

<!-- Footer Section Begin -->
<footer class="footer set-bg" data-setbg="<?php echo base_url() ?>assets/web/img/footer-bg.jpg">
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-lg-12 col-md-12 text-center">
                    <div class="copyright__text text-small">
                        <p class="text-small">Copyright © <script>
                            document.write(new Date().getFullYear());
                            </script>Copyright © 2015 Eman Salon. All rights reserved. | This design is made with <i class="far fa-heart"></i> by <a
                                href="https://timelino-12f7f.web.app/" target="_blank">Timelino</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->