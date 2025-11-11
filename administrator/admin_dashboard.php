<?php
// admin_dashboard.php
session_start();
// if (!isset($_SESSION['admin_id'])) { header('Location: admin_login.php'); exit; }
?>
<!doctype html>
<html lang="id">
<head><meta charset="utf-8"><title>Admin Dashboard - UnivLib</title></head>
<body>
  <h1>Admin - Dashboard</h1>
  <nav>
    <a href="admin_manage_books.php">Kelola Koleksi Buku</a> |
    <a href="admin_users.php">Lihat Data Pemustaka</a> |
    <a href="admin_loans.php">Perbarui Status Peminjaman</a> |
    <a href="logout.php">Logout</a>
  </nav>

  <section>
    <p>Ringkasan statistik: jumlah buku, buku dipinjam, jumlah pemustaka, request peminjaman pending.</p>
  </section>
</body>
</html>
