<?php 
session_start();
require_once '../config/config.php';
require_once '../config/function.php';
// cek apkah sesion sudah di set 
if(!(isset($_SESSION['user_id']) && isset($_SESSION['user_name']))){
    header("Location:" .BASE_URL . 'administrator/admin_login.php');
}

// set nama title dan css 
$data['title'] = 'Dashboard';
$data['css'] = ['style.css'];

require_once '../components/header.php';
?>

<main class="main-layout">
    <?php require_once '../components/nav.php'; ?>
    <section class="content">
        <h1>selamat datang admin</h1>
        <a href="<?= BASE_URL; ?>administrator/insert_buku.php">Tabmbah Buku</a>
    </section>
</main>

<?php require_once '../components/footer.php'; ?>
