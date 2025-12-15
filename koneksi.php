<?php
    $server = "localhost";
    $user = "root";
    $pass = "";
    $db   = "lt_ukk";

    $koneksi = mysqli_connect($server, $user, $pass, $db) or die("Gagal Terhubung ke database");
?>