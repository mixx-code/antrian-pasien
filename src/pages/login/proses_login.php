<?php
session_start();

include_once "../../config/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // mengambil data dari form login
    $username = $_POST["username"];
    $password = $_POST["password"];

    // mencari data pengguna pada tabel user
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // memverifikasi password
        if (password_verify($password, $row["password"])) {
            // menyimpan informasi login ke session
            $_SESSION['nik'] = $row['nik'];
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            // redirect ke halaman utama setelah login
            echo "<script>alert('Selamat datang " . $username . " 🫡')</script>";
            header('Location: ../antrian/antrian.php');
            echo "<meta http-equiv='refresh' content='0; url= ../antrian/antrian.php";
            exit();
        } else {
            // jika password tidak cocok
            echo "<script>alert('password salah !!!')</script>";
            echo "<meta http-equiv='refresh' content='0; url= ../../pages/login/index.php'>";
            var_dump(password_verify($password, $row["password"]));
        }
    } else {
        // jika username tidak ditemukan
        echo "<script>alert('username salah !!!')</script>";
        echo "<meta http-equiv='refresh' content='0; url= ../../pages/login/index.php'>";
    }
}
