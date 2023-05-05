<?php
$role = "user";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registrasi.css">
    <title>Registrasi</title>
</head>

<body>
    <div class="container">
        <div class="navbar">
            <p>Pendaftaran Pasien Online</p>
        </div>
        <form class="form-registrasi" action="./proses_registrasi.php" method="POST">
            <span class="kembali">
                <a href="../../../index.php">X</a>
            </span>
            <div>
                <label for="nik">Nik</label>
                <input max="25" type="text" name="nik">
            </div>
            <div>
                <label for="nama">Nama</label>
                <input max="25" type="text" name="nama">
            </div>
            <div>
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="">
                    <option value="laki-laki">laki-laki</option>
                    <option value="perempuan">perempuan</option>
                </select>
            </div>
            <div>
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir">
            </div>
            <div>
                <label for="alamat">alamat</label>
                <textarea name="alamat" id="" cols="30" rows="3"></textarea>
            </div>
            <div>
                <label for="no_telp">no Telp</label>
                <input max="25" type="tel" name="no_telp">
            </div>
            <div>
                <label for="username">Username</label>
                <input max="25" type="text" name="username">
            </div>
            <div>
                <label for="password">Password</label>
                <input max="25" type="text" name="password">
            </div>
            <div>
                <label for="role">Role</label>
                <select name="role" id="">
                    <option value="user">user</option>
                    <?php
                    if ($role == "admin") { ?>
                        <option value="admin">admin</option>
                    <?php } ?>
                </select>
            </div>
            <div class="btn-login">
                <button type="submit">Simpan</button>
            </div>
        </form>
    </div>
</body>

</html>