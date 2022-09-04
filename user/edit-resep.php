<?php 
session_start();
require('../config/conn.php');

if (empty($_SESSION['user'])) {
    header('Location: ../index.php');
} 

if (isset($_SESSION['level'])) {
    switch($_SESSION['level']) {
        case 'admin': 
            header('Location: ../admin/index.php');
        break;
        case 'user': 
            $user = $_SESSION['user'];
        break;
    }
}

// get data
if (isset($_GET['id'])) {
    $idResep = $_GET['id'];
    $query = "SELECT * FROM resep LEFT JOIN profile using(id_profile) WHERE id_resep = $idResep";
    $result = mysqli_query($conn, $query);
    $resep = mysqli_fetch_assoc($result);
    
    $bahan = explode('| ', $resep['bahan']);
    $langkah = explode('| ', $resep['langkah']);
} else {
    header('Location: resep-saya.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../assets/img/logo.png">
    <title>Resep Bunda - Edit Resep</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
</head>

<body>
    <!-- navbar -->
    <?php include_once('../components/navbar-user.php') ?>

    <!-- tulis resep -->
    <div class="text-center shadow-p">
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-md-8 bg-white">
                    <form action="functions/update-recipe.php" method="POST" enctype="multipart/form-data" id="formResep">
                        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                        <input type="hidden" name="old-image" value="<?= $resep['gambar'] ?>">
                        
                        <!-- image upload -->
                        <input type="file" name="gambar" id="imgInp" class="alert-heading" hidden>
                        <img id='img-upload' width="100%" onclick="chooseFile()" src="../public/uploads/<?= $resep['gambar'] ?>" style="cursor: pointer"/>
                        <!-- image upload -->

                        <!-- judul & caption -->
                        <div class="form-group mt-2">
                            <input type="text" name="judul" value="<?= $resep['judul_resep'] ?>" class="form-control form-control-lg" placeholder="Judul resep..." required>
                        </div>
                        <div class="form-group">
                            <small class="form-text text-muted text-left">Tuliskan cerita kamu dibalik pembuatan makanan.</small>
                            <textarea name="caption" rows="3" class="form-control" placeholder="Cerita dibalik resep..." required><?= $resep['caption'] ?></textarea>
                        </div>
                        <hr>
                        <!-- judul & caption -->

                        <!-- bahan -->
                        <h3 class="text-left">Bahan-bahan</h3>
                        <?php foreach($bahan as $row) : ?>
                            <div class="form-group">
                                <input type="text" value="<?= $row ?>" name="bahan[]" class="form-control" placeholder="Masukkan bahan" required>
                            </div>
                        <?php endforeach ?>
                        <!-- bahan -->

                        <hr>
                        <!-- langkah -->
                        <h3 class="text-left">Langkah-langkah</h3>
                        <?php foreach($langkah as $row) : ?>
                            <div class="form-group">
                            <textarea name="langkah[]" class="form-control" rows="3" placeholder="Masukkan langkah" required><?= $row ?></textarea>
                                <!-- <input type="text" value="<?= $row ?>" name="langkah[]" class="form-control" placeholder="Masukkan langkah" required> -->
                            </div>
                        <?php endforeach ?>
                        <!-- langkah -->
                        <button type="submit" name="update" class="btn btn-primary mt-1 mb-4" style="width: 100%">Update resep</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- tulis resep -->

    <script>
        function chooseFile() {
            $("#btnUploadImage").hide();
            document.getElementById("imgInp").click();
        }
    </script>

    <!-- show image upload -->
    <script src="../assets/js/show-image.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>