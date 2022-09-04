<?php 
session_start();
require('../config/conn.php');

if (empty($_SESSION['user'])) {
    header('Location: ../index.php');
} 

if (isset($_SESSION['level'])) {
    switch($_SESSION['level']) {
        case 'admin': 
            $user = $_SESSION['user'];
        break;
        case 'user': 
            header('Location: ../user/index.php');
        break;
    }
}

if (isset($_GET['id'])) {
    $idResep = $_GET['id'];
    $query = "SELECT * FROM resep LEFT JOIN profile using(id_profile) WHERE id_resep = $idResep";
    $result = mysqli_query($conn, $query);
    $resep = mysqli_fetch_assoc($result);

    $bahan = explode('| ', $resep['bahan']);
    $langkah = explode('| ', $resep['langkah']);
} else {
    header('Location: index.php');
}

$noBahan = 1;
$noLangkah = 1;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../assets/img/logo.png">
    <title>Resep Bunda - <?= $resep['judul_resep'] ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
</head>

<body>
    <!-- navbar -->
    <?php include_once('../components/navbar-admin.php') ?>

    <!-- detail resep -->
    <div class="text-center shadow-p">
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-md-8 bg-white">
                    <img width="100%" src="../public/uploads/<?= $resep['gambar'] ?>" style="cursor: pointer"/>
                    <h1 class="text-left mt-3 font-weight-bold text-secondary"><?= $resep['judul_resep'] ?></h1>
                    <p class="text-secondary text-left" style="font-size: 15pt; width: 100%"><?= $resep['caption'] ?></p>
                    <p class="text-left text-secondary" style="margin-top: -15px">by : <?= $resep['nama_lengkap'] ?></p>

                    <hr>
                    <h3 class="text-left mt-3 mb-4 font-weight-bold text-secondary">Bahan-bahan</h3> 
                    <?php foreach($bahan as $row) : ?>
                        <p style="margin-top: -15px" class="text-left text-secondary"><?php echo "$noBahan. $row" ?></p>
                        <?php $noBahan++ ?>
                    <?php endforeach ?>
                    <hr>

                    <h3 class="text-left mt-3 mb-4 font-weight-bold text-secondary">Langkah-langkah</h3> 
                    <?php foreach($langkah as $row) : ?>
                        <p style="margin-top: -15px" class="text-left text-secondary"><?php echo "$noLangkah. $row" ?></p>
                        <?php $noLangkah++ ?>
                    <?php endforeach ?>
                    <a href="index.php" class="btn btn-info mb-3 text-white" style="width: 100%">Lihat resep lain</a>
                </div>
            </div>
        </div>
    </div>
    <!-- detail resep -->
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>