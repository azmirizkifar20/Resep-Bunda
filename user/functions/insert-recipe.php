<?php
require('../../config/conn.php');

if (isset($_POST['judul'])) {
    $judul = $_POST['judul'];
    $caption = $_POST['caption'];
    $idProfile = $_POST['id_profile'];
    $bahan = implode('| ', $_POST['bahan']);
    $langkah = implode('| ', $_POST['langkah']);

    // gambar
    $namaFile = $_FILES['gambar']['name'];
    $fileSize = $_FILES['gambar']['size'];
    $fileType = $_FILES['gambar']['type'];
    $fileTmp = $_FILES['gambar']['tmp_name'];

    // ekstensi file
    $grantedFileType = array('png', 'jpg', 'jpeg');
    $x = explode('.', $namaFile);
    $ekstensi = strtolower(end($x));

    // cek file type
    if (in_array($ekstensi, $grantedFileType) === false) {
        echo '
            <script>
                alert("harap untuk upload gambar!");
                window.location.href = "../tulis-resep.php"
            </script>
        ';
        return false;
    }

    // cek file size
    if ($fileSize > 2000000) {
        echo '
            <script>
                alert("Ukuran gambar terlalu besar!");
                window.location.href = "../tulis-resep.php"
            </script>
        ';
        return false;
    }

    // set path upload
    $namaFileFix = 'photo_'.$namaFile;
    $path = '../../public/uploads/'.$namaFileFix;

    if (move_uploaded_file($fileTmp, $path)) {
        $query = "INSERT INTO resep (judul_resep, caption, bahan, langkah, gambar, id_profile) 
            VALUES ('$judul', '$caption', '$bahan', '$langkah', '$namaFileFix', $idProfile)";
    
        $result = mysqli_query($conn, $query);
        if ($result > 0) {
            echo '
                <script>
                    alert("Berhasil post resep!");
                    window.location.href = "../resep-saya.php"
                </script>
            ';
        } else {
            echo '
                <script>
                    alert("Gagal post resep!");
                </script>
            ';
        }
    } else {
        echo '
            <script>
                alert("Gambar gagal di upload!");
                window.location.href = "../tulis-resep.php"
            </script>
        ';
    }
}
?>