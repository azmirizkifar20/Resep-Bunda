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

    if (isset($_POST['login'])) {
        $username = trim(htmlspecialchars($_POST['username']));
        $password = trim(htmlspecialchars($_POST['password']));
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        
        if ($username == "" || $password == "") {
            echo '
                <script>
                    alert("Masukkan username/password dengan benar!");
                    window.location.href="login.php"
                </script>
            ';
            return false;
        }

        if (mysqli_num_rows($result) > 0) {
            $hasil = mysqli_fetch_assoc($result);

            if (password_verify($password, $hasil['password'])) {
                switch($hasil['level']) {
                    case 'admin':
                        $_SESSION['user'] = $hasil;
                        $_SESSION['level'] = 'admin';
                        header('Location: admin/index.php');
                    break;
                    case 'user': 
                        $_SESSION['user'] = $hasil;
                        $_SESSION['level'] = 'user';
                        header('Location: user/index.php');
                    break;
                }
            } else {
                echo '
                    <script>
                        alert("Username / password salah!");
                        window.location.href="login.php"
                    </script>
                ';
            return false;
            }
        } else {
            echo '
                <script>
                    alert("Username / password salah!");
                    window.location.href="login.php"
                </script>
            ';
            return false;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/logo.png">
    <title>Resep Bunda - Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="login-form">
        <h1>Login to Resep Bunda</h1>
        <form action="" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
            <p class=" text-secondary mt-2">Don't have an account? <a class="text-decoration-none text-primary"
                    href="register.php">Register
                    here</a></p>
        </form>
    </div>
</body>
</html>