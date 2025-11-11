<?php
// admin_loans.php
session_start();
// TODO: tampilkan semua request peminjaman, form untuk approve/deny/mark returned
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ambil loan_id dan status baru -> update DB
}
?>
<!doctype html>
<html lang="id">
<head><meta charset="utf-8"><title>Perbarui Status Peminjaman - UnivLib</title></head>
<body>
  <h1>Perbarui Status Peminjaman</h1>
  <table border="1">
    <thead><tr><th>ID Peminjaman</th><th>Pemustaka</th><th>Buku</th><th>Status</th><th>Aksi</th></tr></thead>
    <tbody>
      <tr>
        <td>101</td><td>Nama A</td><td>Judul A</td><td>Requested</td>
        <td>
          <form method="post" style="display:inline;">
            <input type="hidden" name="loan_id" value="101" />
            <button name="action" value="approve" type="submit">Approve</button>
            <button name="action" value="deny" type="submit">Deny</button>
            <button name="action" value="returned" type="submit">Mark Returned</button>
          </form>
        </td>
      </tr>
    </tbody>
  </table>

  <p><a href="admin_dashboard.php">Kembali</a></p>
</body>
</html>
