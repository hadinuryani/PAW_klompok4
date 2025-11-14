<?php if($_SESSION['role'] == 'pemustaka') :?>
<nav class="sidebar">
    <ul>
        <li><a href="<?= BASE_URL; ?>">Home</a></li>
        <li><a href="<?= BASE_URL; ?>pemustaka/riwayat.php">Riwayat Peminjaman</a></li>
        <li><a href="<?= BASE_URL; ?>pemustaka/profil.php">Lihat Profil</a></li>
    </ul>
    <a href="<?= BASE_URL; ?>/logout.php" class="logout-btn">Logout</a>
</nav>
<?php elseif($_SESSION['role'] == 'administrator') :?>
<nav class="sidebar">
    <ul>
        <li><a href="<?= BASE_URL; ?>administrator/kelola_buku.php">Kelola Koleksi Buku</a></li>
        <li><a href="<?= BASE_URL; ?>administrator/daftar_pemustaka.php">Lihat Daftar Pustaka</a></li>
        <li><a href="<?= BASE_URL; ?>administrator/kelola_peminjaman.php">Perbarui Status Peminjaman</a></li>
    </ul>
    <a href="<?= BASE_URL; ?>/logout.php" class="logout-btn">Logout</a>
</nav>
<?php endif; ?>