<?php

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_customer-".date('Y-M-D').".xls");

?>

<h3>Data Customer</h3>
    
<table border="1" cellpadding="5">
  <tr>
    <th>No</th>
    <th>Nama</th>
    <th>Email</th>
    <th>No Telepon</th>
    <th>Status</th>
    <th>Tanggal Daftar</th>
  </tr>
  <?php $no = 1; foreach($data as $r) : ?>
  <tr>
      <td><?= $no++ ?></td>
      <td><?= $r['user_name'] ?></td>
      <td><?= $r['user_email'] ?></td>
      <td><?= $r['user_phone'] ?></td>
      <td><?= $r['user_status'] ?></td>
      <td><?= $r['created_date'] ?></td>
  </tr>
  <?php endforeach; ?>
</table>