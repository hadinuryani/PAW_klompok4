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
    $error = 'Konfirmasi password tidak sesuai';
  } else {
    // cek apakah email atau nim/nip sudah ada
    $cek = fetchData(
      "SELECT id_pemustaka FROM pemustaka 
       WHERE email_pemustaka = :email OR nim_nip_pemustaka = :nim",
      [
        ':email' => $email,
        ':nim'   => $nim_nip
      ]
    );

    if (!empty($cek)) {
      $error = 'Email atau NIM/NIP sudah terdaftar';
    } else {
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
        $success = 'Registrasi berhasil! Silakan login.';
      } else {
        $error = 'Terjadi kesalahan saat registrasi.';
      }
    }
  }
}
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Register - UnivLib</title>
  <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body>

  <div class="container">
    <h1>Daftar Akun UnivLib</h1>

    <?php if (!empty($error)): ?>
      <p style="color:red;"><?php echo $error; ?></p>
    <?php elseif (!empty($success)): ?>
      <p style="color:green;"><?php echo $success; ?></p>
    <?php endif; ?>

    <form method="post" action="register.php">
      <label>Nama Lengkap:</label>
      <input type="text" name="nama" required>

      <label>NIM / NIP:</label>
      <input type="text" name="nim_nip" required>

      <label>Email:</label>
      <input type="email" name="email" required>

      <label>Password:</label>
      <input type="password" name="password" required>

      <label>Konfirmasi Password:</label>
      <input type="password" name="password_confirm" required>

      <button type="submit" name="register">Daftar</button>
    </form>

    <p>Sudah punya akun? <a href="login.php">Login</a></p>
  </div>

</body>
</html>
