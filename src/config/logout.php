<?php
session_start(); // mulai session
session_unset(); // hapus semua data session
session_destroy(); // hapus session
header("Location: ../../index.php"); // redirect ke halaman login
exit(); // keluar dari script