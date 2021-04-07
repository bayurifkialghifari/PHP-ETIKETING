<?php

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_pembayaran-".date('Y-M-D').".xls");

?>

<h3>Data Pemesanan</h3>
    
<table border="1" cellpadding="5">
  <tr>
    <th>No</th>
    <th>Kode</th>
    <th>Pemesan</th>
    <th>Penumpang</th>
    <th>Status Pesanan</th>
    <th>Tipe Tiket</th>
    <th>Tanggal Pemesanan</th>
  </tr>
  <?php $no = 1; foreach($data as $r) : ?>
  <tr>
      <td><?= $no++ ?></td>
      <td><?= $r['pemt_kode'] ?></td>
      <td><?= $r['peme_nama'] ?></td>
      <td><?= $r['penu_nama'] ?></td>
      <td><?= $r['pemt_status'] ?></td>
      <td><?= $r['pemt_status_pesanan'] ?></td>
      <td><?= $r['pemt_tanggal'] ?></td>
  </tr>
  <?php endforeach; ?>
</table>