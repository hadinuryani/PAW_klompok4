<?php
session_start();
require_once 'config/database.php';
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
            $_SESSION['user_id']   = $user['id_pemustaka'];
            $_SESSION['user_name'] = $user['nama_pemustaka'];
            $_SESSION['logged_in'] = true;

            // Redirect ke dashboard
            header("Location: index.php");
            exit;
        }
    }
}
?>
<!doctype html>
<html lang="id">
<head><meta charset="utf-8"><title>Login - UnivLib</title></head>
<body>

  <h1>Login terus</h1>

  <?php if (!empty($error)): ?>
    <p style="color:red;"><?php echo $error; ?></p>
  <?php endif; ?>

  <form method="post" action="login.php">
    <label>
      Email / NIM / NIP:
      <input type="text" name="identity" />
    </label><br/>

    <label>
      Password:
      <input type="password" name="password" />
    </label><br/>

    <button type="submit" name="login">Login</button>
  </form>

  <p><a href="register.php">Daftar akun baru</a></p>

</body>
</html>
