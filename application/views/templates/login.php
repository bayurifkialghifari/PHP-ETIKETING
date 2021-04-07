<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->



    <head>

        <meta charset="utf-8">
        
        <!-- <meta name="google-signin-client_id" content="<?= $this->config->item('google_client_id') ?>"> -->
        <meta name="google-signin-client_id" content="1068690610511-0g9jder58elfk750jpd5lhcnjcjjo4ca.apps.googleusercontent.com">

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
                                        <img src="<?= base_url() ?>assets/front-end/images/svg/undraw_airport_2581.svg" class="img-home">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="container w-420 p-15 bg-white mt-40 text-center form-search-area">


                                <h2 class="text-light text-greensea">Log In</h2>

                                <form role="form" id="form" method="post">

                                    <div class="form-group">
                                        <input type="email" id="email" required="" class="form-control underline-input" placeholder="Email">
                                    </div>

                                    <div class="form-group">
                                        <input type="password" id="password" required="" placeholder="Password" class="form-control underline-input">
                                    </div>

                                    <div class="form-group text-left mt-20">
                                        <button type="submit" class="btn btn-greensea b-0 br-2 mr-5">Login</button>
                                        <!-- <label class="checkbox checkbox-custom-alt checkbox-custom-sm inline-block">
                                            <input type="checkbox"><i></i> Remember me
                                        </label> -->
                                        <a href="<?=base_url()?>lupaPassword" class="pull-right mt-10">Lupa Password?</a>
                                    </div>

                                </form>
                                <hr class="b-3x">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <a class="g-signin2" data-onsuccess="onSignIn" role="button"></a>
                                    </div>
                                    <div class="col-md-6 col-sm-6 text-right">
                                        <a href="<?= $urlFacebook ?>" class="fb connect">Masuk</a>
                                    </div>
                                </div>
                                <div class="bg-slategray lt wrap-reset mt-40">
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <p class="text-left text-dark">Belum punya akun ?</p>
                                        </div>
                                        <div class="col-md-6 col-sm-6 text-right">
                                            <a href="<?=base_url()?>register" class="btn btn-primary" style="color: white">Daftar</a>
                                        </div>
                                    </div>
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





















        <script src="https://apis.google.com/js/platform.js" async defer></script>







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

        a.fb {
            font-family: Lucida Grande, Helvetica Neue, Helvetica, Arial, sans-serif;
            display: inline-block;
            font-size: 14px;
            padding: 7px 20px 7px 50px;
            color: gray;
            text-decoration: none;
            transition: 0.1s ease;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 2px 4px 0px;
;   
        }

        a.fb:hover {
            transition: 0.1s ease;
            box-shadow: 0 0 3px 3px rgba(66,133,244,.3);
            text-decoration: underline;
        }

        .connect:before {            
            display: inline-block;
            position: relative;
            background-image: url(<?= base_url() ?>assets/front-end/images/svg/facebook.svg);
            height: 23px;
            background-repeat: no-repeat;
            background-position: -5px 0px;
            text-indent: -9999px;
            text-align: center;
            width: 29px;
            line-height: 23px;
            margin: -8px 7px -7px -30px;
            padding: 2 25px 0 0;
            content: "f";
        }

    </body>
</html>
