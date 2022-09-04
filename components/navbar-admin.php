<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm bg-white">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.php">
            <img style="margin-top: -5px" src="../assets/img/logo.png" width="30px">
            <strong class="m-1 text-dark">Dapur Bunda</strong>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link <?php if ($currentPage == 'index') echo 'font-weight-bold' ?>" href="index.php">
                        Jelajah
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($currentPage == 'data-user') echo 'font-weight-bold' ?>" href="data-user.php">
                        Data user
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($currentPage == 'my-account') echo 'font-weight-bold' ?>" href="my-account.php">
                        Akun saya
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Navigation -->