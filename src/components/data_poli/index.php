<?php
include '../../config/koneksi.php';

// jumlah data per halaman
$jumlahDataPerHalaman = 10;

// menghitung jumlah data
$sql = "SELECT COUNT(*) AS jumlah FROM poli";
$jumlahData = mysqli_fetch_assoc(mysqli_query($conn, $sql));

// menghitung jumlah halaman
$jumlahHalaman = ceil($jumlahData['jumlah'] / $jumlahDataPerHalaman);

// mengambil halaman yang diminta
$halamanAktif = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
$awalData = ($halamanAktif - 1) * $jumlahDataPerHalaman;

// mengambil data dengan batasan limit
$sql = "SELECT * FROM poli LIMIT $awalData, $jumlahDataPerHalaman";
$result = mysqli_query($conn, $sql);
?>


<div class="tabel-pasien">
    <h1>Admin - Data Poli</h1>
    <div class="tambah">
        <a href="?page=tambah-poli"><img style="width: 18px; margin-right: 3px;" src="../../../assets/images/tambah.png" alt=""> Add Poli</a>
    </div>
    <table class="table-data-pasien">
        <thead>
            <tr>
                <th>POLI</th>
                <th>NAMA POLI</th>
                <th>JUMLAH MAKSIMAL</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <?php if (mysqli_num_rows($result) > 0) : ?>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr class="body-tabel">
                    <td><?= $row["poli"] ?></td>
                    <td><?= $row["nama_poli"] ?></td>
                    <td><?= $row["jumlah_maksimal"] ?></td>
                    <td style="text-align:center;"><a style="margin-right: 20px;" href="../../pages/dashboard_admin/?page=edit-poli&poli=<?= $row["poli"] ?>"><img src="../../../assets/images/pensil.png" alt=""></a> <a style="color:red;" href="../../config/hapus_poli.php?poli=<?= $row["poli"] ?>" onclick="return confirm(`Apa anda mau menghapus <?= $row['nama_poli'] ?>`)"><img style="width: 18px;" src="../../../assets/images/hapus.png" alt=""></a>
                    </td>
                </tr>

            <?php endwhile; ?>
        <?php else : ?>
            <tr>
                <td colspan="4" style="text-align: center;">Data kosong</td>
            </tr>
        <?php endif; ?>

    </table>
    <div class="pagination">
        <?php if ($halamanAktif > 1) : ?>
            <a class="sebelumnya" href="?page=data-poli&halaman=<?= $halamanAktif - 1 ?>">Sebelumnya</a>
        <?php else : ?>
            <span class="sebelumnya">Sebelumnya</span>
        <?php endif; ?>

        <h3><?= $halamanAktif ?></h3>

        <?php if ($halamanAktif < $jumlahHalaman) : ?>
            <a class="selanjutnya" href="?page=data-poli&halaman=<?= $halamanAktif + 1 ?>">Selanjutnya</a>
        <?php else : ?>
            <span class="selanjutnya">Selanjutnya</span>
        <?php endif; ?>
    </div>

</div>