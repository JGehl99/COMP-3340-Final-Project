<!doctype html>
<html lang="en">
<head>

    <!-- Ensure $title isn't undefined, if undefined: initialize to empty string-->
    <title> <?php if (empty($title)) $title = ""; echo $title; ?> </title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
            crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet"  integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
</head>

<body>
<nav class="navbar nav navbar-expand-md navbar-light bg-light border" style="margin-bottom: 10px">
    <a href="../public_html/index.php">
        <img src="../public_html/static/icon.svg" alt="OldChicken"
             width="40px" height="40px" style="margin-right: 5px">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse w-100" id="navbarNav">

        <div class="navbar-nav w-100 justify-content-left col-md-7">
            <div class="nav-item">
                <a class="nav-link" href="../public_html/index.php">Home</a>
            </div>

            <div class="nav-item">
                <a class="nav-link text-nowrap" href="../src/products.php">Products</a>
            </div>

            <div class="nav-item">
                <a class="nav-link text-nowrap" href="../src/about_us.php">About Us</a>
            </div>

            <div class="nav-item dropdown">
                <a class="nav-link text-nowrap dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Customer Support
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="../src/faq.php">FAQ</a>
                    <a class="dropdown-item" href="../src/contact_us.php">Contact Us</a>
                    <a class="dropdown-item" href="../src/shipping_returns.php">Shipping & Returns</a>
                </div>
            </div>

            <div class="nav-item">
                <a class="nav-link text-nowrap" href="https://gehlj.myweb.cs.uwindsor.ca/COMP-3340-W22/">Gallery</a>
            </div>
        </div>

        <div class="nav-item w-100 justify-content-center col-md-4 d-none d-md-block">
            <form class="d-flex">
                <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-primary text-nowrap" type="submit">Search</button>
            </form>
        </div>

        <div class="navbar-nav w-100 justify-content-end col-md-1">
            <div class="nav-item">
                <a class="nav-link text-nowrap" href="./login.php">Log in</a>
            </div>
        </div>

        <div class="nav-item w-100 justify-content-center col-md-4 d-sm-block d-md-none">
            <form class="d-flex">
                <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-primary text-nowrap" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
</body>
</html>