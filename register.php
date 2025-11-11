<?php
require_once 'config/database.php';
require_once 'config/function.php';

if (isset($_POST['register'])) {

  $nama       = trim($_POST['nama']);
  $nim_nip    = trim($_POST['nim_nip']);
  $email      = trim($_POST['email']);
  $password   = $_POST['password'];
  $password_confirm = $_POST['password_confirm'];

  // validasi password
  if ($password !== $password_confirm) {
    $data['alert'] = 'Konfirmasi password tidak sesuai';
    require 'components/alert.php';
    die;
  }

  // cek apakah email atau nim/nip sudah ada
  $cek = getData(
    "SELECT id_pemustaka FROM pemustaka 
     WHERE email_pemustaka = :email OR nim_nip_pemustaka = :nim",
    [
      ':email' => $email,
      ':nim'   => $nim_nip
    ]
  );

  if (!empty($cek)) {
    $data['alert'] = 'Email atau NIM/NIP sudah terdaftar';
    require 'components/alert.php';
    die;
  }

  // hash password
  $password_hash = password_hash($password, PASSWORD_DEFAULT);

  // insert data
  $insert = registerPemustaka([
    'nama_pemustaka' => $nama,
    'email'          => $email,
    'nim_nip'        => $nim_nip,
    'password'       => $password_hash
  ]);

  if ($insert) {
    $data['alert'] = 'Registrasi berhasil, silakan login.';
    require 'components/alert.php';
  } else {
    $data['alert'] = 'Terjadi kesalahan saat registrasi.';
    require 'components/alert.php';
  }
}

require_once 'components/header.php';
?>

<h1>Register Akun Pemustaka</h1>

<form method="post" action="register.php">
  <label>
    Nama Lengkap:
    <input type="text" name="nama"/>
  </label><br/>

  <label>
    NIM / NIP:
    <input type="text" name="nim_nip"/>
  </label><br/>

  <label>
    Email:
    <input type="text" name="email"/>
  </label><br/>

  <label>
    Password:
    <input type="password" name="password"/>
  </label><br/>

  <label>
    Konfirmasi Password:
    <input type="password" name="password_confirm"/>
  </label><br/>

  <button type="submit" name="register">Daftar</button>
</form>

<p>Sudah punya akun? <a href="login.php">Login</a></p>

<?php require_once 'components/footer.php'; ?>
