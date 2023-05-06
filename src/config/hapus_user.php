<?php
// Koneksi ke database
include './koneksi.php';

// Ambil nik dari parameter URL
$nik = $_GET['nik'];

// Query SQL untuk menghapus data
$query = "DELETE FROM user WHERE nik='$nik'";
mysqli_query($conn, $query);

// Alihkan ke halaman utama
header('location: /src/pages/dashboard_admin/?page=data-pasien');
