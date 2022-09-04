<?php
require('../../config/conn.php');

if (isset($_POST['ganti_password'])) {
    $idUser = $_POST['id_user'];
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    $repeatNewPassword = $_POST['repeat_new_password'];
    
    // get updated old password
    $queryOldPass = "SELECT * FROM users where id_user = $idUser";
    $resultOldPass = mysqli_query($conn, $queryOldPass);
    $dataOldPass = mysqli_fetch_assoc($resultOldPass);

    // cek password lama
    if (!password_verify($oldPassword, $dataOldPass['password'])) {
        echo '
            <script>
                alert("Password lama yang anda masukkan salah!");
                window.location.href="../my-account.php"
            </script>
        ';
        return false;
    } 
    
    // cek konfirmasi password
    if ($newPassword != $repeatNewPassword) {
        echo '
            <script>
                alert("Konfirmasi password tidak sesuai!");
                window.location.href="../my-account.php"
            </script>
        ';
        return false;
    } 

    $passwordUpdate = password_hash($newPassword, PASSWORD_DEFAULT);
    $queryChangePass = "UPDATE users SET password = '$passwordUpdate' WHERE id_user = $idUser";
    $resultChangePass = mysqli_query($conn, $queryChangePass);

    if ($resultChangePass > 0) {
        echo '
            <script>
                alert("Berhasil ganti password!");
                window.location.href="../my-account.php"
            </script>
        '; return false;
    } else {
        echo '
            <script>
                alert("Gagal ganti password!");
                window.location.href="../my-account.php"
            </script>
        '; return false;
    }
}
?>