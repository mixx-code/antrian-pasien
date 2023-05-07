<?php
include '../../config/koneksi.php';

// jumlah data per halaman
$jumlahDataPerHalaman = 15;

// menghitung jumlah data
$sql = "SELECT COUNT(*) AS jumlah FROM user";
$jumlahData = mysqli_fetch_assoc(mysqli_query($conn, $sql));

// menghitung jumlah halaman
$jumlahHalaman = ceil($jumlahData['jumlah'] / $jumlahDataPerHalaman);

// mengambil halaman yang diminta
if (isset($_GET['halaman']) && $_GET['halaman'] > 0 && $_GET['halaman'] <= $jumlahHalaman) {
    $halamanAktif = $_GET['halaman'];
} else {
    $halamanAktif = 1;
}
$awalData = ($halamanAktif - 1) * $jumlahDataPerHalaman;

// mengambil data dengan batasan limit
$sql = "SELECT * FROM user LIMIT $awalData, $jumlahDataPerHalaman";
$result = mysqli_query($conn, $sql);

// load file autoload.php
require_once __DIR__ . '../../../../vendor/autoload.php';

use Dompdf\Dompdf;
// buat objek Dompdf
$dompdf = new Dompdf();

// buat html yang akan dicetak
// buat html yang akan dicetak
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cetak_antrian.css">
    <style>
    th, td{font-size:10px;}
    </style>
    <title>Cetak antrian</title>
</head>

<body style="margin: 0px; padding: 0px">
    <div class="tabel-pasien" style="width: 100%;">
    <h2>Admin - Data Pasien</h2>
    <table class="table-data-pasien" style="border-collapse: collapse;width: 100%;border: 1px solid #999;padding: 0px 10px;">
        <thead style="background-color: rgba(207, 203, 203, 0.72);">
            <tr>
                <th>NIK</th>
                <th>NAMA</th>
                <th>JENIS KELAMIN</th>
                <th>TANGGAL LAHIR</th>
                <th>ALAMAT</th>
                <th>NO TELP</th>
                <th>USERNAME</th>
            </tr>
        </thead>
';

// memulai blok kode PHP
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $html .= '<tr class="body-tabel" style="background-color: rgba(249, 249, 249, 0.72);">';
        $html .= '<td>' . $row["nik"] . '</td>';
        $html .= '<td>' . $row["nama"] . '</td>';
        $html .= '<td>' . $row["jenis_kelamin"] . '</td>';
        $html .= '<td>' . $row["tanggal_lahir"] . '</td>';
        $html .= '<td>' . $row["alamat"] . '</td>';
        $html .= '<td>' . $row["no_telp"] . '</td>';
        $html .= '<td>' . $row["username"] . '</td>';
        $html .= '</tr>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="8" style="text-align: center;">Data kosong</td>';
    $html .= '</tr>';
}

// menutup blok kode PHP dan menambahkan tag HTML yang belum ditutup
$html .= '
    </table>
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
$dompdf->stream("tabel-pasien.pdf", array("Attachment" => false));

// selesai
exit();
