<?php 
session_start();
// cek apkah sesion sudah di set 
if(!(isset($_SESSION['user_id']) && isset($_SESSION['user_name']))){
    header("Location:" .BASE_URL . 'login.php');
}

require_once '../config/config.php';
require_once '../config/function.php';

$sql = "SELECT 
            p.id_peminjaman,
            p.tanggal_peminjaman,
            p.tanggal_kembali,
            p.status,
            b.judul,
            b.cover
        FROM peminjaman p
        JOIN buku b ON b.id_buku = p.id_buku
        WHERE p.id_pemustaka = :id
        ORDER BY p.tanggal_peminjaman DESC
    ";
// ambil data riwayat
$rows = fetchData($sql,[':id' => $_SESSION['user_id']]);

// set data template
$data['title'] = 'Riwayat Peminjaman';
$data['css'] = ['style.css','tabel.css'];

// header layout
require_once '../components/header.php';
?>

<main class="main-layout">
    <?php require_once '../components/nav.php'; ?>

    <section class="content">
        <h2>Riwayat Peminjaman</h2>

        <?php if (empty($rows)): ?>
            <p>Belum ada riwayat peminjaman.</p>
        <?php else: ?>
            <table border="1" class="table-pinjaman">
                <tr>
                    <th>Cover</th>
                    <th>Judul</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

                <?php foreach($rows as $r): ?>
                <tr>
                    <td>
                        <?php if (!empty($r['cover'])): ?>
                            <img src="<?= BASE_URL; ?>assets/img/<?= $r['cover']; ?>" class="small-cover">
                        <?php else: ?>
                            <span style="color:#888;">Tidak ada</span>
                        <?php endif; ?>
                    </td>
                    <td><?= $r['judul']; ?></td>
                    <td><?= date('d M Y', strtotime($r['tanggal_peminjaman'])); ?></td>
                    <td><?= $r['tanggal_kembali'] ? date('d M Y', strtotime($r['tanggal_kembali'])) : '-'; ?></td>
                    <td>
                        <span class="badge <?= $r['status']; ?>">
                            <?= ucfirst($r['status']); ?>
                        </span>
                    </td>
                    <td>

                        <?php if ($r['status'] === 'pending' || $r['status'] === 'borrowed'): ?>
                            <form action="kembalikan_buku.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id_peminjaman" value="<?= $r['id_peminjaman']; ?>">
                                <button type="submit">Kembalikan</button>
                            </form>
                        <?php endif; ?>
                    </td>

                </tr>
                <?php endforeach; ?>
            </table>

        <?php endif; ?>
    </section>
</main>

<?php require_once '../components/footer.php'; ?>
