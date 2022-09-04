<?php
require('../../config/conn.php');

// update resep
if (isset($_POST['update'])) {
    $idResep = $_POST['id'];
    $judul = $_POST['judul'];
    $caption = $_POST['caption'];
    $bahanUpdate = implode('| ', $_POST['bahan']);
    $langkahUpdate = implode('| ', $_POST['langkah']);

    // gambar
    $namaFile = $_FILES['gambar']['name'];
    $fileSize = $_FILES['gambar']['size'];
    $fileTmp = $_FILES['gambar']['tmp_name'];

    // jika user update foto
    if ($namaFile != '') {
        // ekstensi file
        $grantedFileType = array('png', 'jpg', 'jpeg');
        $x = explode('.', $namaFile);
        $ekstensi = strtolower(end($x));
        
        // cek file type
        if (in_array($ekstensi, $grantedFileType) === false) {
            echo '
                <script>
                    alert("harap untuk upload gambar!");
                    window.location.href = "../edit-resep.php"
                </script>
            ';
            return false;
        }

        // cek file size
        if ($fileSize > 2000000) {
            echo '
                <script>
                    alert("Ukuran gambar terlalu besar!");
                    window.location.href = "../edit-resep.php"
                </script>
            ';
            return false;
        }

        // set path upload
        $path = '../../public/uploads/'.$_POST['old-image'];
        move_uploaded_file($fileTmp, $path);
    }
    
    $queryUpdate = "UPDATE resep SET judul_resep = '$judul', caption = '$caption',
                bahan = '$bahanUpdate', langkah = '$langkahUpdate' WHERE id_resep = $idResep";
    $resultUpdate = mysqli_query($conn, $queryUpdate);

    if ($resultUpdate > 0) {
        echo '
            <script>
                alert("Berhasil update resep!");
                window.location.href="../resep-saya.php"
            </script>
        ';
    } else {
        echo ' 
            <script>
                alert("Berhasil update resep!");
            </script>
        ';
    }
}
?>