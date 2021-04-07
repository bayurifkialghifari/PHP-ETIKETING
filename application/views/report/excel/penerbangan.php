<?php

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_tiketpenerbangan-".date('Y-M-D').".xls");

?>

<h3>Data TIket Penerbangan</h3>
    
<table border="1" cellpadding="5">
  <tr>
    <th>No</th>
    <th>ID Tiket</th>
    <th>Kode</th>
    <th>Maskapai</th>
    <th>Pesawat</th>
    <th>Kelas</th>
    <th>Kota Asal</th>
    <th>Kota Tujuan</th>
    <th>Bandara Asal</th>
    <th>Bandara Tujuan</th>
    <th>Tanggal Berankat</th>
    <th>Tanggal Sampai</th>
    <th>Jam Berangkat</th>
    <th>Jam Sampai</th>
    <th>Total Harga</th>
    <th>No Kursi</th>
    <th>Status</th>
  </tr>
  <?php $no = 1; foreach($data as $r) : ?>
  <tr>
      <td><?= $no++ ?></td>
      <td><?= $r['tikp_id'] ?></td>
      <td><?= $r['tikp_jadp_kode'] ?></td>
      <td><?= $r['mask_nama'] ?></td>
      <td><?= $r['pesa_nama'] ?></td>
      <td><?= $r['kela_nama'] ?></td>
      <td><?= $r['kota_asal'] ?></td>
      <td><?= $r['kota_tujuan'] ?></td>
      <td><?= $r['band_asal'] ?></td>
      <td><?= $r['band_tujuan'] ?></td>
      <td><?= $r['jadp_tanggal_berangkat'] ?></td>
      <td><?= $r['jadp_tanggal_berangkat_sampai'] ?></td>
      <td><?= $r['jadp_jam_berangkat'] ?></td>
      <td><?= $r['jadp_jam_berangkat_sampai'] ?></td>
      <td>$<?= $r['tikp_harga_usd'] ?></td>
      <td><?= $r['tipd_no_kursi'] ?></td>
      <td><?= $r['tipd_status'] ?></td>
  </tr>
  <?php endforeach; ?>
</table>