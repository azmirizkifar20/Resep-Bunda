<?php 
    $conn = mysqli_connect('localhost', 'root', '', 'resep-bunda');

    if (mysqli_connect_error() == true) {
        die('Gagal terhubung ke database');
    } 
?>