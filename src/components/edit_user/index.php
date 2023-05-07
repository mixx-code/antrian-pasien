<?php
include '../../config/koneksi.php';
// $role = $_SESSION['role'];

if (isset($_GET['nik'])) {
    $nik = $_GET['nik'];
    $sql = "SELECT * FROM user WHERE nik = '$nik'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $nik_sekarang = $row['nik'];
        $nama = $row['nama'];
        $jenis_kelamin = $row['jenis_kelamin'];
        $tanggal_lahir = $row['tanggal_lahir'];
        $alamat = $row['alamat'];
        $no_telp = $row['no_telp'];
        $username = $row['username'];
        $password = $row['password'];
        $role = $row['role'];
    } else {
        echo "data kosong";
    }
}
?>
<div class="container-tambah-pasien">
    <h1>Admin - Data Pasien</h1>
    <p class="edit-user">Edit user</p>
    <form class="form-tambah-user" action="../../config/proses_update_user.php" method="POST">
        <table>
            <tr>
                <td class="label"><label for="nik">Nik</label></td>
                <td><input max="25" type="text" name="nik" value="<?= $nik_sekarang  ?>" readonly></td>
            </tr>
            <tr>
                <td class="label"><label for="nama">Nama</label></td>
                <td><input max="25" type="text" name="nama" value="<?= $nama ?>"></td>
            </tr>
            <tr>
                <td class="label"><label for="jenis_kelamin">Jenis Kelamin</label></td>
                <td><select name="jenis_kelamin" id="">
                        <option value="laki-laki" <?php echo ($jenis_kelamin == "laki-laki") ? "selected" : "" ?>>laki-laki</option>
                        <option value="perempuan" <?php echo ($jenis_kelamin == "perempuan") ? "selected" : "" ?>>perempuan</option>
                    </select></td>
            </tr>
            <tr>
                <td class="label"><label for="tanggal_lahir">Tanggal Lahir</label></td>
                <td><input type="date" name="tanggal_lahir" value="<?= $tanggal_lahir ?>"></td>
            </tr>
            <tr>
                <td class="label"><label for="alamat">alamat</label></td>
                <td><textarea name="alamat" id="" cols="64" rows="3"><?= $alamat ?></textarea></td>
            </tr>
            <tr>
                <td class="label"><label for="no_telp">no Telp</label></td>
                <td><input max="25" type="tel" name="no_telp" value="<?= $no_telp ?>"></td>
            </tr>
            <tr>
                <td class="label"><label for="username">Username</label></td>
                <td><input max="25" type="text" name="username" value="<?= $username ?>"></td>
            </tr>
            <tr>
                <td class="label"><label for="password">Password</label></td>
                <td><input max="25" type="text" name="password" placeholder="Password baru"></td>
            </tr>
            <tr>
                <td class="label"><label for="role">Role</label></td>
                <td><select name="role" id="">
                        <option value="pasien" <?php echo ($role == "pasien") ? "selected" : "" ?>>Pasien</option>
                        <?php
                        if ($role == "admin") { ?>
                            <option value="admin">admin</option>
                            <option value="admin" <?php echo ($role == "admin") ? "selected" : "" ?>>Admin</option>
                        <?php } ?>
                    </select></td>
            </tr>
            <tr>
                <td class="label">
                    <div class="btn-login">
                        <button type="submit" name="update_pasien">Update</button>
                        <a style="color:black;" href="?page=data-pasien">kembali</a>
                    </div>
                </td>
                <td></td>
            </tr>

        </table>
    </form>
</div>