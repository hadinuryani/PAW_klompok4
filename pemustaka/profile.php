<?php
$data['title'] = 'Profil';
$data['css'] = 'style.css';

require_once 'config/function.php';
require_once 'config/config.php';

$user = getData("SELECT * FROM users WHERE id = 1", true);

require_once 'components/header.php';
?>

<main class="main-layout">

    <?php require_once 'components/nav.php'; ?>

    <section class="content">
        <h2>Your Profile</h2>

        <div class="profile-box">
            <img src="<?= $user['foto']; ?>" class="profile-photo">

            <form method="POST" action="process/update_profile.php" enctype="multipart/form-data">

                <label>Nama Lengkap</label>
                <input type="text" name="nama" value="<?= $user['nama']; ?>">

                <label>Email</label>
                <input type="email" name="email" value="<?= $user['email']; ?>">

                <label>Foto Profil</label>
                <input type="file" name="foto">

                <button type="submit" class="save-btn">Simpan Perubahan</button>

            </form>

        </div>

    </section>

</main>

<?php require_once 'components/footer.php'; ?>
