<?php
session_start();
require_once '../config/function.php';
require_once '../config/config.php'; 
// cek apkah sesion sudah di set 
if(!(isset($_SESSION['user_id']) && isset($_SESSION['user_name']))){
    header("Location:" .BASE_URL . 'login.php');
}
$data['title'] = 'kelola buku';
$data['css'] = ['style.css','tabel.css'];

$query =  "SELECT id_buku,judul,penulis,penerbit,kategori FROM buku";
$buku = fetchData($query);

require_once '../components/header.php';
 ?>
<main class="main-layout">
    <?php require_once '../components/nav.php'; ?>
    <section class="content">
        <h1>kelola koleksi buku</h1>
        <table>
            <tr>
                <th>No</th>
                <th>judul Buku</th>
                <th>penulis</th>
                <th>penerbit</th>
                <th>kategori</th>
                <th>aksi</th>
            </tr>
            <?php $no=1; foreach($buku as $b) :?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $b['judul']; ?></td>
                    <td><?= $b['penulis']; ?></td>
                    <td><?= $b['penerbit']; ?></td>
                    <td><?= $b['kategori']; ?></td>
                    <td>
                        <a href="update_buku.php?id_buku=<?= $b['id_buku']; ?>">Update</a> |
                        <a href="konfirmasi.php?id_buku=<?= $b['id_buku']; ?>" >Delete</a>
                    </td>

                </tr>
                <?php $no++; ?>
            <?php endforeach ?>
        </table>    
    </section>
</main>

    
<?php require_once '../components/footer.php' ?>