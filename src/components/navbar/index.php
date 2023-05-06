<?php
session_start();
$user = $_SESSION['nama'];
?>
<nav>
    <h1>Admin</h1>
    <div class="profil">
        <img src="../../../assets/images/icon.png" alt="">
        <a href=""><?= $user ?></a>
    </div>
</nav>