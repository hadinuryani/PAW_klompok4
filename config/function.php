<?php
require_once 'config.php';
require_once 'database.php';

// ======================
// FUNGSI INTI
// ======================

// Ambil data (bisa banyak / 1 row)
function fetchData(string $sql, array $params = [], bool $single = false) {
    $stmnt = DBH->prepare($sql);
    $stmnt->execute($params);
    return $single ? $stmnt->fetch(PDO::FETCH_ASSOC) : $stmnt->fetchAll(PDO::FETCH_ASSOC);
}

// Jalankan query INSERT / UPDATE / DELETE
function runQuery(string $sql, array $params = []) {
    try {
        $stmt = DBH->prepare($sql);
        return $stmt->execute($params);
    } catch (PDOException $e) {
        echo "Query gagal: " . $e->getMessage();
        return false;
    }
}

// ======================
// PEMUSTAKA
// ======================

// Register pemustaka
function registerPemustaka(array $data){
    $sql = "INSERT INTO pemustaka 
            (nama_pemustaka, email_pemustaka, nim_nip_pemustaka, password_pemustaka)
            VALUES (:nama, :email, :nim_nip, :password)";
    return runQuery($sql, [
        ':nama'     => $data['nama_pemustaka'],
        ':email'    => $data['email'],
        ':nim_nip'  => $data['nim_nip'],
        ':password' => $data['password'],
    ]);
}

// Login pemustaka
function loginPemustaka(string $identity, string $password) {
    $sql = "SELECT *
            FROM pemustaka
            WHERE email_pemustaka = :id OR nim_nip_pemustaka = :id
            LIMIT 1";
    $user = fetchData($sql, [':id' => $identity], true);
    if (!$user) return false;
    return password_verify($password, $user['password_pemustaka']) ? $user : false;
}

// Ambil profil pemustaka
function getProfilPemustaka(int $id_pemustaka) {
    $sql = "SELECT nama_pemustaka, email_pemustaka, nim_nip_pemustaka, profil_pemustaka
            FROM pemustaka
            WHERE id_pemustaka = :id";
    return fetchData($sql, ['id'=>$id_pemustaka], true);
}

// Update profil pemustaka (dengan optional file)
function updateProfilPemustaka(int $id_pemustaka, array $data, ?array $file = null) {
    $fotoProfil = $data['profil_lama'] ?? null;

    if ($file && !empty($file['name'])) {
        $uploadDir = '../assets/img/';

        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $fileName = time() . '_' . basename($file['name']); // nama file unik
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            $fotoProfil = $fileName;
        }
    }

    $sql = "UPDATE pemustaka
            SET nama_pemustaka = :nama,
                email_pemustaka = :email,
                nim_nip_pemustaka = :nimnip,
                profil_pemustaka = :profil
            WHERE id_pemustaka = :id";

    return runQuery($sql, [
        ':nama'   => $data['nama_pemustaka'],
        ':email'  => $data['email_pemustaka'],
        ':nimnip' => $data['nim_nip_pemustaka'],
        ':profil' => $fotoProfil, // hanya nama file
        ':id'     => $id_pemustaka
    ]);
}


// ======================
// PEMINJAMAN
// ======================

// Buat peminjaman
function createPeminjaman(array $data){
    $sql = "INSERT INTO peminjaman
            (id_pemustaka, id_buku, tanggal_peminjaman, tanggal_kembali, status)
            VALUES (:id_pemustaka, :id_buku, :t_pinjam, :t_kembali, :status)";
    return runQuery($sql, [
        ':id_pemustaka' => $data['id_pemustaka'],
        ':id_buku'      => $data['id_buku'],
        ':t_pinjam'     => $data['tanggal_pinjam'],
        ':t_kembali'    => $data['tanggal_kembali'],
        ':status'       => $data['status']
    ]);
}

// Ambil semua peminjaman (admin)
function getAllPeminjaman() {
    $sql = "SELECT 
                p.id_peminjaman,
                p.tanggal_peminjaman,
                p.tanggal_kembali,
                p.status,
                b.judul,
                pm.nama_pemustaka
            FROM peminjaman p
            JOIN buku b ON b.id_buku = p.id_buku
            JOIN pemustaka pm ON pm.id_pemustaka = p.id_pemustaka
            ORDER BY p.tanggal_peminjaman DESC";
    return fetchData($sql);
}

function updateStatusPeminjaman(int $id_peminjaman, string $status) {

    // Jika user mengembalikan buku
    if ($status === 'returned') {
        $sql = "UPDATE peminjaman 
                SET status = :status, tanggal_kembali = CURDATE()
                WHERE id_peminjaman = :id";

    // Jika admin meng-approve (jadikan borrowed)
    } elseif ($status === 'borrowed') {
        $sql = "UPDATE peminjaman 
                SET status = :status, tanggal_peminjaman = CURDATE()
                WHERE id_peminjaman = :id";

    // pending atau rejected
    } else {
        $sql = "UPDATE peminjaman 
                SET status = :status
                WHERE id_peminjaman = :id";
    }

    return runQuery($sql, [
        ':status' => $status,
        ':id'     => $id_peminjaman
    ]);
}



// ======================
// ADMINISTRATOR
// ======================

// Tambah buku (dengan file cover)
function addBukuAdministrator(array $data, array $file) {
    try {
        $judul        = trim($data['judul']);
        $penulis      = trim($data['penulis']);
        $penerbit     = trim($data['penerbit']);
        $tahun_terbit = $data['tahun_terbit'];
        $kategori     = trim($data['kategori']);
        $deskripsi    = trim($data['deskripsi']);

        $coverFileName = null;
        if (!empty($file['name'])) {
            $uploadDir = '../assets/img/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
            $fileTmpPath = $file['tmp_name'];
            $fileExt     = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $allowedExt  = ['jpg','jpeg','png','gif'];
            if (!in_array($fileExt, $allowedExt)) throw new Exception("Format file tidak diperbolehkan.");
            $newFileName = uniqid('cover_', true) . '.' . $fileExt;
            $destPath = $uploadDir . $newFileName;
            if (!move_uploaded_file($fileTmpPath, $destPath)) throw new Exception("Gagal upload cover.");
            $coverFileName = $newFileName; 

        }

        $sql = "INSERT INTO buku
                (judul, penulis, penerbit, tahun_terbit, cover, kategori, deskripsi)
                VALUES (:judul, :penulis, :penerbit, :tahun_terbit, :cover, :kategori, :deskripsi)";

        return runQuery($sql, [
            ':judul'        => $judul,
            ':penulis'      => $penulis,
            ':penerbit'     => $penerbit,
            ':tahun_terbit' => $tahun_terbit,
            ':cover'        => $coverFileName,
            ':kategori'     => $kategori,
            ':deskripsi'    => $deskripsi
        ]);
    } catch (Exception $e) {
        error_log('Error addBukuAdministrator: '.$e->getMessage());
        return $e->getMessage();
    }
}

// login admin
function loginAdmin(string $identity, string $password) {
    // login pakai username_admin
    $sql = "SELECT id_administrator, username_admin, password, profil_administrator
            FROM administrator
            WHERE username_admin = :identity
            LIMIT 1";

    $user = fetchData($sql, [':identity' => $identity], true);

    if (!$user) {
        return false;
    }

    // verifikasi password
    if (!password_verify($password, $user['password'])) {
        return false;
    }

    return $user; 
}
