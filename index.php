<!-- 
 
Sebagai halaman utama sistem UnivLib — tempat semua pengunjung pertama kali datang.

ecara default, index.php tidak wajib mengambil data dari database.
Karena dia hanya halaman sambutan (home page).
Tapi kamu boleh menambahkan data ringan biar dinamis, misalnya:

Contoh data yang diambil dari database:

5 buku terbaru (LIMIT 5)

Jumlah buku tersedia

Jumlah pemustaka terdaftar (opsional)

-->

<!-- "SELECT * FROM buku ORDER BY id_buku DESC LIMIT 5" -->


<!-- ?php if(isset($_SESSION['user'])): ?>
<nav>
  <a href="index.php">Beranda</a>
  <a href="daftar_buku.php">Daftar Buku</a>
  <a href="riwayat.php">Riwayat</a>
  <a href="profil.php">Profil</a>
  <a href="logout.php">Logout</a>
</nav>
 else:
<nav>
  <a href="index.php">Beranda</a>
  <a href="daftar_buku.php">Daftar Buku</a>
  <a href="login.php">Login</a>
  <a href="register.php">Daftar</a>
</nav>



| Menu        | Mengarah ke       | Fungsi                     |
| ----------- | ----------------- | -------------------------- |
| Beranda     | `index.php`       | Halaman utama              |
| Daftar Buku | `daftar_buku.php` | Melihat semua koleksi buku |
| Login       | `login.php`       | Form login pemustaka       |
| Register    | `register.php`    | Daftar akun baru           |
| Profil      | `profil.php`      | Data pribadi pemustaka     |
| Riwayat     | `riwayat.php`     | Histori peminjaman         |
| Logout      | `logout.php`      | Keluar dari sistem         |


| Halaman             | Pemustaka (login) | Pemustaka (belum login) | Admin |
| ------------------- | ----------------- | ----------------------- | ----- |
| index.php           | ✅                 | ✅                       | ❌     |
| daftar_buku.php     | ✅                 | ✅                       | ❌     |
| detail_buku.php     | ✅                 | ✅                       | ❌     |
| pinjam.php          | ✅                 | ❌ (redirect ke login)   | ❌     |
| profil.php          | ✅                 | ❌                       | ❌     |
| admin/login.php     | ❌                 | ❌                       | ✅     |
| admin/dashboard.php | ❌                 | ❌                       | ✅     |
