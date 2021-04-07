<div id="page-content-wrapper">

  <div class="container pt-3">
    
    <!-- SVG IMG -->
      <div class="row">
        <div class="col-md-12 pt-5">
          <div class="text-dark text-center">
            
            <h1 class="pt-5">
              <i class="fa fa-plane"></i> <?= $title ?>
            </h1>

            <div class="text-center">
              <img src="<?= base_url() ?>assets/front-end/images/svg/undraw_travel_booking_6koc.svg" class="img-home">
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
                <form action="<?= base_url() ?>users/penerbangan/cari" method="get">

                  <div class="row">
                    
                    <div class="col-md-12">
                      <label>Jenis Penerbangan</label>
                      <select id="jenis-penerbangan" name="jenis-penerbangan" class="form-control">
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
                                <option value="<?= $dari['band_id'] ?>"><?= $dari['kota_nama'] ?> - <?= $dari['band_nama'] ?></option>
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
                                <option value="<?= $ke['band_id'] ?>"><?= $ke['kota_nama'] ?> - <?= $ke['band_nama'] ?></option>
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

                    <div class="col-md-4 col-sm-4 pt-2">
                      <label>Dewasa  ( 12+ )</label>
                      <input type="number" name="jumlah-dewasa" id="jumlah-dewasa" class="form-control" placeholder="Dewasa">
                    </div>

                    <div class="col-md-4 col-sm-4 pt-2">
                      <label>Anak - anak ( 2 - 11 Tahun )</label>
                      <input type="number" name="jumlah-anak" id="jumlah-anak" class="form-control" placeholder="Anak - anak">
                    </div>

                    <div class="col-md-4 col-sm-4 pt-2">
                      <label>Bayi  ( Kurang Dari 2 Tahun )</label>
                      <input type="number" name="jumlah-bayi" id="jumlah-bayi" class="form-control" placeholder="Bayi">
                    </div>

                    <div class="col-md-12 text-center pt-5 pb-5">
                      <button type="submit" class="btn btn-primary btn-costum-artikel mt-3">
                        <i class="fa fa-search"></i> Cari Penerbangan
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
        
        <div class="col-md-12 text-dark pt-5 text-center">
          <h1><i class="fa fa-spinner"></i> Partner Maskapai</h1>
          <p>Dengan berbagai maskapai mitra, kami siap menerbangkan Anda ke mana pun.</p>
        </div>
        <div class="col-md-12 pt-5">
          
          <div class="row">
            <?php 
              $get = $this->db->get('maskapai')->result_array(); 

              foreach($get as $maskapai) :
            ?>
            <div class="col-md-2">
              <div class="text-left">
                <img src="<?= base_url() ?>assets/upload/maskapai/<?= $maskapai['mask_logo'] ?>" onclick="detail('<?= base_url() ?>assets/upload/maskapai/<?= $maskapai['mask_logo'] ?>', '<?= $maskapai['mask_nama'] ?>')" alt="<?= $maskapai['mask_deskripsi'] ?>" class="img-artikel">
              </div>
            </div>
            <?php endforeach; ?>
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