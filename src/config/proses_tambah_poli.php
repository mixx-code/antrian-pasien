
<?php
include_once './koneksi.php';

// Mengecek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Menyimpan nilai inputan dari form ke dalam variabel
    $poli = $_POST['poli'];
    $nama_poli = $_POST['nama_poli'];
    $jumlah_maksimal = $_POST['jumlah_maksimal'];

    // Mengecek koneksi ke database
    if ($conn->connect_error) {
        die("Koneksi ke database gagal: " . $conn->connect_error);
    }

    // Menghash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Menjalankan query untuk memasukkan data ke dalam database
    $sql = "INSERT INTO poli (poli, nama_poli, jumlah_maksimal)
            VALUES ('$poli', '$nama_poli', '$jumlah_maksimal')";

    if ($conn->query($sql) === TRUE) {
        echo "<meta http-equiv='refresh' content='0; url=../pages/dashboard_admin/?page=data-poli'>";
        echo "<script>alert('Poli berhasil ditambahkan.')</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        echo "<meta http-equiv='refresh' content='0; url=../pages/dashboard_admin/?page=data-poli'>";
        echo "<script>alert('Poli Gagal ditambahkan.')</script>";
        exit;
    }
    // Menutup koneksi ke database
    $conn->close();
}
