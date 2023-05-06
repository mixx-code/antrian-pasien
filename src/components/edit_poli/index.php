<?php
session_start();
include '../../config/koneksi.php';
// $role = $_SESSION['role'];

if (isset($_GET['poli'])) {
    $poli = $_GET['poli'];
    $sql = "SELECT * FROM poli WHERE poli = '$poli'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $poli_sekarang = $row['poli'];
        $nama_poli = $row['nama_poli'];
        $jumlah_maksimal = $row['jumlah_maksimal'];
    } else {
        echo "data kosong";
    }
}
?>
<div class="container-tambah-pasien">
    <h1>Admin - Data Pasien</h1>
    <p class="edit-user">Edit user</p>
    <form class="form-tambah-user" action="../../config/proses_update_poli.php" method="POST">
        <table>
            <tr>
                <td class="label"><label for="poli">Poli</label></td>
                <td><input max="25" type="text" name="poli" value="<?= $poli_sekarang  ?>" readonly></td>
            </tr>
            <tr>
                <td class="label"><label for="nama_poli">Nama Poli</label></td>
                <td><input max="25" type="text" name="nama_poli" value="<?= $nama_poli ?>"></td>
            </tr>
            <tr>
                <td class="label"><label for="jumlah_maksimal">Jumlah Maksimal</label></td>
                <td><input type="text" name="jumlah_maksimal" value="<?= $jumlah_maksimal ?>"></td>
            </tr>
            <tr>
                <td class="label">
                    <div class="btn-login">
                        <button type="submit" name="update_poli">Update</button>
                        <a style="color:black;" href="?page=data-pasien">kembali</a>
                    </div>
                </td>
                <td></td>
            </tr>

        </table>
    </form>
</div>