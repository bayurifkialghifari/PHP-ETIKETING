<?php

  $hargaDewasaUSD = 0;
  $hargaDewasaIDR = 0;
  $hargaAnakUSD   = 0;
  $hargaAnakIDR   = 0;
  $hargaBayiUSD   = 0;
  $hargaBayiIDR   = 0;

  if($dewasa > 0)
  {
    $hargaDewasaIDR  = (int)$pesawat['tikp_harga_idr'] * (int)$dewasa;
    $hargaDewasaUSD  = (int)$pesawat['tikp_harga_usd'] * (int)$dewasa; 
  }

  if($anak > 0)
  {
    $hargaAnakIDR  = (int)$pesawat['tikp_harga_idr'] * (int)$anak;
    $hargaAnakUSD  = (int)$pesawat['tikp_harga_usd'] * (int)$anak;
  }

  if($bayi > 0)
  {
    $hargaBayiIDR  = (int)$pesawat['tikp_harga_idr'] * (int)$bayi;
    $hargaBayiUSD  = (int)$pesawat['tikp_harga_usd'] * (int)$bayi;
  }

  $totalUSD            = (int)$hargaBayiUSD + (int)$hargaAnakUSD + (int)$hargaDewasaUSD;
  $totalIDR            = (int)$hargaBayiIDR + (int)$hargaAnakIDR + (int)$hargaDewasaIDR;

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
          <form method="post" action="<?= base_url() ?>users/pembayaran/pesanPembayaran" onsubmit="return confirm('Apakah anda yakin dengan data yang sudah anda inputkan ? Cek kembali kelengkapan data !!')">
          <div class="row">
            
            <input type="hidden" name="tiketId" value="<?= $tiketId ?>">
            <input type="hidden" name="hargaUSD" value="<?= $totalUSD ?>">
            <input type="hidden" name="hargaIDR" value="<?= $totalIDR ?>">
            <input type="hidden" name="kota_asal" value="<?= $pesawat['kota_asal'] ?>">
            <input type="hidden" name="kota_tujuan" value="<?= $pesawat['kota_tujuan'] ?>">

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
                              <select id="warganegara" required="" name="warganegarad[]" class="chosen-select" style="width: 90%;">
                                <option value="">Kewarganegaraan</option>
                                <?php for($n = 0; $n < count($negara); $n++) : ?>
                                  <option value="<?= $negara[$n]['nega_id'] ?>"><?= $negara[$n]['nega_nama'] ?></option>
                                <?php endfor; ?>
                              </select>
                            </div>

                          </div>
                        <?php endfor; ?>
                      <?php endif; ?>

                      <?php if($anak > 0) : ?>
                        <?php $no=1; for($i = 0; $i < $anak; $i++) : ?>
                          <label class="pt-5"><b>Detail Penumpang Anak - Anak <?= $no++ ?></b></label>
                          <div class="row pt-3">
                                      
                            <div class="col-md-4">
                              <select id="title" required="" name="titlepenumpanga[]" class="form-control">
                                <option value="">Title</option>
                                <option value="Tuan">Tuan</option>
                                <option value="Nyonya">Nyonya</option>
                                <option value="Nona">Nona</option>
                              </select>
                            </div>
                            <div class="col-md-8">
                              <input type="text" name="namapenumpanga[]" required="" class="form-control" placeholder="Nama lengkap">
                            </div>

                            <div class="col-md-12 pt-3">
                              <select id="warganegara" required="" name="warganegaraa[]" class="chosen-select" style="width: 90%;">
                                <option value="">Kewarganegaraan</option>
                                <?php foreach($negara as $negaraa) : ?>
                                  <option value="<?= $negaraa['nega_id'] ?>"><?= $negaraa['nega_nama'] ?></option>
                                <?php endforeach; ?>
                              </select>
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
                              <select id="warganegara" required="" name="warganegarab[]" class="chosen-select" style="width: 90%;">
                                <option value="">Kewarganegaraan</option>
                                <?php foreach($negara as $negarab) : ?>
                                  <option value="<?= $negarab['nega_id'] ?>"><?= $negarab['nega_nama'] ?></option>
                                <?php endforeach; ?>
                              </select>
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
                      <label><b>Penerbangan</b></label>
                      <div class="row">
                        <div class="col-md-4 col-sm-4 text-left">
                                
                          <img src="<?= base_url() ?>assets/upload/maskapai/<?= $pesawat['mask_logo'] ?>" class="img-penerbangan">
                        
                        </div>

                        <div class="col-md-8 col-sm-8 text-left">
                          
                          <p><b>Rute</b></p>

                          <p class="m--10"><?= $pesawat['kota_asal'] ?> - <?= $pesawat['kota_tujuan'] ?></p>
                          <p class="m--10"><?= formatHariTanggal($pesawat['jadp_tanggal_berangkat']) ?></p>

                          <hr class="hr-about-us" style="width: 100% !important; margin-top: -10px !important;">

                          <p><b>Harga</b></p>

                          <?php if($dewasa > 0) : ?>
                            
                            <p class="m--10">
                              Dewasa (<?= $dewasa ?>x)
                            </p>

                            <p style="width: 100% !important; margin-top: -10px !important;">

                              <?php echo rupiah((int)$pesawat['tikp_harga_idr'] * (int)$dewasa) ?> / $<?php echo (int)$pesawat['tikp_harga_usd'] * (int)$dewasa ?>

                            </p>

                          <?php endif; ?>

                          <?php if($anak > 0) : ?>
                            
                            <p class="m--10">Anak (<?= $anak ?>x)</p>
                            
                            <p style="width: 100% !important; margin-top: -10px !important;">

                              <?php echo rupiah((int)$pesawat['tikp_harga_idr'] * (int)$anak) ?> / $<?php echo (int)$pesawat['tikp_harga_usd'] * (int)$anak ?>

                            </p>

                          <?php endif; ?>

                          <?php if($bayi > 0) : ?>
                          
                            <p class="m--10">Bayi (<?= $bayi ?>x)</p>
                            
                            <p style="width: 100% !important; margin-top: -10px !important;">
                              
                              <?php echo rupiah((int)$pesawat['tikp_harga_idr'] * (int)$bayi) ?> / $<?php echo (int)$pesawat['tikp_harga_usd'] * (int)$bayi ?>

                            </p>

                          <?php endif; ?>

                          <hr class="hr-about-us" style="width: 100% !important; margin-top: -10px !important;">

                          <p><b>Pajak dan biaya lainya</b></p>

                          <p class="m--10">Pajak 10% : Temasuk</p>            
                          <p class="m--10">Biaya layanan penumpang : Gratis</p>              

                          <hr class="hr-about-us" style="width: 100% !important; margin-top: -10px !important;">
                          
                          <!-- <?php if($this->session->userdata('status') == true) : ?>
                            <p><b>Voucher</b></p>

                            <input type="text" class="form-control" id="voucher" placeholder="Masukan Kode Voucher">

                            <br>

                            <hr class="hr-about-us" style="width: 100% !important; margin-top: -10px !important;">
                          <?php endif; ?> -->

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