<?php
// Koneksi ke database
include './koneksi.php';

// Ambil nik dari parameter URL
$poli = $_GET['poli'];

// Query SQL untuk menghapus data
$query = "DELETE FROM poli WHERE poli='$poli'";
mysqli_query($conn, $query);

// Alihkan ke halaman utama
header('location: ../pages/dashboard_admin/?page=data-poli');
