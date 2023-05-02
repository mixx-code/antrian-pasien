<?php
// Informasi database
$host = "localhost"; // atau alamat IP server MySQL
$username = "root"; // username database
$password = ""; // password database
$database = "antrian_puskesmas"; // nama database

// Membuat koneksi ke database
$conn = mysqli_connect($host, $username, $password, $database);

// Mengecek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
