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

// get data resep
$idProfile = $dataProfile['id_profile'];
$dataResep = query("SELECT * FROM RESEP LEFT JOIN profile using(id_profile) WHERE id_profile = $idProfile");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../assets/img/logo.png">
    <title>Resep Bunda - Resep Saya</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <!-- navbar -->
    <?php 
        $currentPage = 'resep-saya';
        include_once('../components/navbar-user.php') 
    ?>

    <!-- card resep -->
    <div class="py-4 mt-5">
        <div class="container">
            <div class="row">
            <?php foreach($dataResep as $row) : ?>
                <div class="col-md-4 p-3">
                    <a style="text-decoration: none" class="text-dark" href="resep.php?id=<?= $row['id_resep'] ?>">
                        <div class="card box-shadow">
                            <img class="card-img-top" src="../public/uploads/<?= $row['gambar'] ?>">
                            <div class="card-body">
                                <h3 class="card-text"><?= $row['judul_resep'] ?></h3>
                                <p class="card-text"><?= substr($row['caption'], 0, 50) ?></p>
                                <a href="functions/delete-recipe.php?id=<?= $row['id_resep'] ?>" class="card-link text-danger float-right mt-3" onclick="return confirm('Yakin ingin menghapus resep?')">
                                    <i class="fa fa-trash"></i> delete
                                </a>
                                <a href="edit-resep.php?id=<?= $row['id_resep'] ?>" class="card-link mr-2 text-info float-right mt-3">
                                    <i class="fa fa-edit"></i> edit
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- card resep -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>