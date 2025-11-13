<?php
require_once 'config.php';
require_once 'database.php';


// FUNCTION PEMUSTAKA

// ambil data berdasarkan kategori
function getDataFilterSerch(string $query, array $params = []) {
    $stmnt = DBH->prepare($query);
    $stmnt->execute($params);
    return $stmnt->fetchAll(PDO::FETCH_ASSOC);
}
// register pemustaka
function registerPemustaka(array $data){
    $sql = "INSERT INTO pemustaka 
            (nama_pemustaka, email_pemustaka, nim_nip_pemustaka, password_pemustaka) 
            VALUES (:nama, :email, :nim_nip, :password)";

    $stmnt = DBH->prepare($sql);
    return $stmnt->execute([
        ':nama'      => $data['nama_pemustaka'],
        ':email'     => $data['email'],
        ':nim_nip'   => $data['nim_nip'],
        ':password'  => $data['password'],  
    ]);
}
// login pemustaka
function loginPemustaka(string $identity, string $password) {
    // Bisa login pakai email ATAU NIM/NIP
    $sql = "SELECT id_pemustaka, nama_pemustaka, email_pemustaka,
                   nim_nip_pemustaka, password_pemustaka
            FROM pemustaka
            WHERE email_pemustaka = :id OR nim_nip_pemustaka = :id
            LIMIT 1";

    $stmnt = DBH->prepare($sql);
    $stmnt->execute([':id' => $identity]);
    $user = $stmnt->fetch();

    if (!$user) {
        return false;
    }
    if (!password_verify($password, $user['password_pemustaka'])) {
        return false; 
    }
    return $user;
}

// peminjaman
function createPeminjaman(array $data){
    $sql = "INSERT INTO peminjaman 
            (id_pemustaka, id_buku, tanggal_pinjam, tanggal_kembali, status) 
            VALUES (:id_pemustaka, :id_buku, :t_pinjam, :t_kembali, :status)";
    $stmnt = DBH->prepare($sql);
    return $stmnt->execute([
        ':id_pemustaka' => $data['id_pemustaka'],
        ':id_buku'      => $data['id_buku'],
        ':t_pinjam'     => $data['tanggal_pinjam'],
        ':t_kembali'    => $data['tanggal_kembali'],
        ':status'       => $data['status']
    ]);
}
// FUNCTION ADMINISTRATOR

// tambah buku 
function addBukuAdministrator(array $data, array $file)
{
    try {
        // --- ambil data dari form ---
        $judul        = trim($data['judul']);
        $penulis      = trim($data['penulis']);
        $penerbit     = trim($data['penerbit']);
        $tahun_terbit = trim($data['tahun_terbit']);
        $kategori     = trim($data['kategori']);
        $deskripsi    = trim($data['deskripsi']);

        // --- penanganan file cover ---
        $coverFileName = null;
        if (!empty($file['name'])) {
            $uploadDir = 'assets/img/';

            // buat folder kalau belum ada
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileTmpPath = $file['tmp_name'];
            $fileName    = basename($file['name']);
            $fileExt     = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedExt  = ['jpg', 'jpeg', 'png', 'gif'];

            if (!in_array($fileExt, $allowedExt)) {
                throw new Exception("Format file tidak diperbolehkan. Hanya JPG, PNG, atau GIF.");
            }

            // nama file unik
            $newFileName = uniqid('cover_', true) . '.' . $fileExt;
            $destPath = $uploadDir . $newFileName;

            if (!move_uploaded_file($fileTmpPath, $destPath)) {
                throw new Exception("Gagal mengupload file cover buku.");
            }

            $coverFileName = $destPath;
        }

        // --- insert ke database ---
        $sql = "INSERT INTO buku 
                (judul, penulis, penerbit, tahun_terbit, cover, kategori, deskripsi)
                VALUES (:judul, :penulis, :penerbit, :tahun_terbit, :cover, :kategori, :deskripsi)";

        $stmt = DBH->prepare($sql);
        $stmt->execute([
            ':judul'        => $judul,
            ':penulis'      => $penulis,
            ':penerbit'     => $penerbit,
            ':tahun_terbit' => $tahun_terbit,
            ':cover'        => $coverFileName,
            ':kategori'     => $kategori,
            ':deskripsi'    => $deskripsi
        ]);

        return true;
    } catch (Exception $e) {
        // kalau ada error, bisa log atau tampilkan pesan
        error_log('Error addBukuAdministrator: ' . $e->getMessage());
        return $e->getMessage();
    }
}

// function ambil data
function getData($sql) {
    try {
        $stmnt = DBH->prepare($sql);
        $stmnt->execute();
        $data = $stmnt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    } catch (PDOException $e) {
        echo "Gagal mengambil data pemustaka: " . $e->getMessage();
        return [];
    }
}
// tambah buku
