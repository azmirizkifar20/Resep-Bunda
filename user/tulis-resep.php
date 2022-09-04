<?php 
session_start();
require('../config/conn.php');

if (empty($_SESSION['user'])) {
    header('Location: ../index.php');
} 

if (isset($_SESSION['level'])) {
    switch($_SESSION['level']) {
        case 'admin': 
            header('Location: ../admin/dashboard.php');
        break;
        case 'user': 
            $user = $_SESSION['user'];
        break;
    }
}

// notif lengkapi profile
$idUser = $user['id_user'];
$queryProfile = "SELECT * FROM profile WHERE id_user = $idUser";
$resultProfile = mysqli_query($conn, $queryProfile);
$dataProfile = mysqli_fetch_assoc($resultProfile);

if ($dataProfile['nama_lengkap'] == '') {
    echo '
        <script>
            alert("Lengkapi profil terlebih dahulu yah!");
            window.location.href="profile.php"
        </script>
    ';
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../assets/img/logo.png">
    <title>Resep Bunda - Tulis Resep</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
</head>

<body>
    <!-- navbar -->
    <?php 
        $currentPage = 'tulis-resep';
        include_once('../components/navbar-user.php') 
    ?>

    <!-- tulis resep -->
    <div class="text-center shadow-p">
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-md-8 bg-white">
                    <form action="functions/insert-recipe.php" method="POST" enctype="multipart/form-data" id="formResep">
                        <input type="hidden" name="id_profile" value="<?= $dataProfile['id_profile'] ?>">
                        
                        <!-- image upload -->
                        <input type="file" name="gambar" id="imgInp" class="alert-heading" hidden>
                        <img id='img-upload' width="100%" src="../assets/img/upload.png" onclick="chooseFile()" style="cursor: pointer"/>
                        <!-- <div onclick="chooseFile()" id="btnUploadImage" class="jumbotron jumbotron-fluid" style="cursor: pointer">
                            <i style="font-size: 17pt" class="fa fa-camera text-info"></i> <br>
                            <span class="text-info">Ketuk untuk upload <br> <i>*Pasang foto masakan buatanmu sendiri</i></span>
                        </div> -->
                        <!-- image upload -->

                        <!-- judul & caption -->
                        <div class="form-group mt-2">
                            <input type="text" name="judul" class="form-control form-control-lg" placeholder="Judul resep..." required>
                        </div>
                        <div class="form-group">
                            <small class="form-text text-muted text-left">Tuliskan cerita kamu dibalik pembuatan makanan.</small>
                            <textarea name="caption" rows="3" class="form-control" placeholder="Cerita dibalik resep..." required></textarea>
                        </div>
                        <hr>
                        <!-- judul & caption -->

                        <!-- bahan -->
                        <h3 class="text-left">Bahan-bahan</h3>
                        <div id="repeater">
                            <div class="clearfix"></div>
                            <!-- repeater items -->
                            <div class="items">
                                <div class="item-content">
                                    <div class="form-group">
                                        <input type="text" class="form-control" data-skip-name="true" data-name="bahan[]" placeholder="Masukkan bahan" style="width: 88%" required>
                                    </div>
                                    <!-- remove -->
                                    <div class="pull-right repeater-remove-btn">
                                        <button type="button" class="btn btn-danger remove-btn float-right" style="margin-top: -54px">
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            
                            <a class="repeater-add-btn" id="btnAddRepeat" hidden>Tambah bahan</a>
                        </div>
                        <a class="btn btn-info float-left text-white" onclick="addBahan()">Tambah bahan</a> <br><br><hr>
                        <!-- bahan -->

                        <!-- langkah -->
                        <h3 class="text-left">Lagkah-langkah</h3>
                        <div id="repeater2">
                            <div class="clearfix"></div>
                            <!-- repeater items -->
                            <div class="items">
                                <div class="item-content">
                                    <div class="form-group">
                                        <!-- <textarea class="form-control" data-skip-name="true" data-name="langkah[]" rows="3" placeholder="Masukkan bahan" style="width: 88%" required></textarea> -->
                                        <input type="text" class="form-control" data-skip-name="true" data-name="langkah[]" placeholder="Masukkan langkah" style="width: 88%" required>
                                    </div>
                                    <!-- remove -->
                                    <div class="pull-right repeater-remove-btn">
                                        <button type="button" class="btn btn-danger remove-btn float-right" style="margin-top: -54px">
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            
                            <a class="repeater-add-btn" id="btnAddRepeat2" hidden>Tambah bahan</a>
                        </div>
                        <a class="btn btn-info float-left text-white" onclick="addLangkah()">Tambah langkah</a>
                        <!-- langkah --> <br> <br>
                        <hr>
                        <button type="submit" name="tambah-resep" class="btn btn-primary mb-4" style="width: 100%">Terbitkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- tulis resep -->
    
    <!-- repeater -->
    <script src="../assets/js/repeater.js"></script>
    <script>
        function chooseFile() {
            $("#btnUploadImage").hide();
            document.getElementById("imgInp").click();
        }

        $("#repeater").createRepeater({
            showFirstItemToDefault: true,
        });
        $("#repeater2").createRepeater({
            showFirstItemToDefault: true,
        });

        // add repeater
        function addBahan() {
            document.getElementById("btnAddRepeat").click();
        }
        function addLangkah() {
            document.getElementById("btnAddRepeat2").click();
        }
    </script>

    <!-- show image upload -->
    <script src="../assets/js/show-image.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>