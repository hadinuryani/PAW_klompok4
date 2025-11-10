<!-- $query = "SELECT * FROM buku ORDER BY judul ASC"; -->


<!-- <section class="buku">
  <h2>Daftar Buku</h2>
  <input type="text" placeholder="Cari Buku..." name="search">
  <div class="buku-list">
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
      <div class="card">
        <h3><?= $row['judul']; ?></h3>
        <p><?= $row['pengarang']; ?></p>
        <p><b>Kategori:</b> <?= $row['kategori']; ?></p>
        <a href="detail_buku.php?id=<?= $row['id_buku']; ?>">Lihat Detail</a>
      </div>
    <?php } ?>
  </div>
</section> -->

Tombol “Pinjam Buku” hanya muncul kalau user login:

if(isset($_SESSION['user'])) {
  echo '<a href="pinjam.php?id='.$row['id_buku'].'">Pinjam Buku</a>';
} else {
  echo '<a href="login.php">Login untuk Meminjam</a>';
}