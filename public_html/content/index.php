<!doctype html>
<html lang="en">

<head>
    <?php
    $title = 'OldChicken - Computer Parts & PC Components';
    include('headers.php');
    ?>
    <meta name="title" content="OldChicken - Homepage">
    <meta name="description"
          content="Welcome to OldChicken! Shopping with OldChicken gives you access to great deals on a wide range of computer parts and PC components.">
    <meta name="keywords"
          content="old chicken,e-commerce,computer,graphics card,gpu,pc,desktop,gaming,computer parts,components">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
</head>

<?php
// create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, description, imageURL, price, rating, numRatings FROM PRODUCT ORDER BY RAND() LIMIT 4";

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
        <div class="row">
            <?php
            foreach ($products as $product) {
                // Retrieve attributes from $product
                [$id, $name, $description, $imageURL, $price, $rating, $numRatings] = $product;

                // Get an array of description items
                $description_items = explode(",", $description);
                // $row["description"] ends in a comma, so remove the last empty element from the array
                array_pop($description_items);

                // Create the card for the item ?>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-3 pt-5">
                    <div
                            class="card h-100 hover_expand cursor_pointer text-decoration-none background text-color product-link shadow"
                            data-item-id="<?php echo $id; ?>">
                        <img class="card-img-top p-4" src="<?php echo $imageURL; ?>" alt="<?php echo $name; ?>"/>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $name; ?></h5>
                            <div class="d-flex justify-content-between">
                                <h6 class="card-subtitle text-success my-2">$<?php echo $price; ?></h6>
                                <div>
                                    <?php
                                    // Create the chicken icons to display the star rating
                                    $num_stars = get_star_rating($rating);
                                    for ($i = 0; $i < (int)$num_stars; ++$i) { ?>
                                        <img src="../static/icon.svg" alt="OldChicken Icon"
                                             style="height:16px;width:16px;"/>
                                    <?php }

                                    if (!is_int($num_stars)) { ?>
                                        <img src="../static/icon_half.svg" alt="OldChicken Icon"
                                             style="height:16px;width:16px;"/>
                                    <?php } ?>

                                    <h6 class="card-subtitle text-muted my-2 d-inline-block"><?php echo $numRatings; ?></h6>
                                </div>
                            </div>
                            <ul class="card-text">

                                <?php
                                // Add the bullet points for the description
                                foreach ($description_items as $item) { ?>
                                    <li class="text-color"><?php echo $item; ?></li>
                                <?php } ?>

                            </ul>
                        </div>
                        <div class="me-3 mb-3">
                            <div class="d-flex justify-content-end">
                                <div class="input-group" data-no-link style="width: 9rem;">
                                    <button type="button"
                                            class="btn btn-secondary d-flex align-items-center decrease-amt"
                                            data-field="<?php echo $id; ?>">
                                        <img class="sub_icon" src="../static/sub_black.svg" alt="Decrease Quantity"/>
                                    </button>
                                    <input type="text" id="<?php echo $id; ?>-amt" class="form-control amt" value="0"
                                           aria-label="quantity"/>
                                    <button type="button"
                                            class="btn btn-secondary d-flex align-items-center increase-amt"
                                            data-field="<?php echo $id; ?>">
                                        <img class="add_icon" src="../static/add_black.svg" alt="Increase Quantity"/>
                                    </button>
                                </div>
                                <span class="mx-2"></span>
                                <button type="button" class="btn btn-primary d-flex align-items-center add-to-cart"
                                        data-no-link data-field="<?php echo $id; ?>">
                                    <img class="cart_icon" src="../static/add_cart_black.svg" alt="Add To Cart"/>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="row d-flex justify-content-center pb-5 align-items-center mt-5">
            <div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <div class="card background text-color rounded-5 shadow">
                    <div class="card-body p-3 text-center">
                        <a href="products.php" class="text-nowrap link-color">Load more...</a>
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