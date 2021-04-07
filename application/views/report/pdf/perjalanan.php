<!DOCTYPE html>
<html><head>
  <title>Data Tiket Penerbangan</title>
</head><body>
<style type="text/css">
  table
  {
    border-collapse: collapse;
  }
</style>
<h3>Data TIket Perjalanan</h3>
    
<table border="1" cellpadding="5">
  <tr>
    <th>ID Tiket</th>
    <th>Kode</th>
    <th>Nama Kereta</th>
    <th>Kelas</th>
    <th>Kota Asal</th>
    <th>Kota Tujuan</th>
    <th>Stasiun Asal</th>
    <th>Stasiun Tujuan</th>
    <th>Tanggal Berankat</th>
    <th>Jam Berangkat</th>
    <th>Jam Sampai</th>
    <th>Total Harga</th>
    <th>No Kursi</th>
    <th>Status</th>
  </tr>
  <?php $no = 1; foreach($data as $r) : ?>
  <tr>
      <td><?= $no++ ?></td>
      <td><?= $r['tikk_id'] ?></td>
      <td><?= $r['tikk_jadk_kode'] ?></td>
      <td><?= $r['keret_nama'] ?></td>
      <td><?= $r['kela_nama'] ?></td>
      <td><?= $r['kota_asal'] ?></td>
      <td><?= $r['kota_tujuan'] ?></td>
      <td><?= $r['stat_asal'] ?></td>
      <td><?= $r['stat_tujuan'] ?></td>
      <td><?= $r['jadk_tanggal_berangkat'] ?></td>
      <td><?= $r['jadk_jam_berangkat'] ?></td>
      <td><?= $r['jadk_jam_berangkat_sampai'] ?></td>
      <td>$<?= $r['tikd_harga_usd'] ?></td>
      <td><?= $r['tikd_no_kursi'] ?></td>
      <td><?= $r['tikd_status'] ?></td>
  </tr>
  <?php endforeach; ?>
</table>
</body></html>