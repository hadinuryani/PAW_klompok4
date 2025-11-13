<?php 
require_once '../config/config.php';
require_once '../config/function.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = addBukuAdministrator($_POST, $_FILES['cover']);

    if ($result === true) {
        echo "✅ Data buku berhasil ditambahkan.";
        echo "<br><a href='daftar_buku.php'>Kembali ke daftar buku</a>";
    } else {
        echo "❌ Gagal menambahkan buku: " . htmlspecialchars($result);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>tambah buku</h1>
    <form action="#" method="POST" enctype="multipart/form-data">
    <h2>Tambah Buku Baru</h2>

    <label for="judul">Judul Buku:</label><br>
    <input type="text" id="judul" name="judul" required><br><br>

    <label for="penulis">Penulis:</label><br>
    <input type="text" id="penulis" name="penulis" required><br><br>

    <label for="penerbit">Penerbit:</label><br>
    <input type="text" id="penerbit" name="penerbit" required><br><br>

    <label for="tahun_terbit">Tahun Terbit:</label><br>
    <input type="number" id="tahun_terbit" name="tahun_terbit" min="1900" max="2099" required><br><br>

    <label for="kategori">Kategori:</label><br>
    <select id="kategori" name="kategori" required>
        <option value="">-- Pilih Kategori --</option>
        <option value="umum">Umum</option>
        <option value="referensi">Referensi</option>
        <option value="fiksi">Fiksi</option>
        <option value="skripsi">Skripsi</option>
        <option value="jurnal">Jurnal</option>
    </select><br><br>

    <label for="deskripsi">Deskripsi:</label><br>
    <textarea id="deskripsi" name="deskripsi" rows="4" cols="50" placeholder="Tulis deskripsi singkat..."></textarea><br><br>

    <label for="cover">Upload Cover Buku:</label><br>
    <input type="file" id="cover" name="cover" accept="image/*"><br><br>

    <button type="submit" name="submit">Simpan Buku</button>
</form>

</body>
</html>