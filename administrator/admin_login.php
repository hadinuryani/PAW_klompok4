<?php
session_start();
require_once '../config/config.php';
require_once '../config/function.php';

$error = '';

if (isset($_POST['login'])) {

    $identity = trim($_POST['username_admin']); 
    $password = $_POST['password'];

    if ($identity === '' || $password === '') {
        $error = "Username dan password wajib diisi";
    } else {
        $user = loginAdmin($identity, $password);

        if ($user === false) {
            $error = "Username atau password salah";
        } else {
            // Set session
            $_SESSION['user_id']   = $user['id_administrator'];
            $_SESSION['user_name'] = $user['username_admin'];
            $_SESSION['role']      = 'administrator';
             $_SESSION['profil_administrator'] = $user['profil_administrator'];
            // Redirect ke dashboard admin
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
  <title>Login Administrator UnivLib</title>
</head>
<body>
  <div class="container">
    <h1>Login Administrator UnivLib</h1>

    <?php if (!empty($error)): ?>
      <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="post" action="">
      <label>Username:</label>
      <input type="text" name="username_admin" value="<?= isset($_POST['username_admin']) ? htmlspecialchars($_POST['username_admin']) : '' ?>" required />

      <label>Password:</label>
      <input type="password" name="password" required />

      <button type="submit" name="login">Login</button>
    </form>

  </div>
</body>
</html>
