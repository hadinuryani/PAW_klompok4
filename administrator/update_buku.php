<?php
require_once '../config/config.php';
require_once '../config/function.php';
session_start();
// cek apkah sesion sudah di set 
if(!(isset($_SESSION['user_id']) && isset($_SESSION['user_name']))){
    header("Location:" .BASE_URL . 'login.php');
}
$data['css'] = 'style.css';
if (!isset($_GET['id_buku'])) {
    header('Location: kelola_buku.php');
    exit;
}

$id = $_GET['id_buku'];
$buku = fetchData("SELECT * FROM buku WHERE id_buku = :id", ['id' => $id])[0];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul     = $_POST['judul'];
    $penulis   = $_POST['penulis'];
    $penerbit  = $_POST['penerbit'];
    $tahun     = $_POST['tahun_terbit'];
    $kategori  = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];

    $coverPath = $buku['cover']; // default: tetap cover lama

    // jika admin upload cover baru
    if (!empty($_FILES['cover']['name'])) {
        $targetDir = "../uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

        $fileName = time() . "_" . basename($_FILES['cover']['name']);
        $targetFile = $targetDir . $fileName;

        move_uploaded_file($_FILES['cover']['tmp_name'], $targetFile);

        // hapus cover lama
        if (file_exists('../' . $coverPath)) unlink('../' . $coverPath);

        $coverPath = "uploads/" . $fileName;
    }

    // update database
    $sql = "UPDATE buku 
            SET judul = :judul, penulis = :penulis, penerbit = :penerbit, 
                tahun_terbit = :tahun, kategori = :kategori, deskripsi = :deskripsi, cover = :cover
            WHERE id_buku = :id";

    $stmnt = DBH->prepare($sql);
    $stmnt->execute([
        ':judul' => $judul,
        ':penulis' => $penulis,
        ':penerbit' => $penerbit,
        ':tahun' => $tahun,
        ':kategori' => $kategori,
        ':deskripsi' => $deskripsi,
        ':cover' => $coverPath,
        ':id' => $id
    ]);

    header('Location: kelola_buku.php?msg=updated');
    exit;
}
?>

<?php require_once '../components/header.php'; ?>
<main class="main-layout">
    <?php require_once '../components/nav.php'; ?>
    <section class="content">
        <h2>Edit Buku</h2>

        <form method="POST" enctype="multipart/form-data" class="form-edit">
            <label>Judul Buku</label>
            <input type="text" name="judul" value="<?= htmlspecialchars($buku['judul']); ?>" required>

            <label>Penulis</label>
            <input type="text" name="penulis" value="<?= htmlspecialchars($buku['penulis']); ?>" required>

            <label>Penerbit</label>
            <input type="text" name="penerbit" value="<?= htmlspecialchars($buku['penerbit']); ?>" required>

            <label>Tahun Terbit</label>
            <input type="number" name="tahun_terbit" value="<?= htmlspecialchars($buku['tahun_terbit']); ?>" required>

            <label>Kategori</label>
            <input type="text" name="kategori" value="<?= htmlspecialchars($buku['kategori']); ?>" required>

            <label>Deskripsi</label>
            <textarea name="deskripsi" rows="4"><?= htmlspecialchars($buku['deskripsi']); ?></textarea>

            <label>Cover Buku (opsional)</label>
            <input type="file" name="cover">
            <img src="../<?= htmlspecialchars($buku['cover']); ?>" width="100">

            <button type="submit">Simpan Perubahan</button>
        </form>
    </section>
</main>
<?php require_once '../components/footer.php'; ?>
