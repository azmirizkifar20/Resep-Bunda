<?php 
session_start();
require 'config/conn.php';

if (isset($_SESSION['user'])) {
    switch ($_SESSION['level']) {
        case 'admin' : 
            header('Location: admin/index.php');
        break;
        case 'user' : 
            header('Location: user/index.php');
        break;
    }
} 

// get list
function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

// get data resep
if (isset($_POST['cari'])) {
    $cari = $_POST['text_cari'];
    $dataResep = query("SELECT * FROM resep LEFT JOIN profile using(id_profile) WHERE judul_resep LIKE '%$cari%'");
} else {
    $dataResep = query("SELECT * FROM resep LEFT JOIN profile using(id_profile)");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="assets/img/logo.png">
    <title>Resep Bunda</title>
    <!-- CSS dependencies -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .bg {
            background-image: url('assets/img/banner.jpg');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    <!-- navbar -->
    <?php include_once('components/navbar.php') ?>

    <!-- search -->
    <div class="text-center py-5 bg-white shadow-p bg">
        <div class="container">
        <div class="row my-5 justify-content-center">
            <div class="col-md-12 mt-4">
                <img style="margin-top: -25px" src="assets/img/logo.png" width="60px">
                <small style="color: #f0f0f0" class="display-4 m-2">Resep Bunda</small> <br> <br>
                <!-- <h1 class="display-4 mt-4">Resep Bunda</h1> <br> -->
                <form method="POST" action="" class="form-inline w-100">
                    <div class="input-group w-50" style="height: 60px; margin: 0 auto">
                        <input type="text" name="text_cari" class="form-control w-50" placeholder="Cari resep" style="height: 60px;">
                        <div class="input-group-append" style="">
                            <button name="cari" class="btn btn-info" type="submit" style="width: 70px;">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    <!-- search -->

    <!-- card resep -->
    <div class="py-4 shadow-sm" style="background-color: #f6f5f4">
        <div class="container">
            <div class="row">
            <?php foreach($dataResep as $row) : ?>
                <div class="col-md-3 p-3">
                    <a style="text-decoration: none" class="text-dark" href="resep.php?id=<?= $row['id_resep'] ?>">
                        <div class="card box-shadow">
                            <img class="card-img-top" src="public/uploads/<?= $row['gambar'] ?>">
                            <div class="card-body">
                                <h3 class="card-text"><?= $row['judul_resep'] ?></h3>
                                <p class="card-text"><?= substr($row['caption'], 0, 50) ?></p>
                                <small class="float-right">- <?= $row['nama_lengkap'] ?> -</small>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- card resep -->

    <!-- footer -->
    <?php include_once('components/footer.php') ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>