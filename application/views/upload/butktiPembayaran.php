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
                                        <img src="<?= base_url() ?>assets/front-end/images/svg/undraw_confirm_89ui.svg" class="img-home">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="container w-420 p-15 bg-white mt-40 text-center form-search-area">


                                <h2 class="text-light text-greensea">Upload Bukti</h2>

                                <form role="form" id="form" method="post">
                                    <br>
                                    <input type="hidden" id="idPemesan" value="<?= $idPemesan ?>">

                                    <div class="form-group">
                                        <input type="file" id="file" required="" class="form-control underline-input" placeholder="Email">
                                    </div>

                                    <div class="form-group text-left mt-20">

                                        <button type="submit" id="Kirim" class="btn btn-greensea b-0 br-2 mr-5">Kirim</button>
                                        <!-- <label class="checkbox checkbox-custom-alt checkbox-custom-sm inline-block">
                                            <input type="checkbox"><i></i> Remember me
                                        </label> -->
                                        <a href="<?=base_url()?>users/home" class="pull-right mt-10">Halaman Utama</a>
                                    </div>

                                </form>

                                <hr class="b-3x">
                                <div class="bg-slategray lt wrap-reset mt-40">
                                    <h5>Kirim pembayaran ke no rekening 084-123123</h5>
                                    <p class="text-left text-dark" style="font-size: 12px">
                                    Upload bukti harus sudah dikirim kurang dari satu hari atau pemesanan di batalkan !!</p>
                                </div>
                                <br>
                                <p class="text-center">
                                    Preview Foto
                                </p>
                                <img src="" id="image_upload_preview" width="50%">
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

        <script src="<?php echo $this->plugin->build_url("javascripts/application.js", FALSE, 'site') ?>" type="text/javascript"></script> 
        <!--/ vendor javascripts -->




        <!-- ============================================
        ============== Custom JavaScripts ===============
        ============================================= -->
        <script src="<?=base_url()?>assets/admin/non-angular/assets/js/main.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/front-end/js/main.js"></script>
        <!--/ custom javascripts -->


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

        <script type="text/javascript">
            $(() =>
            {
                // File Preview
                $("#file").change(function () {
                    readURL(this);
                })

                function readURL(input)
                {
                    if (input.files && input.files[0]) 
                    {
                    
                        let reader = new FileReader()

                        reader.onload = function (e) 
                        {
                            $('#image_upload_preview').attr('src', e.target.result)
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                }

                $('#form').submit((ev) =>
                {
                    ev.preventDefault()

                    let fd                  = new FormData()

                    let idPemesan           = $('#idPemesan').val()
                    let bukti               = $('#file')[0].files[0]

                    fd.append('idPemesan', idPemesan)
                    fd.append('bukti', bukti)

                    let ajax = null

                    $.ajax({
                        url: '<?= base_url() ?>users/pembayaran/uploadBukti',
                        type: 'post',
                        data: fd,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        cache: false,
                        async: false,
                        success(data)
                        {
                            $.message('Upload success !!','Bukti Pembayaran','success')
                            $.message('Bukti pembayaran akan dicek oleh tim dari E-TIKETING','Bukti Pembayaran','warning')
                            $.message('Pemberitahuan akan dikirim melalui email anda','Bukti Pembayaran','warning')

                            $('#Kirim').attr('disabled', 'disabled')
                        },
                        error($xhr)
                        {
                            $.message('Gagal di upload.','Bukti Pembayaran','error')
                            console.log($xhr)
                        }
                    })
                })
            })
        </script>

    </body>
</html>
