<?php
include './koneksi.php';
// Ambil data yang diposting dari formulir
$nama = $_POST["nama"];
$no_antrian = $_POST["no_antrian"];
$poli = $_POST["poli"];

// Buat query SQL
$sql = "INSERT INTO antrian (no_antrian, nama, poli) VALUES ('$no_antrian', '$nama', '$poli')";

// Jalankan query dan cek apakah data berhasil dimasukkan
if (mysqli_query($conn, $sql)) {
    echo "Data berhasil dimasukkan";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
