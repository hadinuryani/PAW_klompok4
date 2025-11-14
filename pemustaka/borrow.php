<?php
session_start();
require_once '../config/config.php';
require_once '../config/function.php';

// ambil data dari form
$id_buku = $_POST['id_buku'] ?? null;
$id_pemustaka = $_SESSION['user_id'] ?? null;

if (!$id_buku || !$id_pemustaka) {
    die("ID buku tidak valid");
}

// Cek apakah buku sedang dipinjam user
$sql = "SELECT * FROM peminjaman
        WHERE id_buku = :id_buku
        AND id_pemustaka = :id_pemustaka
        AND status != 'returned'";

$stmt = DBH->prepare($sql);
$stmt->execute([
    ':id_buku' => $id_buku,
    ':id_pemustaka' => $id_pemustaka
]);

$cek = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Jika ada record, tolak peminjaman
if (count($cek) > 0) {
    $alert['pesan'] = "Anda masih meminjam buku ini. Harap kembalikan dulu.";
    $alert['href'] ='../pemustaka/riwayat.php';
    require_once '../components/alert.php';
    exit;
}

// INSERT PEMINJAMAN
$sql_insert = "INSERT INTO peminjaman (id_pemustaka, id_buku, tanggal_peminjaman,status)
               VALUES (:id_pemustaka, :id_buku, CURDATE(), 'pending')";

$stmt_insert = DBH->prepare($sql_insert);
$stmt_insert->execute([
    ':id_pemustaka' => $id_pemustaka,
    ':id_buku' => $id_buku
]);

$alert['pesan'] = "Buku berhasil dipinjam!";
$alert['href'] ='../pemustaka/riwayat.php';
require_once '../components/alert.php';
exit;
