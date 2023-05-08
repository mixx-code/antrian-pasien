<?php
include './koneksi.php';

// Mengecek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Menyimpan nilai inputan dari form ke dalam variabel
    $nik = $_POST["nik"];
    $nama = $_POST["nama"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $tanggal_lahir = $_POST["tanggal_lahir"];
    $alamat = $_POST["alamat"];
    $no_telp = $_POST["no_telp"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    // Mengecek koneksi ke database
    if ($conn->connect_error) {
        die("Koneksi ke database gagal: " . $conn->connect_error);
    }

    // Menghash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Menjalankan query untuk memasukkan data ke dalam database
    $sql = "INSERT INTO user (nik, nama, jenis_kelamin, tanggal_lahir, alamat, no_telp, username, password, role)
            VALUES ('$nik', '$nama', '$jenis_kelamin', '$tanggal_lahir', '$alamat', '$no_telp', '$username', '$hashed_password', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "Registrasi berhasil";
        echo "<script>alert('registrasi berhasil')</script>";
        header('Location: ../pages/dashboard_admin/?page=data-pasien');
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        echo "<script>alert('registrasi gagal ! ! !')</script>";
        header('Location: ../pages/dashboard_admin/?page=data-pasien');
        exit;
    }
    // Menutup koneksi ke database
    $conn->close();
}
