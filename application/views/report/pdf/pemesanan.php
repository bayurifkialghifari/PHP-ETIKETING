<!DOCTYPE html>
<html><head>
  <title>Data Pemesanan</title>
</head><body>
<style type="text/css">
  table
  {
    border-collapse: collapse;
  }
</style>
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
</body></html>