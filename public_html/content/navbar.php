<!doctype html>
<html lang="en">

<?php include("../content/headers.php") ?>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-light border">
    <div class="container-fluid">
        <a class="navbar-brand" href="../content/index.php">
            <img src="../static/icon.svg" alt="OldChicken Icon" style="height:50px;width:50px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="../content/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../content/products.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../content/gallery.php">Gallery</a>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-primary text-nowrap" type="submit">Search</button>
            </form>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php if(!isLoggedIn()){ ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../content/login.php">Log In</a>
                    </li>
                <?php }else { ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../content/cart.php">Cart</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            My Account
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../content#">Account Homepage</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="../content/logout.php">Log Out</a></li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<!--For Dark-mode slider-->
<script src="../dark-mode/dark-mode.js"></script>
<link rel="stylesheet" type="text/css" href="../dark-mode/dark-mode.css">

</body>
</html>