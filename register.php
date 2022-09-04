<?php
    session_start();
    require 'config/conn.php';
    
    if (isset($_SESSION['login'])) {
        switch ($_SESSION['level']) {
            case 'admin' : 
                header('Location: admin/index.php');
            break;
            case 'user' : 
                header('Location: user/index.php');
            break;
        }
    } 
    
    if (isset($_POST['register'])) {
        $email = trim(htmlspecialchars($_POST['email']));
        $username = trim(htmlspecialchars($_POST['username']));
        $password = trim(htmlspecialchars($_POST['password']));
        $passwordConfirm = trim(htmlspecialchars($_POST['password-confirm']));

        if ($email == "" || $username == "" || $password == "" || $passwordConfirm == "") {
            echo '
                <script>
                    alert("Harap isi data yang benar!");
                    window.location.href="register.php"
                </script>
            ';
            return false;
        }
        
        // cek konfirmasi password
        if ($password != $passwordConfirm) {
            echo '
                <script>
                    alert("Konfirmasi password tidak sesuai!");
                    window.location.href="register.php"
                </script>
            ';
            return false;
        }

        $queryCek = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
        $result = mysqli_query($conn, $queryCek);

        // cek username / email
        if (mysqli_num_rows($result) > 0) {
            echo '
                <script>
                    alert("Username / email telah digunakan!");
                    window.location.href="register.php"
                </script>
            ';
            return false;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);
        $queryRegister = "INSERT INTO users(email, username, password) VALUES ('$email', '$username', '$password')";
        $resultRegister = mysqli_query($conn, $queryRegister);

        $queryUser = "SELECT * FROM users WHERE username = '$username'";
        $resultUser = mysqli_query($conn, $queryUser);
        $data = mysqli_fetch_assoc($resultUser);
        $idUser = $data['id_user'];
        
        // insert ke profile
        $queryProfile = "INSERT INTO profile (id_user) VALUES ($idUser)";
        $resultProfile = mysqli_query($conn, $queryProfile);

        if ($resultRegister == true && $resultProfile == true) {
            echo '
                <script>
                    alert("Registrasi berhasil!");
                    window.location.href="login.php"
                </script>
            ';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/logo.png">
    <title>Resep Bunda - Registrasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="login-form">
        <h1>Register to Resep Bunda</h1> 
        <form action="" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="text" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="password-confirm" placeholder="Password Confirm" required>
            <button type="submit" name="register">Register</button> 
            
            <p class=" text-secondary mt-2">Already have an account? <a class="text-decoration-none text-primary"
                    href="login.php">Login
                    here</a></p>
        </form>
    </div>
</body>
</html>