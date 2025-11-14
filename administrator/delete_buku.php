<?php
require_once '../config/config.php';
require_once '../config/function.php';

if (isset($_GET['id_buku'])) {
    $id = $_GET['id_buku'];

    // ambil data buku untuk hapus cover-nya
    $buku = fetchData("SELECT cover FROM buku WHERE id_buku = :id", ['id' => $id]);
    
    if ($buku && file_exists('../' . $buku[0]['cover'])) {
        unlink('../' . $buku[0]['cover']); // hapus file cover
    }

    $sql = "DELETE FROM buku WHERE id_buku = :id";
    $stmnt = DBH->prepare($sql);
    $stmnt->execute(['id' => $id]);

    header('Location: kelola_buku.php?msg=deleted');
    exit;
} else {
    header('Location: kelola_buku.php?error=invalid');
    exit;
}
?>
