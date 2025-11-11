<?php
session_start();
// if(!isset($_SESSION['user'])){ header("Location: login.php"); exit; }

require_once 'config/function.php';

$id_user = $_SESSION['user']['id_pemustaka'];
$id_buku = $_POST['id_buku'];

$query = "INSERT INTO peminjaman (id_pemustaka, id_buku, status_peminjaman, tanggal_peminjaman)
          VALUES (:u, :b, 'pending', NOW())";

execute($query, ['u'=>$id_user, 'b'=>$id_buku]);

header("Location: riwayat.php?success=1");
exit;
