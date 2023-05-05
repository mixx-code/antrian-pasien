<?php
session_start();

include_once "../../config/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // mengambil data dari form antrian
    $poli = $_POST["poli"];
    $no_antrian = $_POST["no_antrian"];
    $nik = $_POST["nik"];
    $tanggal = $_POST["tanggal"];

    // menyimpan data poli ke dalam session
    $_SESSION["poli"] = $poli;

    // menambahkan data ke tabel antrian
    $sql = "INSERT INTO antrian (poli, nik, no_antrian, tanggal_antrian, status) 
            VALUES ('$poli',  '$nik', '$no_antrian', '$tanggal', 'tunggu')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // jika berhasil menambahkan data, redirect ke halaman sukses
        echo "<script>alert('Antrian berhasil ditambahkan')</script>";
        echo "<meta http-equiv='refresh' content='0; url= ../../pages/tunggu_antrian'>";
        exit();
    } else {
        // jika gagal menambahkan data, tampilkan pesan error
        echo "<script>alert('Terjadi kesalahan saat menambahkan antrian')</script>";
        echo "<meta http-equiv='refresh' content='0; url= ../../pages/antrian'>";
    }
}
