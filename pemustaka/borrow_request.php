<?php
session_start();
require_once '../config/function.php';
require_once '../config/config.php';

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

$id_user = $_SESSION['user']['id_user'];
$id_buku = $_POST['id_buku'] ?? null;

if (!$id_buku) {
    die("Data buku tidak ditemukan.");
}

// Cek apakah buku masih tersedia (misal stok > 0)
$book = getData("SELECT * FROM buku WHERE id_buku = :id", ['id'=>$id_buku])[0];

if (!$book) {
    die("Buku tidak ditemukan.");
}

// Cek apakah user sudah pinjam buku ini sebelumnya (optional)
$already = getData(
    "SELECT * FROM peminjaman WHERE id_user = :uid AND id_buku = :bid AND status = 'pinjam'",
    ['uid'=>$id_user, 'bid'=>$id_buku]
);

if ($already) {
    die("Anda sudah meminjam buku ini.");
}

// Insert ke tabel peminjaman
executeQuery(
    "INSERT INTO peminjaman (id_user, id_buku, tanggal_pinjam, status) 
     VALUES (:uid, :bid, NOW(), 'pinjam')",
    ['uid'=>$id_user, 'bid'=>$id_buku]
);

// (Opsional) Kurangi stok buku jika ada kolom stok
// executeQuery("UPDATE buku SET stok = stok - 1 WHERE id_buku = :bid", ['bid'=>$id_buku]);

header("Location: book_detail.php?id=$id_buku&msg=success");
exit;
?>
