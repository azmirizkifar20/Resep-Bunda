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

// get data user
$no = 1;
$users = query('SELECT * FROM profile LEFT JOIN users using(id_user)');

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../assets/img/logo.png">
    <title>Resep Bunda (admin) - users</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/utils.css">
</head>

<body class="bg-light">
    <!-- navbar -->
    <?php 
        $currentPage = 'data-user';
        include_once('../components/navbar-admin.php') 
    ?>

    <div class="container mt-5 pt-4" id="container">
    <h2 class="mb-3">data user</h2>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table>
						<thead>
							<tr class="table100-head">
								<th class="column1">No.</th>
								<th class="column3">Username</th>
								<th class="column2">Email</th>
								<th class="column2">Nama Lengkap</th>
								<th class="column2">Alamat</th>
								<th class="column3">Nomor HP</th>
								<th class="column4">Aksi</th>
							</tr>
						</thead>
						<tbody>
                            <?php foreach($users as $row) : ?>
                                <tr>
                                    <td class="column1"><?= $no ?></td>
                                    <td class="column3"><?= $row['username'] ?></td>
                                    <td class="column2"><?= $row['email'] ?></td>
                                    <td class="column2"><?= $row['nama_lengkap'] ?></td>
                                    <td class="column2"><?= $row['alamat'] ?></td>
                                    <td class="column3"><?= $row['no_hp'] ?></td>
                                    <td class="column4">
                                        <a href="detail-user.php?id=<?= $row['id_profile'] ?>">
                                            <i style="font-size: 15pt; color: #3d3557" class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php $no++; endforeach ?>
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>