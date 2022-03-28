<!doctype html>
<html lang="en">

<?php include("../content/headers.php") ?>

<body>
<nav class="navbar nav navbar-expand-md navbar-light bg-light border" id="mainNav" style="margin-bottom: 10px">
    <a href="../index.php">
        <img src="../static/icon.svg" alt="OldChicken"
             width="40px" height="40px" style="margin-right: 5px">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse w-100" id="navbarNav">

        <div class="navbar-nav w-100 justify-content-left col-md-7">
            <div class="nav-item">
                <a class="nav-link" id="home" href="../index.php">Home</a>
            </div>

            <div class="nav-item">
                <a class="nav-link text-nowrap" id="products" href="../content/products.php">Products</a>
            </div>

            <div class="nav-item">
                <a class="nav-link text-nowrap" id="about" href="../content/about_us.php">About Us</a>
            </div>

            <div class="nav-item dropdown">
                <a class="nav-link text-nowrap dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Customer Support
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="../content/faq.php">FAQ</a>
                    <a class="dropdown-item" href="../content/contact_us.php">Contact Us</a>
                    <a class="dropdown-item" href="../content/shipping_returns.php">Shipping & Returns</a>
                </div>
            </div>
            <div class="nav-link">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="darkSwitch">
                    <label class="custom-control-label" for="darkSwitch">Dark Mode</label>
                </div>
            </div>

            <div class="nav-item">
                <a class="nav-link text-nowrap" id="gallery" href="../content/gallery.php">Gallery</a>
            </div>
        </div>

        <div class="nav-item w-100 justify-content-center col d-none d-md-block">
            <form class="d-flex">
                <input class="form-control mr-2 col-10" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-primary text-nowrap" type="submit">Search</button>
            </form>
        </div>

        <?php
            if (isLoggedIn()) {
                echo '<div class="navbar-nav w-100 justify-content-end col">
                        <div class="nav-item">
                            <a class="nav-link text-nowrap" id="cart" href="../content/cart.php">Cart</a>
                        </div>
                      </div>
                      <div class="navbar-nav w-100 justify-content-end col">
                        <div class="nav-item">
                            <a class="nav-link text-nowrap" id="myAcc" href="../content/cart.php">My Account</a>
                        </div>
                      </div>';
            } else {
                echo '<div class="navbar-nav w-100 justify-content-end col">
                        <div class="nav-item">
                            <a class="nav-link text-nowrap" id="login" href="../content/login.php">Log in</a>
                        </div>
                      </div>';
            }

        ?>





        <div class="nav-item w-100 justify-content-center col-md-4 d-sm-block d-md-none">
            <form class="d-flex">
                <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-secondary text-nowrap" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>

<button type="button" class="btn btn-primary text-nowrap" id="btn-btt">
<img src="../scrollButton/arrowUP.svg" alt="arrowUP">
</button>


<!--For Dark-mode slider-->

<script src="../dark-mode/dark-mode.js"></script>
<link rel="stylesheet" type="text/css" href="../dark-mode/dark-mode.css">
<!--For scroll button-->
<link rel="stylesheet" href="../scrollButton/bttStyle.css">
<script src="../scrollButton/scrollButton.js"></script>

</body>
</html>