<?php
session_start();
include '../../config/koneksi.php';
$nik = $_SESSION["nik"];
if (isset($_SESSION['poli'])) {
    $poli_yang_dipilih = $_SESSION['poli'];
} else {
    $sql1 = "SELECT poli FROM antrian WHERE nik = '$nik' ";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        $row = mysqli_fetch_assoc($result1);
        $poli_yang_dipilih = $row['poli']; // isi dengan nilai default jika session 'poli' belum ter-set
    } else {
        echo "data kosong";
    }
}
// set session variable

// tutup session
session_write_close();
$sql = "SELECT * FROM poli INNER JOIN antrian ON poli.poli = antrian.poli WHERE nik = '$nik' ";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $no_antrian = $row["no_antrian"];
    $tanggal_antrian = $row['tanggal_antrian'];
    $poli = $row["poli"];
    $nama_poli = $row["nama_poli"];
} else {
    echo "data kosong";
}
$query = "SELECT no_antrian FROM antrian WHERE status = 'proses' AND poli = '$poli_yang_dipilih'";
$res = mysqli_query($conn, $query);
if (mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_assoc($res);
    $no_antrian_sekarang = $row["no_antrian"];
} else {
    $no_antrian_sekarang = 'sedang di proses';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tunggu_antrian.css">
    <title>Tunggu antrian</title>
</head>

<body>
    <div class="container">
        <div class="card">
            <h1>Puskesmas Caringin</h1>
            <div class="antrian">
                <p>Antrian saat ini: <span><?= $no_antrian_sekarang ?></span></p>
                <hr>
                <p>No Antrian Anda: <span><?= $no_antrian ?>, <?= $poli ?></span></p>
                <p>Untuk tanggal: <span><?= $tanggal_antrian ?></span></p>
                <p><?= $nama_poli ?></p>
            </div>
            <a class="btn-cetak" href="../cetak_antrian/">cetak</a>
            <a class="btn-keluar" href="../dashboard_user/">kembali</a>
        </div>
    </div>
</body>

</html>