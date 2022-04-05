<!doctype html>
<html lang="en">

<head>
    <?php
    $title = 'Index';
    include('headers.php');
    ?>
</head>

<?php
// create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, description, imageURL, price, rating, numRatings FROM PRODUCT ORDER BY RAND() LIMIT 3";

$products = $conn->query($sql)->fetch_all();
$conn->close();
?>

<body class="page-background">
<?php include('navbar.php'); ?>
<div class="page-background min_height pt-5">
    <div class="container col-12">
        <div class="row d-flex justify-content-center pb-5 align-items-center">
            <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card background text-color rounded-5 shadow">
                    <div class="card-body p-3 text-center">
                        <h1 class="text-nowrap">Welcome to OldChicken!</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="rounded rounded-3 col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 col-xxl-10">
                <div id="carousel" class="carousel slide shadow" data-bs-ride="carousel">
                    <div class="carousel-inner rounded rounded-3">
                        <div class="carousel-item active" data-bs-interval="3000">
                            <img src="../static/carousel/c1.jpg"
                                 class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="3000">
                            <img src="../static/carousel/c2.jpg"
                                 class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="3000">
                            <img src="../static/carousel/c3.jpg"
                                 class="d-block w-100" alt="...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center pb-5 align-items-center mt-5">
            <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card background text-color rounded-5 shadow">
                    <div class="card-body p-3 text-center">
                        <h1 class="text-nowrap">Products</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
<script src="../js/products-cart-quantity.js"></script>
</body>
</html>