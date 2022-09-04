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
                    <a class="nav-link <?php if ($currentPage == 'tulis-resep') echo 'font-weight-bold' ?>" href="tulis-resep.php">
                        Tulis resep
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($currentPage == 'resep-saya') echo 'font-weight-bold' ?>" href="resep-saya.php">
                        Resep saya
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($currentPage == 'profile') echo 'font-weight-bold' ?>" href="profile.php">
                        Profile
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Navigation -->