<?php
require_once '../config/function.php';

// Ambil data dari database lewat fungsi GetPemustaka()
$pemustaka = GetPemustaka();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pemustaka</title>
</head>
<body>
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
                    <td><?= htmlspecialchars($p['id_pemustaka']); ?></td>
                    <td><?= htmlspecialchars($p['nama_pemustaka']); ?></td>
                    <td><?= htmlspecialchars($p['email_pemustaka']); ?></td>
                    <td><?= htmlspecialchars($p['nim_nip_pemustaka']); ?></td>
                    <td><?= htmlspecialchars($p['profil_pemustaka']??''); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">Belum ada data pemustaka di database.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
