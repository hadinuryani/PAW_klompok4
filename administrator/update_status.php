<?php
require_once '../config/config.php';
require_once '../config/function.php';

$id_peminjaman = $_POST['id_peminjaman'] ?? null;
$action = $_POST['status'] ?? null;

if (!$id_peminjaman || !$action) {
    die("Data tidak lengkap!");
}

$status = ($action === 'approved') ? 'borrowed' : 'rejected';

if (updateStatusPeminjaman((int)$id_peminjaman, $status)) {
    $alert['pesan'] = "Status peminjaman berhasil diperbarui!";
    $alert['href'] ='../administrator/kelola_peminjaman.php';
    require_once '../components/alert.php';
    exit;
} else {
    $alert['pesan'] = "Gagal memperbarui status!";
    $alert['href'] ='../administrator/kelola_peminjaman.php';
    require_once '../components/alert.php';
    exit;
  
}
?>
