<?php
// Koneksi ke database
include './koneksi.php';

// Ambil nik dari parameter URL
$id_pengunjung = $_GET['id_pengunjung'];

// Query SQL untuk menghapus data
$query = "DELETE FROM pengunjung WHERE id_pengunjung='$id_pengunjung'";
mysqli_query($conn, $query);

// Alihkan ke halaman utama
header('location: ../pages/dashboard_admin/?page=pengunjung');
