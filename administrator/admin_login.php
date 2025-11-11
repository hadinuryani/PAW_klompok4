<?php
// admin_login.php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // cek kredensial admin -> set $_SESSION['admin_id']
    // redirect ke admin_dashboard.php
}
?>
<!doctype html>
<html lang="id">
<head><meta charset="utf-8"><title>Admin Login - UnivLib</title></head>
<body>
  <h1>Login Administrator</h1>
  <form method="post" action="admin_login.php">
    <label>Username: <input type="text" name="username" /></label><br/>
    <label>Password: <input type="password" name="password" /></label><br/>
    <button type="submit">Login Admin</button>
  </form>
  <p><a href="index.php">Kembali</a></p>
</body>
</html>
