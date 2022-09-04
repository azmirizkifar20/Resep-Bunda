<?php
    session_start();

    if (empty($_SESSION['user'])) {
        header('Location: login.php');
        exit;
    }
    
    session_unset();
    session_destroy();

    header('Location: index.php');
?>