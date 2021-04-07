<div id="page-content-wrapper">

  <div class="container pt-3">
    
    <!-- SVG IMG -->
      <div class="row">
        <div class="col-md-12 pt-5">
          <div class="text-dark text-center">
            
            <h1 class="pt-5">
              <i class="fa fa-train"></i> <?= $title ?>
            </h1>

            <div class="text-center">
              <img src="<?= base_url() ?>assets/front-end/images/svg/undraw_subway_7vh7.svg" class="img-home">
            </div>

          </div>
        </div>
      </div>
    <!-- SVG IMG -->

    

    <!-- Form Cari Tiket -->
      <div class="row">

        <div class="col-md-12 text-left pt-5">
          <div class="form-group">
            <div class="form-search-area">
              <div class="container p-3">
                <form action="<?= base_url() ?>users/perjalanan/cari" method="get">

                  <div class="row">
                    
                    <div class="col-md-12">
                      <label>Jenis Perjalanan</label>
                      <select id="jenis-perjalanan" name="jenis-perjalanan" class="form-control">
                        <option value="SJ">Sekali Jalan</option>
                        <option value="PP">Pulang Pergi</option>
                      </select>
                    </div>

                    <div class="col-md-6 col-sm-12 pt-4">
                      <label>Dari</label>
                      <div>
                          <select id="dari" name="dari" class="chosen-select" style="width: 90%;" tabindex="3" required="">
                            <option value="">Dari</option>
                              <?php foreach($rute as $dari) : ?>
                                <option value="<?= $dari['stat_id'] ?>"><?= $dari['kota_nama'] ?> - <?= $dari['stat_nama'] ?></option>
                              <?php endforeach; ?>
                          </select>    
                      </div>
                    </div>


                    <div class="col-md-6 col-sm-12 pt-4">
                      <label>Ke</label>
                      <div>
                          <select id="ke" name="ke" class="chosen-select" style="width: 90%;" tabindex="3" required="">
                            <option value="">Ke</option>
                              <?php foreach($rute as $ke) : ?>
                                <option value="<?= $ke['stat_id'] ?>"><?= $ke['kota_nama'] ?> - <?= $ke['stat_nama'] ?></option>
                              <?php endforeach; ?>
                          </select>    
                      </div>
                    </div>

                    <div class="col-md-6 col-sm-12 pt-4">
                      <label>Tanggal Berangkat</label>
                      <input id="berangkat" name="berangkat" placeholder="Tanggal Berangkat" class="form-control" required="" autocomplete="off">
                    </div>


                    <div class="col-md-6 col-sm-12 pt-4">
                      <label>Tanggal Kembali</label>
                      <input id="sampai" name="sampai" placeholder="Tanggal Sampai" class="form-control" style="display: none;" autocomplete="off">
                    </div>

                    <div class="col-md-12 col-sm-12 pt-4">
                      <label>Kelas Kabin</label>
                      <select name="kelas" class="form-control" required="">
                        <option value="">Pilih Kelas</option>
                        <?php foreach($kelas as $kelas) : ?>
                          <option value="<?= $kelas['kela_id'] ?>"><?= $kelas['kela_nama'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    <div class="col-md-12 col-sm-12 pt-5 text-center">
                      <hr>
                      <h4>Penumpang</h4>
                    </div>

                    <div class="col-md-6 col-sm-6 pt-2">
                      <label>Dewasa  ( 3+ )</label>
                      <input type="number" name="jumlah-dewasa" id="jumlah-dewasa" class="form-control" placeholder="Dewasa">
                    </div>

                    <div class="col-md-6 col-sm-6 pt-2">
                      <label>Bayi  ( Kurang Dari 3 Tahun )</label>
                      <input type="number" name="jumlah-bayi" id="jumlah-bayi" class="form-control" placeholder="Bayi">
                    </div>

                    <div class="col-md-12 text-center pt-5 pb-5">
                      <button type="submit" class="btn btn-primary btn-costum-artikel mt-3">
                        <i class="fa fa-search"></i> Cari Perjalanan
                      </button>
                    </div>

                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    <!-- Form Cari Tiket -->
    


    <!-- Alternative Content -->
      <div class="row pt-5">
        
        <div class="col-md-12 text-dark text-center pt-5">
          <h1><br>Kenapa <b>etiketing.com</b>  <i class="fa fa-question"></i></h1>
        </div>

        <div class="col-md-5 pt-5">
          
          <div class="row">
            <div class="col-md-6">
              <div class="text-left">
                <img src="<?= base_url() ?>assets/front-end/images/svg/undraw_profile_6l1l.svg" style="width: 100%">
              </div>
            </div>
            <div class="col-md-6">
              <h4>Simple Profile </h4>
              <p>
                Pesan lebih cepat, isi data penumpang
                dengan sekali klik.
              </p>
            </div>
          </div>
        
        </div>
        
        <div class="col-md-2 pt-5">
          <!-- <img src="<?= base_url() ?>assets/front-end/images/svg/undraw_transfer_money_rywa.svg" style="width: 100%"> -->
        </div>

        <div class="col-md-5 pt-5">
          
          <div class="row">
            <div class="col-md-6">
              <h4>Simple Booking Process</h4>
              <p>
                Pemesanan tanpa ribet di mana pun dan
                kapan pun.
              </p>
            </div>
            <div class="col-md-6">
              <div class="text-left">
                <img src="<?= base_url() ?>assets/front-end/images/svg/undraw_confirm_89ui.svg" style="width: 100%">
              </div>
            </div>
          </div>
        
        </div>

        <div class="col-md-4"></div>
        <div class="col-md-5 justify-content-center text-center pt-5">
          
          <div class="row">
            <div class="col-md-6">
              <h4>Easy to pay</h4>
              <p>
                Bayar pesanan tiket lebih cepat dan efisien dengan <br><i class="fa fa-paypal"></i>ayPal.
              </p>
            </div>
            <div class="col-md-6">
              <div class="text-left">
                <img src="<?= base_url() ?>assets/front-end/images/svg/undraw_transfer_money_rywa.svg" style="width: 100%">
              </div>
            </div>
          </div>

        </div>

      </div>
      <hr>
    <!-- Alternative Content -->

    <!-- User Guide -->
      <div class="row pt-5">
        
        <div class="col-md-12 text-center text-dark pt-5">
          <h1><i class="fa fa-spinner"></i> Partner</h1>
        </div>
        <div class="col-md-6 pt-5">
          
          <div class="row">
            <div class="col-md-12">
              <div class="text-left">
                <img src="<?= base_url() ?>assets/upload/kai/Logo_PT_KAI_(Persero)_(New_version_2016).svg" style="width: 100%">
              </div>
            </div>
          </div>
        
        </div>

        <div class="col-md-6 pt-5">
          
          <div class="row">
            <div class="col-md-12">
              <h4>Kereta Api Indonesia</h4>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              </p>
            </div>
          </div>
        
        </div>

      </div>
    <!-- User Guide -->

    </div>

</div>


<style type="text/css">
  .form-search-area
  {
    box-shadow: 5px 5px 15px 5px #888888;
  }
</style>