<?php
include '../../config/koneksi.php';

// jumlah data per halaman
$jumlahDataPerHalaman = 10;

// menghitung jumlah data
$sql = "SELECT COUNT(*) AS jumlah FROM pengunjung";
$jumlahData = mysqli_fetch_assoc(mysqli_query($conn, $sql));

// menghitung jumlah halaman
$jumlahHalaman = ceil($jumlahData['jumlah'] / $jumlahDataPerHalaman);

// mengambil halaman yang diminta
$halamanAktif = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
$awalData = ($halamanAktif - 1) * $jumlahDataPerHalaman;

// mengambil data dengan batasan limit
$sql = "SELECT user.nama, pengunjung.* FROM user JOIN pengunjung ON user.nik = pengunjung.nik LIMIT $awalData, $jumlahDataPerHalaman";
$result = mysqli_query($conn, $sql);
?>


<div class="tabel-pasien">
    <h1>Admin - Data Pengunjung</h1>
    <div class="tambah">
        <span></span>
        <a href="../../pages/cetak_pengunjung/?halaman=<?php echo $halamanAktif; ?>"><img style="width: 18px; margin-right: 3px;" src="../../../assets/images/printer.png" alt=""> Cetak</a>
    </div>
    <table class="table-data-pasien">
        <thead>
            <tr>
                <th>NIK</th>
                <th>NAMA</th>
                <th>Poli</th>
                <th>TANGGAL Kunjungan</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <?php if (mysqli_num_rows($result) > 0) : ?>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr class="body-tabel">
                    <td><?= $row["nik"] ?></td>
                    <td><?= $row["nama"] ?></td>
                    <td><?= $row["poli"] ?></td>
                    <td><?= $row["tanggal_kunjungan"] ?></td>
                    <td style="text-align:center;"> <a style="color:red;" href="../../config/hapus_pengunjung.php?id_pengunjung=<?= $row["id_pengunjung"] ?>" onclick="return confirm(`Apa anda mau menghapus <?= $row['nama'] ?>`)"><img style="width: 18px;" src="../../../assets/images/hapus.png" alt=""></a>
                    </td>
                </tr>

            <?php endwhile; ?>
        <?php else : ?>
            <tr>
                <td colspan="8" style="text-align: center;">Data kosong</td>
            </tr>
        <?php endif; ?>

    </table>
    <div class="pagination">
        <?php if ($halamanAktif > 1) : ?>
            <a class="sebelumnya" href="?page=pengunjung&halaman=<?= $halamanAktif - 1 ?>">Sebelumnya</a>
        <?php else : ?>
            <span class="sebelumnya">Sebelumnya</span>
        <?php endif; ?>

        <h3><?= $halamanAktif ?></h3>

        <?php if ($halamanAktif < $jumlahHalaman) : ?>
            <a class="selanjutnya" href="?page=pengunjung&halaman=<?= $halamanAktif + 1 ?>">Selanjutnya</a>
        <?php else : ?>
            <span class="selanjutnya">Selanjutnya</span>
        <?php endif; ?>
    </div>

</div>