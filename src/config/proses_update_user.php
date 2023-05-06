<?php
session_start();
include './koneksi.php';

if (isset($_POST['update_pasien'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // update data pasien
    $sql = "UPDATE user SET nama='$nama', jenis_kelamin='$jenis_kelamin', tanggal_lahir='$tanggal_lahir', alamat='$alamat', no_telp='$no_telp', username='$username', role='$role'";

    // update password jika tidak kosong
    if (!empty($password)) {
        $sql .= ", password='$password'";
    }

    $sql .= " WHERE nik='$nik'";

    if (mysqli_query($conn, $sql)) {
        echo '<meta http-equiv="refresh" content="0; url=../pages/dashboard_admin/?page=data-pasien">';
        echo '<script>alert("Data berhasil diupdate!");</script>';
    } else {
        echo '<meta http-equiv="refresh" content="0; url=../pages/dashboard_admin/?page=data-pasien">';
        echo '<script>alert("Data gagal diupdate!");</script>';
    }
}
