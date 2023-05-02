<?php
session_start(); // Memulai session
include './koneksi.php';
if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['poli'])) { // Mengecek apakah session 'poli' telah diset atau belum
    $selectedValue = $_SESSION['poli']; // Mengambil value dari session 'poli'
    $sql = "SELECT COUNT(*) AS total FROM antrian WHERE poli = '$selectedValue'";;
    $result = mysqli_query($conn, $sql);
    // Mengambil jumlah data
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $total_data = $row["total"];
        $no_antrian = $total_data;
        $test = "ada";
    } else {
        $total_data = 0;
        $no_antrian = $total_data;
        $test = "tidak ada";
    }
} else {
    $selectedValue = ""; // Jika session belum diset, set value select menjadi kosong
    $no_antrian = 10; // Jika tidak ada data di tabel, set nilai no_antrian menjadi 1
    $test = "tidak ada";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antrian</title>
</head>

<body>
    <?= $no_antrian ?>
    <br>
    <?= $test ?>
    <br>
    <?= "ini secction : " . $selectedValue ?>
    <form action="" method="POST">
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
                <input type="text" name="no_antrian" id="no_antrian" value="<?php echo $no_antrian ?>">
            </div>
            <div>
                <button type="submit">Ambil Antrian</button>
            </div>
        </div>
    </form>
    <script>
        // Ambil element select
        const selectPoli = document.querySelector("#poli");

        // Tambah event listener untuk saat value berubah
        selectPoli.addEventListener("change", function() {
            // Simpan value ke dalam session
            sessionStorage.setItem("poli", selectPoli.value);
            location.reload()
        });

        // Cek apakah ada value yang disimpan pada session
        const selectedValue = sessionStorage.getItem("poli");

        // Set value select jika ada value yang disimpan pada session
        if (selectedValue) {
            selectPoli.value = selectedValue;
        }
    </script>
</body>

</html>