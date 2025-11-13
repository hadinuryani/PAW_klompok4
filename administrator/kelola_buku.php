<?php
require_once '../config/function.php';
require_once '../config/config.php'; 
$query =  "SELECT id_buku, judul, penulis, penerbit, tahun_terbit, cover, kategori, deskripsi 
                FROM buku 
                WHERE judul LIKE :search 
                   OR penulis LIKE :search 
                   OR penerbit LIKE :search 
                ORDER BY id_buku DESC";

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th></th>
        </tr>
    </table>    
</body>
</html>