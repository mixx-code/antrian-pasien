<?php
include '../../config/koneksi.php';

// jumlah data per halaman
$jumlahDataPerHalaman = 10;

// menghitung jumlah data
$sql = "SELECT COUNT(*) AS jumlah FROM antrian JOIN user ON antrian.nik = user.nik;";
$jumlahData = mysqli_fetch_assoc(mysqli_query($conn, $sql));

// menghitung jumlah halaman
$jumlahHalaman = ceil($jumlahData['jumlah'] / $jumlahDataPerHalaman);

// mengambil halaman yang diminta
$halamanAktif = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
$awalData = ($halamanAktif - 1) * $jumlahDataPerHalaman;

// mengambil data dengan batasan limit
$sql = "SELECT antrian.id_antrian, antrian.poli, user.nama, antrian.tanggal_antrian, antrian.no_antrian, antrian.status
FROM antrian
JOIN user ON antrian.nik = user.nik
GROUP BY user.nama
ORDER BY antrian.tanggal_antrian ASC
LIMIT $awalData, $jumlahDataPerHalaman;
";
$result = mysqli_query($conn, $sql);
?>


<div class="tabel-pasien">
    <h1>Admin - Antrian Poli</h1>
    <table class="table-data-pasien">
        <thead>
            <tr>
                <th>Poli</th>
                <th>NAMA PASIEN</th>
                <th>TANGGAL ANTRIAN</th>
                <th>NO ANTRIAN</th>
                <th>STATUS</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <?php if (mysqli_num_rows($result) > 0) : ?>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr class="body-tabel">
                    <td><?= $row["poli"] ?></td>
                    <td><?= $row["nama"] ?></td>
                    <td><?= $row["tanggal_antrian"] ?></td>
                    <td><?= $row["no_antrian"] ?></td>
                    <td><?= $row["status"] ?></td>
                    <?php if ($row["status"] == 'tunggu') : ?>
                        <td style="text-align:center;"><a style="color: white; margin-right: 20px; padding: 5px 10px; background-color: blue; border-radius: 20px;" href="?page=antrian-poli&id=<?= $row["id_antrian"] ?>">Proses</a></td>

                    <?php else : ?>
                        <td style="text-align:center;"><a style="color: white; margin-right: 20px; padding: 5px 10px; background-color: green; border-radius: 20px;" href="?page=antrian-poli&submit=<?= $row["id_antrian"] ?>">Submit</a></td>
                    <?php endif; ?>
                </tr>

            <?php endwhile; ?>
            <?php
            // Periksa apakah tombol "Proses" diklik
            if (isset($_GET['id'])) {
                $id_antrian = $_GET['id'];
                $query1 = "UPDATE antrian SET status='proses' WHERE id_antrian=$id_antrian";
                // melakukan eksekusi query1
                $update = mysqli_query($conn, $query1);
                if (!$update) {
                    // Jika update gagal, tampilkan pesan error
                    die("Gagal mengupdate status antrian: " . mysqli_error($conn));
                }

                // Alihkan kembali ke halaman sebelumnya setelah update berhasil
                header("Location: ?page=antrian-poli");
                exit();
            }
            ?>
            <?php
            if (isset($_GET['submit'])) {
                $id_antrian = $_GET['submit'];

                // Ambil data dari tabel antrian
                $query2 = "SELECT * FROM antrian WHERE id_antrian=$id_antrian";
                $result = mysqli_query($conn, $query2);
                $data = mysqli_fetch_assoc($result);

                // Masukkan data ke tabel pengunjung
                $sql = "INSERT INTO pengunjung (nik, poli, tanggal_kunjungan) VALUES ('" . $data["nik"] . "', '" . $data["poli"] . "', '" . $data["tanggal_antrian"] . "')";
                $result = mysqli_query($conn, $sql);

                // Hapus data dari tabel antrian
                $query2 = "DELETE FROM antrian WHERE id_antrian=$id_antrian";
                $result = mysqli_query($conn, $query2);

                // Alihkan kembali ke halaman sebelumnya setelah submit berhasil
                header("Location: ?page=antrian-poli");
                exit();
            }
            ?>

        <?php else : ?>
            <tr>
                <td colspan="8" style="text-align: center;">Data kosong</td>
            </tr>
        <?php endif; ?>

    </table>
    <div class="pagination">
        <!-- Tombol Sebelumnya -->
        <?php if ($halamanAktif > 1) : ?>
            <a class="sebelumnya" href="?page=antrian-poli&halaman=<?= $halamanAktif - 1 ?>">Sebelumnya</a>
        <?php else : ?>
            <span class="sebelumnya">Sebelumnya</span>
        <?php endif; ?>

        <!-- Nomor Halaman -->
        <h3><?= $halamanAktif ?></h3>

        <!-- Tombol Selanjutnya -->
        <?php if ($halamanAktif < $jumlahHalaman) : ?>
            <a class="selanjutnya" href="?page=antrian-poli&halaman=<?= $halamanAktif + 1 ?>">Selanjutnya</a>
        <?php else : ?>
            <span class="selanjutnya">Selanjutnya</span>
        <?php endif; ?>

    </div>

</div>