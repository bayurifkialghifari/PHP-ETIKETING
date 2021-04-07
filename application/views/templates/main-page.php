<!DOCTYPE html>
<html>
<head>


  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

  <title>Cari & Pesan Tiket Online</title>


  <meta name="description" content="">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->


  <link rel="icon" href="<?= base_url() ?>assets/front-end/images/ico_qpx_icon.ico">


  <!-- Main Css And Javascript -->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/front-end/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/chosen/chosen.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/front-end/css/font-awesome.css">

  <script type="text/javascript" src="<?= base_url() ?>assets/front-end/js/jquery.min.js"></script>
  <script type="text/javascript" src="<?= base_url() ?>assets/front-end/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/daterangepicker/moment.min.js"></script>
  <script type="text/javascript" src="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/daterangepicker/daterangepicker.js"></script>
  <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/bootstrap/bootstrap.min.js"></script>
  <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/jRespond/jRespond.min.js"></script>
  <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>
  <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>
  <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/daterangepicker/moment.min.js"></script>
  <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/daterangepicker/daterangepicker.js"></script>
  <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/screenfull/screenfull.min.js"></script>
  <script src="<?=base_url()?>assets/admin/non-angular/assets/js/main.js"></script>
  
  <!--/ custom javascripts -->
  <script src="<?= $this->plugin->build_url("javascripts/api-client.js", FALSE, 'site') ?>" type="text/javascript"></script>
  <script src="<?= $this->plugin->build_url("javascripts/application.js", FALSE, 'site') ?>" type="text/javascript"></script> 
  <script src="<?= $this->plugin->build_url("javascripts/main-main.js", FALSE, 'site') ?>" type="text/javascript"></script> 





  <!-- Costum CSS And Javascript -->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/front-end/css/style.css">
  <script type="text/javascript">let base_url = '<?= base_url() ?>'</script>
  <script type="text/javascript" src="<?= base_url() ?>assets/front-end/js/main.js"></script>

  <?php if(!empty($plugin_styles)): ?>
  <!-- BEGIN PAGE LEVEL PLUGINS -->
    <?php foreach($plugin_styles as $style): ?>
      <link href="<?= $style ?>" rel="stylesheet" type="text/css" />
    <?php endforeach; ?>
  <!-- END PAGE LEVEL PLUGINS -->
  <?php endif; ?>

  <?php if(!empty($plugin_scripts)): ?>
  <!-- BEGIN PAGE LEVEL PLUGINS -->
    <?php foreach($plugin_scripts as $script): ?>
      <script src="<?= $script ?>" type="text/javascript"></script>
    <?php endforeach; ?>
  <!-- END PAGE LEVEL PLUGINS -->
  <?php endif; ?>






</head>
<body>




  <div class="d-flex toggled" id="wrapper">





    <!-- Navigation -->
    <?php $this->load->view('templates/partials/navigation') ?>
    <!-- End Navigation -->

    




    <!-- Page Content -->
    <div id="page-content-wrapper" class="mt-5 pt-5">





      <!-- Text Background -->
      <h2 class="background-text text-center">
        <!-- E Tiketing -->
      </h2>
      <!-- Text Background -->



    <!-- Page Content -->
    <?php if(file_exists(VIEWPATH."templates/contents/users/$content.php")): ?>
      <?php $this->load->view("templates/contents/users/$content.php"); ?>
    <?php endif; ?>
    <!-- Page Content -->

  </div>






    </div>
    <!-- Page Content -->

  </div>

  <!-- Footer -->
  <?php $this->load->view('templates/partials/footer'); ?>
  <!-- Footer -->


  <!-- Detail Image -->
  <div id="myModal" class="modal">
    
    <span class="close">&times;</span>

    <img class="modal-content mt-1" id="img01">

    <div class="text-center">
      <div id="caption"></div>
    </div>

  </div>
  <!-- Detail Image -->

  <!-- Logout Validasi -->
  <div class="modal mt-5 pt-5" id="myModal3">
    <div class="modal-dialog mt-5 pt-5">
        <div class="modal-content">
            <div class="modal-body">
              <h4 id="contentHapus"></h4>
            </div>
            <div class="modal-footer">
                <button id="clickLogout" class="btn btn-success btn-ef btn-ef-3 btn-ef-3c"><i class="fa fa-arrow-right"></i> Ya</button>

                <button class="btn btn-danger btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Tidak</button>
            </div>
        </div>
    </div>
  </div>
  <!-- Logout Validasi -->





</body>
</html>