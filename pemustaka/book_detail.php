<?php 
session_start();
// if(!isset($_SESSION['user'])){ header("Location: login.php"); exit; }

$data['title'] = 'Detail Buku';
$data['css']   = 'style.css';

require_once '../config/function.php';
require_once '../config/config.php';

$id = $_GET['id'];

$book = getData("SELECT * FROM buku WHERE id_buku = :id", ['id'=>$id])[0];

require_once '../components/header.php';
?>

<main class="main-layout">
    <?php require_once '../components/nav.php'; ?>

    <section class="content">
        
        <div class="detail-book">
            <img src="<?= $book['cover']; ?>" class="detail-cover">
            
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
