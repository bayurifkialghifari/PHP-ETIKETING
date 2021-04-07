<div id="page-content-wrapper">

  <div class="container pt-5">
    
    <div class="row pt-5">

      <!-- Form Cek Pesanan -->
      <div class="col-md-4 text-left pt-5">
        <div class="form-group">
          <div class="form-search-area">
            <div class="container p-3">
              <form id="form">

                <div class="row">
                  
                  <div class="col-md-12">
                    <label>Alamat Email</label>
                    <input type="email" id="email" class="form-control" placeholder="Email" required="">
                  </div>

                  <div class="col-md-12 pt-3">
                    <label>Kode Boking</label>
                    <input type="text" id="kode" class="form-control" placeholder="Code" required="">
                  </div>

                  <div class="col-md-12 text-center pt-5 pb-5">
                    <button type="submit" class="btn btn-primary btn-costum-artikel mt-3">
                      <i class="fa fa-search"></i> Cek Pesanan
                    </button>
                  </div>

                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Form Cek Pesanan -->

      <!-- Data Pesanan -->
      <div class="col-md-8 pt-5" id="hasil-cari">
        <div class="text-dark text-center">
          
          <b><p>Cek pesanan anda dengan mudah <br> Masukan email dan kode booking anda</p></b>

          <div class="text-center pt-2">
            <img src="<?= base_url() ?>assets/front-end/images/svg/undraw_Booked_j7rj.svg" class="img-home">
          </div>

        </div>
      </div>
      <!-- Data Pesanan -->

    </div>
  </div>
</div>



<!-- Modal Detail Tiket -->
<div id="myModalTiket" class="modal">    
  <div class="modal-dialog" style="min-width: 100% !important">  
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title custom-font" id="myModalLabel"></h3>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12 text-center">
            <h4>E - Tiket</h4>
          </div>

          <div class="col-md-12">
            <p id="kereta">
              asd
            </p>
          </div>

          <div class="col-md-12 text-center">
            <p id="kota-tanggal">
            asd
            </p>
          </div>

          <div class="col-md-6">
            <p id="stasiun">asd </p>
          </div>

          <div class="col-md-6">
            <p id="berangkat"> 
            asd
            </p>
          </div>

          <div class="col-md-6 pt-5">
            <div class="form-group">
              <label for="tanggal">Kode Pemesanan</label>
              <input readonly type="text" id="kode-pemesan" class="form-control" required="required"/>
            </div>
          </div>
          <div class="col-md-6 pt-5">
            <div class="form-group">
              <label for="tanggal">Nama Pemesan</label>
              <input readonly type="text" id="pemesan" class="form-control" required="required"/>
            </div>
          </div>

          <table class="table table-dark table-bordered table-striped m-5">
            <tr>
              <th>No</th>
              <th>Title</th>
              <th>Nama Penumpang</th>
              <th>Kode Tiket</th>
              <th>Jenis Tiket</th>
              <th>No kursi</th>
            </tr>
            <tr>
              <td>1</td>
              <td id="title"></td>
              <td id="penumpang"></td>
              <td id="kode-tiket"></td>
              <td id="jenis"></td>
              <td id="nomer-kursi"></td>
            </tr>
          </table>

          </div>
        </div>
        <div class="modal-footer text-center">
          <button type="button" id="download-tiket" class="btn btn-success-costum btn-border"><i class="fa fa-download"></i> Download Tiket</button>
          <button class="btn btn-danger-costum btn-border" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal Detail Tiket -->




<!-- CSS dan JavaScript -->
<link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/toastr/toastr.min.css">
<script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/toastr/toastr.min.js"></script> 
<script src="<?= $this->plugin->build_url("javascripts/api-client.js", FALSE, 'site') ?>" type="text/javascript"></script>
<script src="<?= $this->plugin->build_url("javascripts/application.js", FALSE, 'site') ?>" type="text/javascript"></script> 
<?php if(file_exists(VIEWPATH."javascripts/page.$content.js")): ?>
  <script src="<?= $this->plugin->build_url("javascripts/page.$content.js") ?>" type="text/javascript"></script>
<?php endif; ?>


<style type="text/css">
  .form-search-area
  {
    box-shadow: 5px 5px 15px 5px #888888;
  }
</style>
<!-- CSS dan JavaScript -->