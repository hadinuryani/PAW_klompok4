<?php
session_start();
require_once '../config/config.php';
require_once '../config/function.php';
// cek apkah sesion sudah di set 
if(!(isset($_SESSION['user_id']) && isset($_SESSION['user_name']))){
    header("Location:" .BASE_URL . 'login.php');
}
$data['title'] = 'daftar pemustaka';
$data['css'] = ['style.css','tabel.css'];
$query = "SELECT id_pemustaka, 
                nama_pemustaka, 
                email_pemustaka, 
                nim_nip_pemustaka, 
                profil_pemustaka
                FROM pemustaka";
$pemustaka = fetchData($query);
require_once '../components/header.php'
?>

<main class="main-layout">
    <?php require_once '../components/nav.php'; ?>
    <section class="content">
        <h1>Daftar Pemustaka</h1>
        <table border="1">
            <tr>
                <th>ID Pemustaka</th>
                <th>Nama Pemustaka</th>
                <th>Email</th>
                <th>NIM/NIP</th>
                <th>Profil</th>
            </tr>
            <?php if (!empty($pemustaka)): ?>
                <?php foreach ($pemustaka as $p): ?>
                    <tr>
                        <td><?= $p['id_pemustaka']; ?></td>
                        <td><?= $p['nama_pemustaka']; ?></td>
                        <td><?= $p['email_pemustaka']; ?></td>
                        <td><?= $p['nim_nip_pemustaka']; ?></td>
                        <td><img src="<?= BASE_URL; ?>assets/img/<?= $p['profil_pemustaka']??''; ?>" alt=""></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Belum ada data pemustaka di database.</td>
                </tr>
            <?php endif; ?>
        </table>
    </section>
</main>
    
<?php require_once '../components/footer.php' ?>