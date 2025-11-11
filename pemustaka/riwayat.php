<?php 
session_start();
// if(!isset($_SESSION['user'])){ header("Location: login.php"); exit; }

$data['title'] = 'Riwayat Peminjaman';
$data['css']   = 'style.css';

require_once 'config/function.php';
require_once 'config/config.php';

$id = $_SESSION['user']['id_pemustaka'];

$query = "
SELECT p.*, b.judul, b.cover 
FROM peminjaman p
JOIN buku b ON b.id_buku = p.id_buku
WHERE p.id_pemustaka = :id
ORDER BY p.tanggal_peminjaman DESC
";

$rows = getData($query, ['id'=>$id]);

require_once 'components/header.php';
?>

<main class="main-layout">
    <?php require_once 'components/nav.php'; ?>

    <section class="content">
        <h2>Riwayat Peminjaman</h2>

        <table class="table-pinjaman">
            <tr>
                <th>Cover</th>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>

            <?php foreach($rows as $r): ?>
            <tr>
                <td><img src="<?= $r['cover']; ?>" class="small-cover"></td>
                <td><?= $r['judul']; ?></td>
                <td><?= date('d M Y', strtotime($r['tanggal_peminjaman'])); ?></td>
                <td><span class="badge <?= $r['status_peminjaman']; ?>">
                    <?= $r['status_peminjaman']; ?>
                </span></td>
            </tr>
            <?php endforeach; ?>

        </table>
    </section>
</main>

<?php require_once 'components/footer.php'; ?>
