<?php
session_start();

include './koneksi.php';

if (isset($_SESSION['poli'])) {
    $selectedValue = $_SESSION['poli'];
    // melakukan operasi lain jika key 'poli' sudah ada di dalam $_SESSION
    $sql = "SELECT COUNT(*) AS total FROM antrian WHERE poli = '$selectedValue'";;
    $result = mysqli_query($conn, $sql);
    // Mengambil jumlah data
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $total_data = $row["total"];
        $no_antrian = $total_data + 1;
    } else {
        $total_data = 0;
        $no_antrian = $total_data + 1;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="proses_antrian.php" method="POST">
        <div>
            <div>
                <label for="">Pilih poli</label><br>
                <select name="poli" id="poli">
                    <option value="PLGG" <?php if ($selectedValue == "PLGG") echo "selected"; ?>>PLGG</option>
                    <option value="PLUM" <?php if ($selectedValue == "PLUM") echo "selected"; ?>>PLUM</option>
                    <option value="PLIM" <?php if ($selectedValue == "PLIM") echo "selected"; ?>>PLIM</option>
                    <option value="PLAN" <?php if ($selectedValue == "PLAN") echo "selected"; ?>>PLAN</option>
                </select>
            </div>
            <div>
                <label for="">No Antrian</label>
                <br>
                <input type="text" name="no_antrian" id="no_antrian" value="<?= $no_antrian ?>" readonly>
            </div>
            <div>
                <label for="">nama</label>
                <br>
                <input type="text" name="nama" id="nama" value="">
            </div>
            <div>
                <button type="submit">Ambil Antrian</button>
            </div>
        </div>
    </form>
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