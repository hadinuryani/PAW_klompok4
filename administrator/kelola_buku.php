<?php
require_once '../config/function.php';
require_once '../config/config.php'; 
$query =  "SELECT id_buku,judul,penulis,penerbit,kategori FROM buku";
$buku = getData($query);

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>kelola koleksi buku</h1>
    <table>
        <tr>
            <th>No</th>
            <th>judul Buku</th>
            <th>penulis</th>
            <th>penerbit</th>
            <th>kategori</th>
            <th>aksi</th>
        </tr>
        <?php $no=1; foreach($buku as $b) :?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $b['judul']; ?></td>
                <td><?= $b['penulis']; ?></td>
                <td><?= $b['penerbit']; ?></td>
                <td><?= $b['kategori']; ?></td>
                <td>
                    <a href="<?= BASE_URL; ?>/administrator/delete.php?id_buku=<?= $b['id_buku']; ?>">Delete</a>
                    <a href="/update">Update</a>
                </td>
            </tr>
            <?php $no++; ?>
        <?php endforeach ?>
    </table>    
</body>
</html>