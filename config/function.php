<?php
require_once 'config.php';
require_once 'database.php';

function getData(string $query, array $params = []) {
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


// tambah buku admin
function addBukuAdministrator(array $data){
    $sql = "INSERT INTO buku 
            (judul_buku, penulis_buku, penerbit_buku, tahun_terbit, cover, kategori) 
            VALUES (:judul, :penulis, :penerbit, :tahun_terbit, :cover, :kategori)";

    $stmnt = DBH->prepare($sql);

    return $stmnt->execute([
        ':judul'        => $data['judul'],
        ':penulis'      => $data['penulis'],
        ':penerbit'     => $data['penerbit'],
        ':tahun_terbit' => $data['tahun_terbit'],
        ':cover'        => $data['cover'],
        ':kategori'     => $data['kategori'],
    ]);
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

function GetPemustaka() {
    try {
        // Query ambil semua data pemustaka
        $sql = "SELECT 
                    id_pemustaka, 
                    nama_pemustaka, 
                    email_pemustaka, 
                    nim_nip_pemustaka, 
                    profil_pemustaka
                FROM pemustaka";

        $stmnt = DBH->prepare($sql);
        $stmnt->execute();

        // Ambil semua hasil sebagai array asosiatif
        $data = $stmnt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    } catch (PDOException $e) {
        echo "Gagal mengambil data pemustaka: " . $e->getMessage();
        return [];
    }
}

