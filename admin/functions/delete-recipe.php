<?php
require('../../config/conn.php');

if (isset($_GET['id'])) {
    $idResep = $_GET['id'];
    $query = "DELETE FROM resep WHERE id_resep = $idResep";
    $result = mysqli_query($conn, $query);

    if ($result > 0) {
        echo '
            <script>
                alert("Berhasil hapus resep!");
                window.location.href="../data-user.php"
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Gagal hapus resep!");
                window.location.href="../data-user.php"
            </script>
        ';
    }
} else {
    header('Location: ../index.php');
}

?>