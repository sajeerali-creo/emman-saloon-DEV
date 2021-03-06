<section class="bg-dark pb-5">
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
                            <li><a href="<?php echo base_url() ?>services">Services</a></li>
                            <li><a data-toggle="modal" data-target="#appointment">Appointment</a></li>
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

    <div class="banner-about gallery">
        <div class="container text-center">
            <div>Gallery</div>
        </div>
    </div>

    <div class="container mt-5">
    <section class="gallery-block compact-gallery">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-6 col-lg-4 item zoom-on-hover">
                    <a class="lightbox" href="<?php echo base_url() ?>assets/web/img/gallery/hair1.jpg">
                        <img class="img-fluid image" src="<?php echo base_url() ?>assets/web/img/gallery/hair1.jpg">
                        <span class="description">
                            <span class="description-heading">Hair Care</span>
                        </span>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 item zoom-on-hover">
                    <a class="lightbox" href="<?php echo base_url() ?>assets/web/img/gallery/hair2.jpg">
                    <img class="img-fluid image" src="<?php echo base_url() ?>assets/web/img/gallery/hair2.jpg">
                    <span class="description">
                            <span class="description-heading">Hair Care</span>
                        </span>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 item zoom-on-hover">
                    <a class="lightbox" href="<?php echo base_url() ?>assets/web/img/gallery/hair3.jpg">
                        <img class="img-fluid image" src="<?php echo base_url() ?>assets/web/img/gallery/hair3.jpg">
                        <span class="description">
                            <span class="description-heading">Hair Care</span>
                        </span>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 item zoom-on-hover">
                    <a class="lightbox" href="<?php echo base_url() ?>assets/web/img/gallery/hair4.jpg">
                        <img class="img-fluid image" src="<?php echo base_url() ?>assets/web/img/gallery/hair4.jpg">
                        <span class="description">
                            <span class="description-heading">Hair Care</span>
                        </span>
                        </a>
                    </div>
                <div class="col-md-6 col-lg-4 item zoom-on-hover">
                <a class="lightbox" href="<?php echo base_url() ?>assets/web/img/gallery/make2.jpg">
                        <img class="img-fluid image" src="<?php echo base_url() ?>assets/web/img/gallery/make2.jpg">
                        <span class="description">
                            <span class="description-heading">Make Up</span>
                        </span>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 item zoom-on-hover">
                    <a class="lightbox" href="<?php echo base_url() ?>assets/web/img/gallery/make3.jpg">
                        <img class="img-fluid image" src="<?php echo base_url() ?>assets/web/img/gallery/make3.jpg">
                        <span class="description">
                            <span class="description-heading">Make Up</span>
                        </span>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 item zoom-on-hover">
                    <a class="lightbox" href="<?php echo base_url() ?>assets/web/img/gallery/skin4.jpg">
                        <img class="img-fluid image" src="<?php echo base_url() ?>assets/web/img/gallery/skin4.jpg">
                        <span class="description">
                            <span class="description-heading">Skin Care</span>
                        </span>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 item zoom-on-hover">
                    <a class="lightbox" href="<?php echo base_url() ?>assets/web/img/gallery/skin1.jpg">
                        <img class="img-fluid image" src="<?php echo base_url() ?>assets/web/img/gallery/skin1.jpg">
                        <span class="description">
                            <span class="description-heading">Skin Care</span>
                        </span>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 item zoom-on-hover">
                    <a class="lightbox" href="<?php echo base_url() ?>assets/web/img/gallery/skin2.jpg">
                        <img class="img-fluid image" src="<?php echo base_url() ?>assets/web/img/gallery/skin2.jpg">
                        <span class="description">
                            <span class="description-heading">Skin Care</span>
                        </span>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 item zoom-on-hover">
                    <a class="lightbox" href="<?php echo base_url() ?>assets/web/img/gallery/skin3.jpg">
                        <img class="img-fluid image" src="<?php echo base_url() ?>assets/web/img/gallery/skin3.jpg">
                        <span class="description">
                            <span class="description-heading">Skin Care</span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    </div>
</section>

<!-- appointment -->
<!-- Modal -->
<div class="modal fade" id="appointment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="<?php echo base_url() ?>contactus" id="js-index-request-form-2">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="txtName">Name</label>
                                <input type="text" class="form-control" id="txtName" name="txtName" required="required">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="txtEmail">E-mail</label>
                                <input type="email" class="form-control" id="txtEmail" name="txtEmail"
                                    required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="txtName">Phone Number</label>
                                <input type="text" class="form-control" id="txtName" name="txtName" required="required">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="txtEmail">Subject</label>
                                <input type="email" class="form-control" id="txtEmail" name="txtEmail"
                                    required="required">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="taMessage">Appointment Details</label>
                        <textarea class="form-control" id="taMessage" name="taMessage" rows="3"
                            required="required"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- end appintment -->
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