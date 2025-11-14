<?php
session_start();
require_once 'config/config.php';
require_once 'config/function.php';

if (isset($_POST['login'])) {

    $identity = trim($_POST['identity']);
    $password = $_POST['password'];

    if ($identity === '' || $password === '') {
        $error = "Email/NIM dan password wajib diisi";
    } else {
        $user = loginPemustaka($identity, $password);

        if ($user === false) {
            $error = "Identitas atau password salah";
        } else {
            // Set session
            $_SESSION['user_id']  = $user['id_pemustaka'];
            $_SESSION['user_name'] = $user['nama_pemustaka'];
            $_SESSION['role'] = 'pemustaka';
            $_SESSION['profil_pemustaka'] = $user['profil_pemustaka'];
            // Redirect ke dashboard
            header("Location: index.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= BASE_URL; ?>assets/css/auth.css">
  <title>Login</title>
</head>
<body>
<body>
  <div class="container">
    <h1>Login UnivLib</h1>

    <?php if (!empty($error)): ?>
      <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post" action="#">
      <label>Email :</label>
      <input type="text" name="identity" />

      <label>Password:</label>
      <input type="password" name="password" />

      <button type="submit" name="login">Login</button>
    </form>

    <p>Belum punya akun? <a href="register.php">Daftar akun baru</a></p>
  </div>
</body>

</body>
</html>
