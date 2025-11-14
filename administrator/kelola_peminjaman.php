<?php 
session_start();
require_once '../config/config.php';
require_once '../config/function.php';

// cek apkah sesion sudah di set 
if(!(isset($_SESSION['user_id']) && isset($_SESSION['user_name']))){
    header("Location:" .BASE_URL . 'login.php');
}

$data['title'] = 'Kelola Peminjaman';
$data['css']   = ['style.css','tabel.css'];

// Ambil semua data peminjaman
$peminjaman = getAllPeminjaman();

require_once '../components/header.php';
?>

<main class="main-layout">
    <?php require_once '../components/nav.php'; ?>

    <section class="content">
        <h2>Kelola Status Peminjaman</h2>

        <?php if (empty($peminjaman)): ?>
            <p>Belum ada data peminjaman.</p>
        <?php else: ?>
            <table class="table-pinjaman">
                <tr>
                    <th>Pemustaka</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

                <?php foreach($peminjaman as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['nama_pemustaka']); ?></td>
                    <td><?= htmlspecialchars($p['judul']); ?></td>
                    <td><?= date('d M Y', strtotime($p['tanggal_peminjaman'])); ?></td>
                    <td><?= $p['tanggal_kembali'] ? date('d M Y', strtotime($p['tanggal_kembali'])) : '-'; ?></td>
                    <td>
                        <span class="badge <?= htmlspecialchars($p['status']); ?>">
                            <?= htmlspecialchars($p['status']); ?>
                        </span>
                    </td>
                    <td>
                        <form action="update_status.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id_peminjaman" value="<?= $p['id_peminjaman']; ?>">

                            <select name="status">
                                <option value="approved" <?= $p['status']=='borrowed'?'selected':''; ?>>Approve</option>
                                <option value="rejected" <?= $p['status']=='rejected'?'selected':''; ?>>Rejected</option>
                            </select>



                            <button type="submit">Ubah</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </section>
</main>

<?php require_once '../components/footer.php'; ?>
