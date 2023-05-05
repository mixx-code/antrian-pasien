<?php
session_start();
include '../../config/koneksi.php';
$nik = $_SESSION["nik"];
$poli_yang_dipilih = $_SESSION['poli'];

$sql = "SELECT * FROM poli INNER JOIN antrian ON poli.poli = antrian.poli WHERE nik = '$nik' ";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $no_antrian = $row["no_antrian"];
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
    echo "data kosong";
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
    <h1><?= $nik ?></h1>
    <h1><?= $poli_yang_dipilih ?></h1>
    <div class="container">

        <div class="card">
            <h1>Puskesmas Caringin</h1>
            <div class="antrian">
                <p>Antrian saat ini: <span><?= $no_antrian_sekarang ?></span></p>
                <hr>
                <p>No Antrian Anda: <span><?= $no_antrian ?>, <?= $poli ?></span></p>
                <p><?= $nama_poli ?></p>
            </div>
            <a href="../login/">Selesai</a>
        </div>
    </div>
</body>

</html>