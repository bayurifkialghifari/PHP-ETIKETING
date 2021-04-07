<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->



    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Cari & Pesan Tiket Online</title>
        <link rel="icon" href="<?= base_url() ?>assets/front-end/images/ico_qpx_icon.ico">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">




        <!-- ============================================
        ================= Stylesheets ===================
        ============================================= -->
        <!-- vendor css files -->
        <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/css/vendor/animate.css">
        <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/css/vendor/font-awesome.min.css">
        <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/animsition/css/animsition.min.css">
        <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/toastr/toastr.min.css">

        <!-- project main css files -->
        <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/css/main.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/front-end/css/style.css">
        <!--/ stylesheets -->



        <!-- ==========================================
        ================= Modernizr ===================
        =========================================== -->
        <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <!--/ modernizr -->

    </head>


    <body id="minovate" class="appWrapper">


        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="<?=base_url()?>assets/admin/non-angular/http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->



        <!-- ====================================================
        ================= Application Content ===================
        ===================================================== -->
        <div id="wrap" class="animsition">


























            <div class="page page-utama page-login">

                <div class="text-center"><h3 class="text-light text-white"><span class="text-lightred">Cari & Pesan Tiket Online </span></h3></div>
                <div class="text-center">
                    <h4 class="text-dark"><span style="font-size: 24px;">E TIKETING</span></h4>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="container">
                                <div class="text-dark text-left">
                                    <div>
                                        <img src="<?= base_url() ?>assets/front-end/images/svg/undraw_my_password_d6kg.svg" class="img-home">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="container w-420 p-15 bg-white mt-40 text-center form-search-area">




                                <?php if($status == 'Reset Password') : ?>
                                    <h2 class="text-light text-greensea">Reset Password</h2>
                                <?php else : ?>
                                    <h2 class="text-light text-greensea">Lupa Password</h2>
                                <?php endif; ?>





                                <?php if($status == 'Reset Password') : ?>
                                    <form role="form" action="<?= base_url() ?>lupaPassword/reset" method="post">
                                <?php else : ?>
                                    <form role="form" id="form" method="post">
                                <?php endif; ?>




                                    <div class="form-group">
                                        <?php if($status == 'Reset Password') : ?>
                                            <input type="hidden" name="id" value="<?=$id?>">
                                            <input type="hidden" name="email" value="<?=$email?>">
                                            <input type="hidden" name="token" value="<?=$token?>">

                                            <label style="font-size: 12px">Masukan password baru anda</label>
                                            <input type="password" name="password" required="" class="form-control underline-input" placeholder="Password">
                                        <?php else : ?>
                                            <label style="font-size: 12px">Masukan email anda untuk mencari akun anda</label>
                                            <input type="email" id="email" required="" class="form-control underline-input" placeholder="Email">
                                        <?php endif; ?>
                                    </div>




                                    <?php if($status == 'Reset Password') : ?>
                                        <div class="form-group text-left mt-20">
                                            <button type="submit" class="btn btn-greensea b-0 br-2 mr-5">Reset</button>
                                        </div>    
                                    <?php else : ?>
                                        <div class="form-group text-left mt-20">
                                            <button type="submit" class="btn btn-greensea b-0 br-2 mr-5">Cari akun</button>
                                            <a href="<?=base_url()?>login" class="btn btn-danger b-0 br-2 mr-5">Batalkan</a>
                                        </div>
                                    <?php endif; ?>





                                    <!-- Detail Akun -->
                                    <?php if($status != 'Reset Password') : ?>
                                        <div class="row" id="detail-akun" style="display: none">
                                            <div class="col-md-12 col-sm-12">
                                                <p class="text-center text-uppercase"><b>Detail Akun</b></p>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <p class="text-left" id="nama">Nama : nama</p>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <p class="text-left" id="email2">Email : email</p>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <p class="text-left" id="no-telepon">No telelpon : 123</p>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group text-right">
                                                    <button type="button" id="lanjutkan" class="btn btn-success b-0 br-2 mr-5">Lanjutkan</button>
                                                    <button type="button" id="bukan" class="btn btn-danger b-0 br-2 mr-5">Bukan anda ?</button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <!-- Detail Akun -->






                                </form>
                                <hr class="b-3x">
                                <div class="bg-slategray lt wrap-reset">
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 text-center">
                                            <a href="<?=base_url()?>users/home"><u class="text-warning">Kembali ke halaman utama</u></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                        

            </div>



        </div>
        <!--/ Application Content -->



























        <!-- ============================================
        ============== Vendor JavaScripts ===============
        ============================================= -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/bootstrap/bootstrap.min.js"></script>

        <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/jRespond/jRespond.min.js"></script>

        <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

        <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

        <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>

        <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/screenfull/screenfull.min.js"></script>

        <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/toastr/toastr.min.js"></script>

        <script src="<?= $this->plugin->build_url("javascripts/application.js", FALSE, 'site') ?>" type="text/javascript"></script> 
        <!--/ vendor javascripts -->




        <!-- ============================================
        ============== Custom JavaScripts ===============
        ============================================= -->
        <script src="<?=base_url()?>assets/admin/non-angular/assets/js/main.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/front-end/js/main.js"></script>
        <!--/ custom javascripts -->

        <?php if(file_exists(VIEWPATH."javascripts/page.$content.js")): ?>
          <script src="<?= $this->plugin->build_url("javascripts/page.$content.js") ?>" type="text/javascript"></script>
        <?php endif; ?>


        <!-- ===============================================
        ============== Page Specific Scripts ===============
        ================================================ -->



        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>

        <style type="text/css">
        .form-search-area
        {
            box-shadow: 5px 5px 15px 5px #888888;
        }
        </style>
    </body>
</html>
