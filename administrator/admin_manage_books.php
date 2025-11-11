<?php
// admin_manage_books.php
session_start();
// TODO: implement add/update/delete buku
?>
<!doctype html>
<html lang="id">
<head><meta charset="utf-8"><title>Kelola Koleksi Buku - UnivLib</title></head>
<body>
  <h1>Kelola Koleksi Buku</h1>

  <h2>Tambah Buku Baru</h2>
  <form method="post" action="admin_manage_books.php">
    <label>Judul: <input type="text" name="title" /></label><br/>
    <label>Penulis: <input type="text" name="author" /></label><br/>
    <label>ISBN: <input type="text" name="isbn" /></label><br/>
    <label>Tahun: <input type="text" name="year" /></label><br/>
    <button type="submit" name="action" value="add">Tambah</button>
  </form>

  <h2>Daftar Buku</h2>
  <table border="1">
    <thead><tr><th>ID</th><th>Judul</th><th>Penulis</th><th>Aksi</th></tr></thead>
    <tbody>
      <!-- loop buku -->
      <tr>
        <td>1</td><td>Judul A</td><td>Penulis A</td>
        <td>
          <a href="admin_manage_books.php?edit=1">Edit</a> |
          <a href="admin_manage_books.php?delete=1">Hapus</a>
        </td>
      </tr>
    </tbody>
  </table>

  <p><a href="admin_dashboard.php">Kembali</a></p>
</body>
</html>
