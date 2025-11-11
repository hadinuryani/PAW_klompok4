<?php 
session_start();
// if(!isset($_SESSION['user'])){ header("Location: login.php"); exit; }

$data['title'] = 'Dashboard';
$data['css']   = 'style.css';

require_once 'config/function.php';
require_once 'config/config.php';

// Ambil buku terbaru
$books = getData("SELECT * FROM buku ORDER BY id_buku DESC LIMIT 8");

require_once 'components/header.php';
?>

<main class="main-layout">
    <?php require_once 'components/nav.php'; ?>

    <section class="content">
        <h2>Recently Added</h2>
        <div class="book-grid">
        <?php foreach($books as $b): ?>
            <div class="book-card">
                <img src="<?= $b['cover']; ?>" alt="">
                <h3><?= $b['judul']; ?></h3>
                <p><?= $b['penulis']; ?></p>

                <a class="btn-detail" href="pemustaka/book_detail.php?id=<?= $b['id_buku']; ?>">Detail</a>
            </div>
        <?php endforeach; ?>
        </div>
    </section>
</main>

<?php require_once 'components/footer.php'; ?>
