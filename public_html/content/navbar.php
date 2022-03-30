<!doctype html>
<html lang="en">

<?php include("../content/headers.php") ?>
<body class="bg-white">
    <nav class="sticky-top navbar navbar-expand-md bg-light text-dark">
    <div class="container-fluid">
        <a class="navbar-brand d-flex" href="../content/index.php">
            <img src="../static/icon.svg" alt="OldChicken Icon" style="height:30px;width:30px;">
        </a>
        <button class="navbar-toggler border border-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <img id="navbar_icon" class="navbar-toggler-icon" src="../static/hamburger_black.svg" alt="Hamburger Menu Icon">
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link link-dark" aria-current="page" href="../content/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-dark" href="../content/products.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-dark" href="../content/gallery.php">Gallery</a>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control mr-3" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-primary text-nowrap" type="submit">Search</button>
            </form>
            <hr class="dropdown-divider mt-sm-3 mt-md-0 d-md-none d-lg-none d-lx-none d-xxl-none">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php if(!isLoggedIn()){ ?>
                    <li class="nav-item">
                        <a class="nav-link link-dark" aria-current="page" href="../content/login.php">Log In</a>
                    </li>
                <?php }else { ?>


                    <!-- This list only shows when > sm breakpoint, shows on navbar -->
                    <li class="nav-item dropdown d-none d-sm-none d-md-block d-lg-block d-lx-block d-xxl-block bg-light">
                        <a class="nav-link link-dark dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            My Account
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end bg-light" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item link-dark" href="../content#">Account Homepage</a></li>
                            <li><a class="dropdown-item link-dark" href="../content/cart.php">Cart</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item link-dark" href="../content/logout.php">Log Out</a></li>
                        </ul>
                    </li>
                    <!-- This list only shows in the collapsed navbar menu when <= sm breakpoint -->
                    <li class="nav-item dropdown d-block d-sm-block d-md-none bg-light text-dark">
                        <a class="nav-link dropdown-toggle link-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            My Account
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end bg-light border-0" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item link-dark" href="../content#">Account Homepage</a></li>
                            <li><a class="dropdown-item link-dark" href="../content/cart.php">Cart</a></li>
                            <li><a class="dropdown-item link-dark" href="../content/logout.php">Log Out</a></li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

    <button type="button" class="btn bg-dark rounded-circle  text-nowrap" id="btn-btt">
        <img src="../static/arrow_upward_white_24dp.svg" alt="arrowUP" id="btn-btt-img">
    </button>

    <script src="../js/scrollButton.js"></script>
    <link rel="stylesheet" href="../css/bttStyle.css">



</body>
</html>