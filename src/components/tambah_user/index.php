<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$role = $_SESSION['role'];
?>
<div class="container-tambah-pasien">
    <h1>Admin - Data Pasien</h1>
    <p class="edit-user">Tambah User</p>
    <form class="form-tambah-user" action="../../pages/registrasi/proses_registrasi.php" method="POST">
        <table>
            <tr>
                <td class="label"><label for="nik">Nik</label></td>
                <td><input max="25" type="text" name="nik"></td>
            </tr>
            <tr>
                <td class="label"><label for="nama">Nama</label></td>
                <td><input max="25" type="text" name="nama"></td>
            </tr>
            <tr>
                <td class="label"><label for="jenis_kelamin">Jenis Kelamin</label></td>
                <td><select name="jenis_kelamin" id="">
                        <option value="laki-laki">laki-laki</option>
                        <option value="perempuan">perempuan</option>
                    </select></td>
            </tr>
            <tr>
                <td class="label"><label for="tanggal_lahir">Tanggal Lahir</label></td>
                <td><input type="date" name="tanggal_lahir"></td>
            </tr>
            <tr>
                <td class="label"><label for="alamat">alamat</label></td>
                <td><textarea name="alamat" id="" cols="64" rows="3"></textarea></td>
            </tr>
            <tr>
                <td class="label"><label for="no_telp">no Telp</label></td>
                <td><input max="25" type="tel" name="no_telp"></td>
            </tr>
            <tr>
                <td class="label"><label for="username">Username</label></td>
                <td><input max="25" type="text" name="username"></td>
            </tr>
            <tr>
                <td class="label"><label for="password">Password</label></td>
                <td><input max="25" type="text" name="password"></td>
            </tr>
            <tr>
                <td class="label"><label for="role">Role</label></td>
                <td><select name="role" id="">
                        <option value="user">user</option>
                        <?php
                        if ($role == "admin") { ?>
                            <option value="admin">admin</option>
                        <?php } ?>
                    </select></td>
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