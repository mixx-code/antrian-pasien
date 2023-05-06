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
    $tanggal_antrian = $row['tanggal_antrian'];
    $poli = $row["poli"];
    $nama_poli = $row["nama_poli"];
} else {
    echo "data kosong";
}

// load file autoload.php
require_once __DIR__ . '../../../../vendor/autoload.php';

use Dompdf\Dompdf;
// buat objek Dompdf
$dompdf = new Dompdf();

// buat html yang akan dicetak
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cetak_antrian.css">
    <title>Cetak antrian</title>
</head>

<body style="margin: 0px; padding: 0px">
    <div class="container" style="width:100% ;">
        <div class="card" style="background-color: rgba(246, 255, 138, 1); padding: 20px 50px 70px 50px; display: flex; flex-direction: column; align-items: center; border-radius: 10px;width:284px ; margin: 200px auto ">
            <h1 style="font-size: 25px; margin-bottom: 30px; text-align: center;">Puskesmas Caringin</h1>
            <p style="font-size: 20px; margin-bottom: 20px; text-align: center;">No Antrian Anda: <span style="font-weight: bold; font-size: 23px;">' . $no_antrian . ', ' . $poli . '</span></p>
            <p style="font-size: 20px; margin-bottom: 20px; text-align: center;">Untuk Tanggal : <span style="font-weight: bold; font-size: 23px;">' . $tanggal_antrian . '</span></p>
            <p style="font-size: 20px; margin-bottom: 20px; text-align: center;">' . $nama_poli . '</p>
        </div>
    </div>
</body>

</html>';

// masukkan html ke dalam objek Dompdf
$dompdf->loadHtml($html);

// atur ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'portrait');

// render html menjadi PDF
$dompdf->render();

// beri nama file dan kirim file PDF ke browser
$dompdf->stream("kartu-antrian.pdf", array("Attachment" => false));

// selesai
exit();
