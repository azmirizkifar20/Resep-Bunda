<?php
require('../../config/conn.php');

if (isset($_POST['update_profile'])) {
    $namaLengkap = $_POST['nama_lengkap'];
    $alamat = $_POST['alamat'];
    $noHp = $_POST['no_hp'];
    $idProfile = $_POST['id_profile'];

    $queryUpdateProfile = "UPDATE profile SET nama_lengkap = '$namaLengkap', 
                alamat = '$alamat', no_hp = '$noHp' WHERE id_profile = $idProfile";
    $resultUpdateProfile = mysqli_query($conn, $queryUpdateProfile);

    if ($resultUpdateProfile > 0) {
        echo '
            <script>
                alert("Berhasil update profile!");
                window.location.href="../profile.php"
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Gagal update profile!");
                window.location.href="../profile.php"
            </script>
        ';
    }
}
?>