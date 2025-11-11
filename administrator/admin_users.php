<?php
// admin_users.php
session_start();
// TODO: load daftar pemustaka dari DB
?>
<!doctype html>
<html lang="id">
<head><meta charset="utf-8"><title>Data Pemustaka - UnivLib</title></head>
<body>
  <h1>Daftar Pemustaka</h1>
  <table border="1">
    <thead><tr><th>NIM</th><th>Nama</th><th>Email</th><th>Aksi</th></tr></thead>
    <tbody>
      <tr><td>240411100006</td><td>Nama A</td><td>a@example.com</td><td><a href="#">Lihat</a></td></tr>
    </tbody>
  </table>

  <p><a href="admin_dashboard.php">Kembali</a></p>
</body>
</html>
