<?php

  $hargaDewasaUSD = 0;
  $hargaDewasaIDR = 0;
  $hargaBayiUSD   = 0;
  $hargaBayiIDR   = 0;

  if($dewasa > 0)
  {
    $hargaDewasaIDR  = (int)$kereta['tikd_harga_idr'] * (int)$dewasa;
    $hargaDewasaUSD  = (int)$kereta['tikd_harga_usd'] * (int)$dewasa; 
  }

  if($bayi > 0)
  {
    $hargaBayiIDR  = (int)$kereta['tikd_harga_idr'] * (int)$bayi;
    $hargaBayiUSD  = (int)$kereta['tikd_harga_usd'] * (int)$bayi;
  }

  $totalUSD            = (int)$hargaBayiUSD  + (int)$hargaDewasaUSD;
  $totalIDR            = (int)$hargaBayiIDR  + (int)$hargaDewasaIDR;

?>

  <div class="container mb-5 pt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="text-dark text-left">
          
          <div class="text-center">
            <img src="<?= base_url() ?>assets/front-end/images/svg/undraw_travel_booking_6koc.svg" class="img-home">
          </div>

          <h1>
            <i class="fa fa-plane"></i> <?= $title ?>
          </h1>

        </div>
      </div>
    </div>

    <div class="row">

      <div class="col-md-12 text-left pt-5">
        <div class="form-group">
          <form method="post" action="<?= base_url() ?>users/pembayaranKereta/pesanPembayaran" onsubmit="return confirm('Apakah anda yakin dengan data yang sudah anda inputkan ? Cek kembali kelengkapan data !!')">
          <div class="row">
            
            <input type="hidden" name="tiketId" value="<?= $tiketId ?>">
            <input type="hidden" name="hargaUSD" value="<?= $totalUSD ?>">
            <input type="hidden" name="hargaIDR" value="<?= $totalIDR ?>">
            <input type="hidden" name="kota_asal" value="<?= $kereta['kota_asal'] ?>">
            <input type="hidden" name="kota_tujuan" value="<?= $kereta['kota_tujuan'] ?>">

            <div class="col-md-7 col-sm-7">
              <div class="form-search-area mb-4">
                <div class="container p-3">
                  <div class="row">  

                    <div class="col-md-12">
                      <label><b>Detail Pemesan</b></label>
                      <div class="row">
                        <?php if($this->session->userdata('status') == true) : ?>
                          <div class="col-md-4">
                            <select id="title" required="" name="titlepemesan" class="form-control">
                              <option value="">Title</option>
                              <option value="Tuan" selected="">Tuan</option>
                              <option value="Nyonya">Nyonya</option>
                              <option value="Nona">Nona</option>
                            </select>
                          </div>
                          <div class="col-md-8">
                            <input type="text" name="namapemesan" value="<?= $this->session->userdata('data')['nama'] ?>" required="" class="form-control" placeholder="Nama lengkap">
                          </div>

                          <div class="col-md-12 pt-3">
                            <input type="email" name="emailpemesan" required="" value="<?= $this->session->userdata('data')['email'] ?>" class="form-control" placeholder="Alamat email aktif">
                          </div>
                        <?php else : ?>
                          <div class="col-md-4">
                            <select id="title" required="" name="titlepemesan" class="form-control">
                              <option value="">Title</option>
                              <option value="Tuan">Tuan</option>
                              <option value="Nyonya">Nyonya</option>
                              <option value="Nona">Nona</option>
                            </select>
                          </div>
                          <div class="col-md-8">
                            <input type="text" name="namapemesan" required="" class="form-control" placeholder="Nama lengkap">
                          </div>

                          <div class="col-md-12 pt-3">
                            <input type="email" name="emailpemesan" required="" class="form-control" placeholder="Alamat email aktif">
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

              <div class="form-search-area">
                <div class="container p-3 mb-4">
                  <div class="row">  
                    
                    <div class="col-md-12">
                      
                      <?php if($dewasa > 0) : ?>
                        <?php $no=1; for($i = 0; $i < $dewasa; $i++) : ?>
                          <label class="pt-5"><b>Detail Penumpang Dewasa <?= $no++ ?></b></label>
                          <div class="row pt-3">
                                      
                            <div class="col-md-4">
                              <select id="title" required="" name="titlepenumpangd[]" class="form-control">
                                <option value="">Title</option>
                                <option value="Tuan">Tuan</option>
                                <option value="Nyonya">Nyonya</option>
                                <option value="Nona">Nona</option>
                              </select>
                            </div>
                            <div class="col-md-8">
                              <input type="text" name="namapenumpangd[]" required="" class="form-control" placeholder="Nama lengkap">
                            </div>

                            <div class="col-md-12 pt-3">
                              <input type="text" name="ktpd[]" required="" class="form-control" placeholder="No KTP/SIM/Dan lainya">
                              <label style="font-size: 12px">Untuk penumpang di bawah 18 tahun, silakan isi dengan tanggal lahir (hhbbtttt). Contoh: 17071999</label>
                            </div>

                          </div>
                        <?php endfor; ?>
                      <?php endif; ?>

                      <?php if($bayi > 0) : ?>
                        <?php $no=1; for($i = 0; $i < $bayi; $i++) : ?>
                          <label class="pt-5"><b>Detail Penumpang Bayi <?= $no++ ?></b></label>
                          <div class="row pt-3">
                                      
                            <div class="col-md-4">
                              <select id="title" required="" name="titlepenumpangb[]" class="form-control">
                                <option value="">Title</option>
                                <option value="Tuan">Tuan</option>
                                <option value="Nyonya">Nyonya</option>
                                <option value="Nona">Nona</option>
                              </select>
                            </div>
                            <div class="col-md-8">
                              <input type="text" name="namapenumpangb[]" required="" class="form-control" placeholder="Nama lengkap">
                            </div>

                            <div class="col-md-12 pt-3">
                              <input type="text" name="ktpb[]" required="" class="form-control" placeholder="No KTP/SIM/Dan lainya">
                              <label style="font-size: 12px">Untuk penumpang di bawah 18 tahun, silakan isi dengan tanggal lahir (hhbbtttt). Contoh: 17071999</label>
                            </div>

                          </div>
                        <?php endfor; ?>
                      <?php endif; ?>
                      <input type="hidden" id="typePembayaran" name="type">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="text-center">
                            <button id="manual" type="submit" class="btn btn-success-costum mt-5 mb-5">
                                    
                              <i class="fa fa-plus"></i> Bayar Manual
                            
                            </button>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="text-center">
                            <button id="paypal" type="submit" class="btn btn-primary-costum btn-costum-artikel mt-5 mb-5">
                                    
                              <i class="fa fa-paypal"></i> Bayar Dengan PayPal
                            
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-md-5 col-sm-5">
              <div class="form-search-area mb-4">
                <div class="container p-3">
                  <div class="row">

                    <div class="col-md-12">
                      <label><b>Perjalanan</b></label>
                      <div class="row">
                        <div class="col-md-4 col-sm-4 text-left">
                                
                          <img src="<?= base_url() ?>assets/upload/kai/Logo_PT_KAI_(Persero)_(New_version_2016).svg" class="img-penerbangan">
                        
                        </div>

                        <div class="col-md-8 col-sm-8 text-left">
                          
                          <p><b>Rute</b></p>

                          <p class="m--10"><?= $kereta['kota_asal'] ?> - <?= $kereta['kota_tujuan'] ?></p>
                          <p class="m--10"><?= formatHariTanggal($kereta['jadk_tanggal_berangkat']) ?></p>

                          <hr class="hr-about-us" style="width: 100% !important; margin-top: -10px !important;">

                          <p><b>Harga</b></p>

                          <?php if($dewasa > 0) : ?>
                            
                            <p class="m--10">
                              Dewasa (<?= $dewasa ?>x)
                            </p>

                            <p style="width: 100% !important; margin-top: -10px !important;">

                              <?php echo rupiah((int)$kereta['tikd_harga_idr'] * (int)$dewasa) ?> / $<?php echo (int)$kereta['tikd_harga_usd'] * (int)$dewasa ?>

                            </p>

                          <?php endif; ?>

                          <?php if($bayi > 0) : ?>
                          
                            <p class="m--10">Bayi (<?= $bayi ?>x)</p>
                            
                            <p style="width: 100% !important; margin-top: -10px !important;">
                              
                              <?php echo rupiah((int)$kereta['tikd_harga_idr'] * (int)$bayi) ?> / $<?php echo (int)$kereta['tikd_harga_usd'] * (int)$bayi ?>

                            </p>

                          <?php endif; ?>

                          <hr class="hr-about-us" style="width: 100% !important; margin-top: -10px !important;">

                          <p><b>Pajak dan biaya lainya</b></p>

                          <p class="m--10">Pajak  : Temasuk</p>            
                          <p class="m--10">Biaya layanan penumpang : Gratis</p>              

                          <hr class="hr-about-us" style="width: 100% !important; margin-top: -10px !important;">

                          <p><b>Total pembayaran</b></p>

                          <p class="m--10">

                            <?= rupiah($totalIDR) . " / $" . $totalUSD ?>

                          </p>

                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
          </form>
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

  .m--10
  {
    margin-top: -10px !important;
  }
</style>
<script type="text/javascript">
  $(() =>
  {
    $('#manual').on('click', () =>
    {
      $('#typePembayaran').val('manual')
    })

    $('#paypal').on('click', () =>
    {
      $('#typePembayaran').val('paypal')
    })
  })
</script>