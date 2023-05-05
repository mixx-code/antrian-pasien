<?php
session_start();

if (isset($_POST['poli'])) {
    $_SESSION['poli'] = $_POST['poli'];
    echo "Session variable 'poli' set to " . $_SESSION['poli'];
}
