<?php
session_start();
// profil.php
require_once '../config/config.php';
require_once '../config/function.php';

// Cek apakah user sudah login
if(!(isset($_SESSION['user_id']) && isset($_SESSION['user_name']))){
    header("Location:" . BASE_URL . 'login.php');
    exit;
}

$data['title'] = 'Profil Pemustaka';
$data['css']   = ['style.css','profil.css'];

$id_pemustaka = $_SESSION['user_id'];

// Query ambil profil
$sql = "SELECT nama_pemustaka, email_pemustaka, nim_nip_pemustaka, profil_pemustaka
        FROM pemustaka
        WHERE id_pemustaka = :id";

$result = fetchData($sql, ['id' => $id_pemustaka]);

$profil = $result ? $result[0] : null;

require_once '../components/header.php';
?>

<main class="main-layout">
    <?php require_once '../components/nav.php'; ?>

    <section class="content">
        <h2>Profil Pemustaka</h2>

        <?php if ($profil): ?>
           <div class="profile-card">
                <img src="<?= BASE_URL; ?>assets/img/<?= $profil['profil_pemustaka'] ? $profil['profil_pemustaka'] :'logo-light.png'; ?>" 
                    alt="Foto Profil" class="profile-photo">

                <div class="profile-info">
                    <h3><?= $profil['nama_pemustaka']; ?></h3>
                    <p><i class="fa fa-envelope"></i> <?= $profil['email_pemustaka']; ?></p>
                    <p><i class="fa fa-id-card"></i> <?= $profil['nim_nip_pemustaka']; ?></p>

                    <a href="edit_profil.php" class="btn-edit">Edit Profil</a>
                </div>
            </div>

        <?php else: ?>
            <p>Data profil tidak ditemukan.</p>
        <?php endif; ?>

    </section>
</main>

<?php require_once '../components/footer.php'; ?>
