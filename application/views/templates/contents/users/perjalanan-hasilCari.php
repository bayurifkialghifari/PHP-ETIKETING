<div id="page-content-wrapper">

  <div class="container mb-5 pt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="text-dark text-left">
          
          <div class="text-center">
            <img src="<?= base_url() ?>assets/front-end/images/svg/undraw_destinations_fpv7.svg" class="img-home">
          </div>

          <h1>
            <i class="fa fa-plane"></i> <?= $title ?>
          </h1>

        </div>
      </div>
    </div>































  <!-- Splash Modal -->
  <div class="modal splash fade" id="splash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="min-width: 100% !important">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title text-center" id="myModalLabel">Cari Perjalanan</h3>
        </div>
        <form action="<?= base_url() ?>users/perjalanan/cari" method="get">
          <div class="modal-body">
            <div class="row">
                    
              <div class="col-md-12">
                <label>Jenis Perjalanan</label>
                <select id="jenis-perjalanan" name="jenis-perjalanan" class="form-control">
                  <?php if($jenis == 'SJ') : ?>
                    <option value="SJ" selected="">Sekali Jalan</option>
                  <?php else : ?>
                    <option value="PP" selected="">Pulang Pergi</option>
                  <?php endif; ?>
                </select>
              </div>

              <div class="col-md-6 col-sm-12 pt-4">
                <label>Dari</label>
                <div>
                    <select id="dari" name="dari" class="chosen-select" style="width: 90%;" tabindex="3" required="">
                      <option value="">Dari</option>
                        <?php foreach($rute as $dari) : ?>
                          <?php if($darii == $dari['stat_id']) : ?>
                            <option value="<?= $dari['stat_id'] ?>" selected=""><?= $dari['kota_nama'] ?> - <?= $dari['stat_nama'] ?></option>
                          <?php else : ?>
                            <option value="<?= $dari['stat_id'] ?>"><?= $dari['kota_nama'] ?> - <?= $dari['stat_nama'] ?></option>
                          <?php endif; ?>
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
                          <?php if($kee == $ke['stat_id']) : ?>
                            <option value="<?= $ke['stat_id'] ?>" selected=""><?= $ke['kota_nama'] ?> - <?= $ke['stat_nama'] ?></option>
                          <?php else : ?>
                            <option value="<?= $ke['stat_id'] ?>"><?= $ke['kota_nama'] ?> - <?= $ke['stat_nama'] ?></option>
                          <?php endif; ?>
                        <?php endforeach; ?>
                    </select>    
                </div>
              </div>

              <div class="col-md-6 col-sm-12 pt-4">
                <label>Tanggal Berangkat</label>
                <input id="berangkat" value="<?= $berangkat ?>" name="berangkat" placeholder="Tanggal Berangkat" class="form-control" required="" autocomplete="off">
              </div>


              <div class="col-md-6 col-sm-12 pt-4">
                <label>Tanggal Kembali</label>
                <input id="sampai" name="sampai" value="<?= $sampai ?>" placeholder="Tanggal Sampai" class="form-control" style="display: none;" autocomplete="off">
              </div>

              <div class="col-md-12 col-sm-12 pt-4">
                <label>Kelas Kabin</label>
                <select name="kelas" class="form-control" required="">
                  <option value="">Pilih Kelas</option>
                  <?php foreach($kelas as $kelas) : ?>
                    <?php if($kelasi == $kelas['kela_id']) : ?>
                      <option value="<?= $kelas['kela_id'] ?>" selected=""><?= $kelas['kela_nama'] ?></option>
                    <?php else : ?>
                      <option value="<?= $kelas['kela_id'] ?>"><?= $kelas['kela_nama'] ?></option>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="col-md-12 col-sm-12 pt-5 text-center">
                <hr>
                <h4>Penumpang</h4>
              </div>

              <div class="col-md-6 col-sm-6 pt-2">
                <label>Dewasa  ( 3+ )</label>
                <input type="number" name="jumlah-dewasa" id="jumlah-dewasa" value="<?= $dewasa ?>" class="form-control" placeholder="Dewasa">
              </div>

              <div class="col-md-6 col-sm-6 pt-2">
                <label>Bayi  ( Kurang Dari 3 Tahun )</label>
                <input type="number" name="jumlah-bayi" id="jumlah-bayi" value="<?= $bayi ?>" class="form-control" placeholder="Bayi">
              </div>

              <div class="col-md-12 text-center pt-2 pb-2">
                <button type="submit" class="btn btn-primary btn-costum-artikel mt-3">
                  <i class="fa fa-search"></i> Cari Penerbangan
                </button>
              </div>

            </div>
          </div>
        </form>
      </div>
    </div>
  </div>





















    <div class="row">

      <div class="col-md-12 text-left pt-5">
        <div class="form-group">
          <div class="form-search-area">
            <div class="container p-3">
              <div class="row mb-4">
                <div class="col-md-12 text-center">
                  <?php if($hasil_numRows > 0) : ?>
                    
                    <button type="button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" class="btn btn-primary btn-costum-artikel mt-2 mb-2">
                      <i class="fa fa-search"></i> Ubah Pencarian
                    </button>

                  <?php endif; ?>

                  <?php if($hasil_numRows > 0) : ?>
                    <?php foreach($hasil as $hasil) : ?>
                      <hr>
                      <div class="row text-left m-2">
                        <div class="col-md-12">
                          
                          <p><?= $hasil['keret_nama'] ?></p>
                          
                          <div class="row">
                            <div class="col-md-2 col-sm-2 text-center">
                              
                              <img src="<?= base_url() ?>assets/upload/kai/Logo_PT_KAI_(Persero)_(New_version_2016).svg" class="img-penerbangan">
                            
                            </div>
                            
                            <div class="col-md-4 col-sm-4">
                              <p>
                                
                                <?= $hasil['jadk_jam_berangkat'] ?> &nbsp; --- &nbsp; <?= diff_minutes($hasil['jadk_jam_berangkat'], $hasil['jadk_jam_berangkat_sampai']) ?> Jam &nbsp; ---  &nbsp; <?= $hasil['jadk_jam_berangkat_sampai'] ?>
                                  
                              </p>
                            </div>
                            
                            <div class="col-md-2 col-sm-2 text-center">
                              
                              <p>
                                <?= $hasil['kota_asal'] ?> - <?= $hasil['kota_tujuan'] ?> &nbsp;  
                              </p>
                            
                            </div>

                            <div class="col-md-4 col-sm-4 text-center">
                              
                              <p> <?= rupiah($hasil['tikd_harga_idr']) ?> &nbsp; / &nbsp; $<?= $hasil['tikd_harga_usd'] ?></p>

                              <a href="<?= base_url() ?>users/tiket/pesanKereta?dewasa=<?= $dewasa ?>&bayi=<?= $bayi ?>&hasil=<?= $hasil['tikk_id'] ?>" class="btn btn-success-costum"><i class="fa fa-plus"></i> PILIH</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; ?>

                  <?php else: ?>
                    <div class="row text-center m-5">
                        <div class="col-md-12">
                          <img src="<?= base_url() ?>assets/front-end/images/svg/undraw_travelers_qlt1.svg" class="img-tidakKetemu">
                          
                          <div class="text-center mt-5">
                            <h4>Penerbangan tidak tersedia</h4>

                            <p>Tip: Ubah pencarian dengan tanggal atau kelas kabin yang berbeda.</p>

                            <button type="button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" class="btn btn-primary btn-costum-artikel mt-2">
                              
                              <i class="fa fa-search"></i> Ubah Pencarian
                            
                            </button>

                          </div>
                        </div>
                      </div>
                  <?php endif; ?>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>

</div>


<style type="text/css">
  .form-search-area
  {
    box-shadow: 5px 5px 15px 5px #888888;
  }
</style>