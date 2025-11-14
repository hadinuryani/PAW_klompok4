<?php 
session_start();
require_once '../config/function.php';
require_once '../config/config.php';

$data['title'] = 'Detail Buku';
$data['css'] = ['style.css', 'book.css'];

// cek apkah sesion sudah di set 
if(!(isset($_SESSION['user_id']) && isset($_SESSION['user_name']))){
    header("Location:" .BASE_URL . 'login.php');
}

$id = $_GET['id'];


$book = fetchData("SELECT * FROM buku WHERE id_buku = :id", ['id'=>$id])[0];


require_once '../components/header.php';
?> 

<main class="main-layout">
    <!-- navbar -->
    <?php require_once '../components/nav.php'; ?>

    <section class="content">
        
        <div class="detail-book">
            <img src="<?= BASE_URL; ?>assets/img/<?= $book['cover']; ?>" class="detail-cover">
           
            <div class="detail-info">
                <h2><?= $book['judul']; ?></h2>
                <p><b>Penulis:</b> <?= $book['penulis']; ?></p>
                <p><b>Penerbit:</b> <?= $book['penerbit']; ?></p>
                <p><b>Tahun:</b> <?= $book['tahun_terbit']; ?></p>
                <p><b>Kategori:</b><?= $book['kategori']; ?></p>
                <p><b>Deskripsi:</b><?= $book['deskripsi']; ?></p>

                <form action="borrow.php" method="POST">
                    <input type="hidden" name="id_buku" value="<?= $id; ?>">
                    <button class="btn-pinjam">Pinjam Buku</button>
                </form>
            </div>
        </div>
    </section>
</main>

<?php require_once '../components/footer.php'; ?>
