<?php
session_start();
require_once '../config/config.php';
require_once '../config/function.php';

// Ambil data dari form
$id_peminjaman = $_POST['id_peminjaman'] ?? null;
$id_pemustaka  = $_SESSION['user_id'] ?? null;

if (!$id_peminjaman || !$id_pemustaka) {
    die("Data tidak lengkap!");
}

// Query untuk ubah status jadi 'returned'
$sql = "UPDATE peminjaman 
        SET status = 'returned', tanggal_kembali = CURDATE()
        WHERE id_peminjaman = :id_peminjaman 
        AND id_pemustaka = :id_pemustaka";

$result = runQuery($sql, [
    ':id_peminjaman' => $id_peminjaman,
    ':id_pemustaka'  => $id_pemustaka
]);

if ($result) {
    header("Location: riwayat.php");
    exit;
} else {
    echo "Gagal memperbarui status peminjaman.";
}
