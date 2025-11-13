<?php 
session_start();

// set nama title dan css 
$data['title'] = 'Dashboard';
$data['css']   = 'style.css';
require_once 'config/function.php';
require_once 'config/config.php';

// cek apkah sesion sudah di set 
if(!(isset($_SESSION['user_id']) && isset($_SESSION['user_name']))){
    header("Location:" .BASE_URL . 'login.php');
}

$params = [];
$where = [];
$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$kat = $_GET['kategori'] ?? null;

// filter kata kunci
if ($q !== '') {
    $where[] = "(judul LIKE :q OR penulis LIKE :q)";
    $params['q'] = "%$q%";
}
// filter kategori
if ($kat) {
    $where[] = "kategori = :kat";
    $params['kat'] = $kat;
}
// Bangun query
$sql = "SELECT * FROM buku";
if (!empty($where)) {
    $sql .= " WHERE " . implode(" AND ", $where);
}
$sql .= " ORDER BY id_buku DESC LIMIT 10";
$books =  getDataFilterSerch($sql, $params);

require_once 'components/header.php';
?>

<main class="main-layout">
    
    <?php require_once 'components/nav.php'; ?>

    <section class="content">
    
        <!-- FILTER KATEGORI -->
        <div class="kategori-filter">
            <a class="<?= !$kat ? 'active' : '' ?>" href="index.php">Semua</a>
            <a class="<?= $kat=='umum' ? 'active' : '' ?>" href="?kategori=umum">Umum</a>
            <a class="<?= $kat=='referensi' ? 'active' : '' ?>" href="?kategori=referensi">Referensi</a>
            <a class="<?= $kat=='fiksi' ? 'active' : '' ?>" href="?kategori=fiksi">Fiksi</a>
            <a class="<?= $kat=='skripsi' ? 'active' : '' ?>" href="?kategori=skripsi">Skripsi</a>
            <a class="<?= $kat=='jurnal' ? 'active' : '' ?>" href="?kategori=jurnal">Jurnal</a>
        </div>

        <div class="book-grid">
        <?php foreach($books as $book): ?>
            <div class="book-card">
                <img src="<?= $book['cover']; ?>" alt="">
                <h3><?= $book['judul']; ?></h3>
                <a class="btn-detail" href="pemustaka/book_detail.php?id=<?= $book['id_buku']; ?>">Show Detail</a>
            </div>
        <?php endforeach; ?>
        </div>
    </section>
</main>

<?php require_once 'components/footer.php'; ?>
