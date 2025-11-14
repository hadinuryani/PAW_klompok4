<?php 
$alert['confirm'] = true;
$alert['pesan'] = 'Yakin mau di hapus';
$alert['href'] = 'delete_buku.php';
$alert['data'] = $_GET['id_buku'];
require_once '../components/alert.php';

?>