<?php
session_start();
$role = $_SESSION['role'];
?>
<div class="container-tambah-pasien">
    <h1>Admin - Data Poli</h1>
    <p class="edit-user">Tambah Poli</p>
    <form class="form-tambah-user" action="../../config/proses_tambah_poli.php" method="POST">
        <table>
            <tr>
                <td class="label"><label for="poli">Poli</label></td>
                <td><input max="25" type="text" name="poli"></td>
            </tr>
            <tr>
                <td class="label"><label for="nama_poli">Nama Poli</label></td>
                <td><input max="25" type="text" name="nama_poli"></td>
            </tr>


            <tr>
                <td class="label"><label for="jumlah_maksimal">Jumlah Maksimal</label></td>
                <td><input max="25" type="text" name="jumlah_maksimal"></td>
            </tr>
            <tr>
                <td class="label">
                    <div class="btn-login">
                        <button type="submit">Simpan</button>
                        <a style="color:black;" href="?page=data-pasien">kembali</a>
                    </div>
                </td>
                <td></td>
            </tr>

        </table>
    </form>
</div>