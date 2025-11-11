<?php 
session_start();
// if(!isset($_SESSION['user'])){ header("Location: login.php"); exit; }

$data['title'] = 'Katalog Buku';
$data['css']   = 'style.css';

require_once 'config/function.php';
require_once 'config/config.php';

// Search
$keyword = $_GET['search'] ?? "";

$books = getData("SELECT * FROM buku WHERE judul LIKE :k", ['k' => "%$keyword%"]);

require_once 'components/header.php';
?>

<main class="main-layout">
    <?php require_once 'components/nav.php'; ?>

    <section class="content">
        <h2>Katalog Buku</h2>

        <form action="" method="GET">
            <input type="text" name="search" placeholder="Cari judul..." value="<?= $keyword ?>">
        </form>

        <div class="book-grid">
            <?php foreach($books as $b): ?>
                <div class="book-card">
                    <img src="<?= $b['cover']; ?>">
                    <h3><?= $b['judul']; ?></h3>
                    <p><?= $b['penulis']; ?></p>

                    <a class="btn-detail" href="book_detail.php?id=<?= $b['id_buku']; ?>">Detail</a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php require_once 'components/footer.php'; ?>
