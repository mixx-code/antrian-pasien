<?php
include '../../config/koneksi.php';

function getAntrian($poli)
{
    global $conn;
    $query = "SELECT COUNT(antrian.no_antrian) AS total, antrian.poli, poli.nama_poli 
              FROM antrian JOIN poli ON antrian.poli = poli.poli 
              WHERE antrian.poli = '$poli'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $nama_poli = $row["nama_poli"];
        $no_antrian = $row["total"];
    } else {
        $nama_poli = "Poli " . ucfirst(strtolower($poli));
        $no_antrian = 0;
    }
    return array("nama_poli" => $nama_poli, "no_antrian" => $no_antrian);
}

$polis = array();
$query = "SELECT poli FROM poli";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($polis, $row['poli']);
    }
}
?>

<div class="home">
    <h1>Dashboard</h1>
    <div class="card-poli">
        <?php foreach ($polis as $poli) {
            $antrian = getAntrian($poli);
        ?>
            <div class="card-antrian">
                <h1><?= $antrian["no_antrian"] ?></h1>
                <p><?= $antrian["nama_poli"] ?></p>
            </div>
        <?php } ?>
    </div>
</div>