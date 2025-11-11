<?php
// dashboard.php
session_start();
// contoh: cek login
// if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }

?>
<!doctype html>
<html lang="id">
<head><meta charset="utf-8"><title>Dashboard - UnivLib</title></head>
<body>
  <header>
    <h1>Dashboard Pemustaka</h1>
    <nav>
      <a href="books.php">Daftar Buku</a> |
      <a href="profile.php">Profil Saya</a> |
      <a href="my_loans.php">Riwayat Peminjaman</a> |
      <a href="logout.php">Logout</a>
    </nav>
  </header>

  <main>
    <section>
      <h2>Halo, [Nama Pemustaka]</h2>
      <p>Ringkasan: jumlah pinjaman aktif, denda, rekomendasi buku, dll.</p>
    </section>
  </main>
</body>
</html>
