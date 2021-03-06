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
                            <li><a href="<?php echo base_url() ?>about" class="active-menu">About</a></li>
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

    <div class="banner-about">
        <div>About Us</div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-7 col-sm-6 colxs-12">
                With over 25 years experience, a beauty salon with style, sophistication and a fresh approach. As you’d
                expect from a professional salon, Eman Salon offers a ultimate range of beauty treatments, each carried
                out to the highest possible standard, together with some specially selected beauty products.
                <br><br>
                At Eman Salon we believe that our tranquil environment, dedicated staff, extensive range of treatments
                and outstanding, high quality skin care products will give our guests the ultimate experience.
            </div>
            <div class="col-md-5 col-sm-6 colxs-12 text-right">
                <img src="<?php echo base_url() ?>assets/web/img/logo.svg" alt="" class="opacity-1-1 w-70">
            </div>
        </div>
       
        <div class="row mt-5">
            <div class="col-md-12 col-sm-12 colxs-12">
                <div class="font-weight-bold text-white h2">Services Include</div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12 col-sm-12 colxs-12">
                <div class="d-lg-flex d-md-flex">
                    <div class="w-100 s-box mr-3 text-center">
                        <div>
                            <img src="<?php echo base_url() ?>assets/web/img/abt/1.svg" alt="" class="icon-sv">
                            <div>Nail care</div>
                        </div>
                    </div>
                    <div class="w-100 s-box mr-3">
                        <div>
                            <img src="<?php echo base_url() ?>assets/web/img/abt/2.svg" alt="" class="icon-sv">
                            <div>Skin Care</div>
                        </div>
                    </div>
                    <div class="w-100 s-box mr-3">
                        <div>
                            <img src="<?php echo base_url() ?>assets/web/img/abt/3.svg" alt="" class="icon-sv">
                            <div>Face care</div>
                        </div>
                    </div>
                    <div class="w-100 s-box mr-3">
                        <div>
                            <img src="<?php echo base_url() ?>assets/web/img/abt/5.svg" alt="" class="icon-sv">
                            <div>Hair care</div>
                        </div>

                    </div>
                    <div class="w-100 s-box">

                        <div>
                            <img src="<?php echo base_url() ?>assets/web/img/abt/4.svg" alt="" class="icon-sv">
                            <div>Waxing</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6 col-sm-12 colxs-12">
                <div class="misson-bx p-5 h-sm-auto">
                    <div>
                        <div class="font-weight text-white h3 mb-3">Our Vision</div>
                        <div>We aim to offer you exceptional service with the highest standard of beauty treatments. To
                            always be up-to-date with the current & upcoming fashion trends. To ensure all our
                            therapists & stylists receive on-going training that are on-par with the latest
                            international standards</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 colxs-12">
                <div class="misson-bx p-5 h-sm-auto">
                    <div>
                        <div class="font-weight text-white h3 mb-3">Our Mission</div>
                        <div>
                            At Eman we believe in a commitment to excellence. Taking care of you is our business. We
                            consider ourselves progressive, but not over the top. It’s all about attention to detail
                            with every individual client. Our staff is trained to have a keen eye for detail aimed at
                            meeting the client’s specific needs.
                        </div>
                    </div>
                </div>
            </div>

        </div>



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
                                <label for="txtEmail">Select Service</label>
                                <select class="custom-select">
                                    <option selected>Face & Body care</option>
                                    <option value="1">Hair Care</option>
                                    <option value="2">Nail Care</option>
                                    <option value="3">Waxing</option>
                                </select>
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