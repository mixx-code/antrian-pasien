<?php
include '../../config/koneksi.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$nik = $_SESSION['nik'];
$sql = "SELECT nik FROM antrian WHERE nik='$nik'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $antrian = true;
} else {
    $antrian = false;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard_user.css">
    <title>Dashboard</title>
</head>

<body>
    <div class="container">
        <h1 class="title-login">Selamat Datang di Puskesmas Caringin</h1>

        <div class="btn">
            <?php if ($antrian == false) : ?>
                <a href="../antrian/antrian.php">Ambil Antrian</a>
            <?php else : ?>
                <a href="../tunggu_antrian/">Liat Antrian</a>
            <?php endif ?>
            <a href="../../config/logout.php">Logout</a>
        </div>
    </div>
</body>

</html>