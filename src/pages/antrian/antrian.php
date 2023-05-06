<?php
session_start();

include '../../config/koneksi.php';

if (isset($_SESSION['poli'])) {
    $selectedValue = $_SESSION['poli'];
    $_SESSION['poli'] = $selectedValue;
    // set session variable
    $_SESSION['poli'] = $selectedValue;

    // tutup session
    session_write_close();
    // melakukan operasi lain jika key 'poli' sudah ada di dalam $_SESSION
    $maksimal_antrian = "SELECT jumlah_maksimal FROM poli";
    $query = mysqli_query($conn, $maksimal_antrian);
    $data = mysqli_fetch_assoc($query);
    $jumlah_maksimal = $data['jumlah_maksimal'];
    $sql = "SELECT COUNT(*) AS total, no_antrian FROM antrian WHERE poli = '$selectedValue'";
    $result = mysqli_query($conn, $sql);
    // Mengambil jumlah data
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $total_data = $row["total"];
        $no_antrian_sekarang = $row["no_antrian"];
        // jika no_antrian lebih dari 15 maka akan di mulai dari 1 lagi
        if ($no_antrian_sekarang >= $jumlah_maksimal) {
            $no_antrian = 1;
        } else {
            $no_antrian = $no_antrian_sekarang + 1;
        }
    } else {
        $total_data = 0;
        $no_antrian = $total_data + 1;
    }
} else {
    $selectedValue = "PLGG";
    $no_antrian = 1;
}

$tanggal_sekarang = date('Y-m-d');
// jika no_antrian lebih dari 15, tanggal akan diisi tanggal besok
if ($no_antrian > 15) {
    $new_date = date('Y-m-d', strtotime('+1 day'));
} else {
    $new_date = $tanggal_sekarang;
}

$nik = $_SESSION['nik'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="antrian.css">
    <title>Document</title>
</head>

<body>
    <!-- <h1><?= $tanggal_sekarang ?></h1>
    <h1><?= $tanggal_besok ?></h1> -->

    <div class="container">
        <form class="form-antrian" action="proses_antrian.php" method="POST">
            <div>
                <label for="">Pilih poli</label>
                <select name="poli" id="poli">
                    <option disabled>Pilih POLI UNTUK MENDAPAT ANTRIAN</option>
                    <option value="PLGG" <?php if ($selectedValue == "PLGG") echo "selected"; ?>>PLGG : Poli Gigi</option>
                    <option value="PLUM" <?php if ($selectedValue == "PLUM") echo "selected"; ?>>PLUM</option>
                    <option value="PLIM" <?php if ($selectedValue == "PLIM") echo "selected"; ?>>PLIM</option>
                    <option value="PLAN" <?php if ($selectedValue == "PLAN") echo "selected"; ?>>PLAN</option>
                </select>
                <p style="font-size:14px; color: red; text-align:center;">tolong pilih poli hingga No antrian anda tampil !!!</p>
            </div>
            <div>
                <label for="">No Antrian</label>
                <input type="text" name="no_antrian" id="no_antrian" value="<?= isset($no_antrian) ? $no_antrian : '' ?>" readonly>
            </div>
            <div>
                <input type="text" name="nik" id="nama" value="<?= $nik ?>" hidden>
            </div>
            <div>
                <input type="text" name="tanggal" id="tanggal" value="<?= $new_date  ?>" hidden>
            </div>
            <div class="btn_antrian">
                <button type="submit">Ambil Antrian</button>
                <a class="kembali" href="../login/">X</a>
            </div>
        </form>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script>
        // Ambil element select
        const selectPoli = document.querySelector("#poli");




        // Tambah event listener untuk saat value berubah
        selectPoli.addEventListener("change", function() {
            // Simpan value ke dalam session
            sessionStorage.setItem("poli", selectPoli.value);

            // Kirim AJAX request untuk set session variable di sisi server
            $.ajax({
                url: "set_session.php",
                method: "POST",
                data: {
                    poli: selectPoli.value
                },
                success: function(response) {
                    console.log(response);
                }
            });

            location.reload()
        });

        // Cek apakah ada value yang disimpan pada session
        const selectedValue = sessionStorage.getItem("poli");

        // Set value select jika ada value yang disimpan pada session
        if (selectedValue) {
            selectPoli.value = selectedValue;

            // Kirim AJAX request untuk set session variable di sisi server
            $.ajax({
                url: "set_session.php",
                method: "POST",
                data: {
                    poli: selectedValue
                },
                success: function(response) {
                    console.log(response);
                }
            });
        }
    </script>

</body>

</html>