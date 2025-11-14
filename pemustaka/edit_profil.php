<?php
session_start();
require_once '../config/config.php';
require_once '../config/function.php';
if(!(isset($_SESSION['user_id']) && isset($_SESSION['user_name']))){
    header("Location:" .BASE_URL . 'login.php');
}
$data['title'] = 'Edit Profil';
$data['css']   = ['style.css','profil.css'];

$id_pemustaka = $_SESSION['user_id'];

$profil = getProfilPemustaka($id_pemustaka);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dataPost = [
        'nama_pemustaka' => trim($_POST['nama_pemustaka']),
        'email_pemustaka' => trim($_POST['email_pemustaka']),
        'nim_nip_pemustaka' => trim($_POST['nim_nip_pemustaka']),
        'profil_lama' => $profil['profil_pemustaka']
    ];

    $isUpdated = updateProfilPemustaka($id_pemustaka, $dataPost, $_FILES['profil_pemustaka'] ?? null);

    if ($isUpdated) {
        header("Location: profil.php?success=1");
        exit;
    } else {
        echo "<p style='color:red;'>Gagal memperbarui profil.</p>";
    }
}

require_once '../components/header.php';
?>

<main class="main-layout">
    <?php require_once '../components/nav.php'; ?>

    <section class="content">
        <h2>Edit Profil</h2>

        <?php if ($profil): ?>
        <form method="POST" enctype="multipart/form-data" class="form-edit">
            <div>
                <label>Nama</label>
                <input type="text" name="nama_pemustaka" value="<?= htmlspecialchars($profil['nama_pemustaka']); ?>" required>
            </div>
            <div>
                <label>Email</label>
                <input type="email" name="email_pemustaka" value="<?= htmlspecialchars($profil['email_pemustaka']); ?>" required>
            </div>
            <div>
                <label>NIM/NIP</label>
                <input type="text" name="nim_nip_pemustaka" value="<?= htmlspecialchars($profil['nim_nip_pemustaka']); ?>" required>
            </div>
            <div>
                <label>Foto Profil</label><br>
                <img src="<?= BASE_URL; ?>assets/img/<?= $profil['profil_pemustaka'] ? $profil['profil_pemustaka'] :'logo-light.png'; ?>" 
                     alt="Foto Profil" width="100" style="border-radius:50%;margin-bottom:10px;">
                <input type="file" name="profil_pemustaka" accept="image/*">
            </div>
            <button type="submit" class="btn">Simpan Perubahan</button>
        </form>
        <?php else: ?>
            <p>Data profil tidak ditemukan.</p>
        <?php endif; ?>
    </section>
</main>

<?php require_once '../components/footer.php'; ?>
