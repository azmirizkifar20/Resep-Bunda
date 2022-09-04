<?php 
session_start();

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

// koneksi database
require '../config/conn.php';

$idUser = $user['id_user'];

// get data users
$queryUser = "SELECT * FROM users WHERE id_user = $idUser";
$resultUser = mysqli_query($conn, $queryUser);
$dataUser = mysqli_fetch_assoc($resultUser);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../assets/img/logo.png">
    <title>Resep Bunda (admin) - Profile saya</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <!-- navbar -->
    <?php 
        $currentPage = 'my-account';
        include_once('../components/navbar-admin.php') 
    ?>

    <!-- container -->
    <div style="padding-top: 100px" class="text-center pb-4">
        <div class="container">
            <div class="row mb-3 justify-content-center">
                <div class="col-7 bg-light shadow-sm p-4 rounded bg-white">

                    <!-- Akun saya -->
                    <form method="POST" action="functions/change-password.php">   
                        <input type="hidden" name="id_user" value="<?= $dataUser['id_user'] ?>">
                        <h2 class="float-left mt-1">Akun anda</h2> <br>
                        <div class="form-group">
                            <input type="text" class="form-control" value="<?= $dataUser['username'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" value="<?= $dataUser['email'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <input type="password" name="old_password" class="form-control" placeholder="Password lama" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="new_password" class="form-control" placeholder="Password baru" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="repeat_new_password" class="form-control" placeholder="Konfirmasi Password baru" required>
                        </div>
                        <button type="submit" name="ganti_password" style="width: 100%" class="btn btn-info">Ganti password</button>
                        <a href="../logout.php" type="submit" name="update_profile" style="width: 100%" class="btn mt-3 btn-danger">Logout</a>
                    </form>
                    <!-- Akun saya -->

                </div>
            </div>
        </div>
    </div>
    <!-- container -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>