<?php
session_start();
include './koneksi.php';

if (isset($_POST['update_poli'])) {
    $poli = $_POST['poli'];
    $nama_poli = $_POST['nama_poli'];
    $jumlah_maksimal = $_POST['jumlah_maksimal'];


    // update data poli
    $sql = "UPDATE poli SET nama_poli='$nama_poli', jumlah_maksimal='$jumlah_maksimal'";

    $sql .= " WHERE poli='$poli'";

    if (mysqli_query($conn, $sql)) {
        echo '<meta http-equiv="refresh" content="0; url=../pages/dashboard_admin/?page=data-poli">';
        echo '<script>alert("Data berhasil diupdate!");</script>';
    } else {
        echo '<meta http-equiv="refresh" content="0; url=../pages/dashboard_admin/?page=data-poli">';
        echo '<script>alert("Data gagal diupdate!");</script>';
    }
}
