<!DOCTYPE html>
<html><head>
  <title>Data Pembayaran</title>
</head><body>
<style type="text/css">
  table
  {
    border-collapse: collapse;
  }
</style>
<h3>Data Pembayaran</h3>
<table border="1" cellpadding="5">
  <tr>
    <th>No</th>
    <th>Pemesan</th>
    <th>Metode pembayaran</th>
    <th>Status pembayaran</th>
    <th>Email pembayar</th>
    <th>Total pembayaran</th>
    <th>Tanggal pembayaran</th>
  </tr>
  <?php $no = 1; foreach($data as $r) : ?>
  <tr>
      <td><?= $no++ ?></td>
      <td><?= $r['peme_nama'] ?></td>
      <td><?= $r['PaymentMethod'] ?></td>
      <td><?= $r['PayerStatus'] ?></td>
      <td><?= $r['PayerMail'] ?></td>
      <td><?= dolar($r['Total']) ?></td>
      <td><?= $r['CreateTime'] ?></td>
  </tr>
  <?php endforeach; ?>
</table>
</body></html>