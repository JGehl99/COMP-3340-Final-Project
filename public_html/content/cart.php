<!doctype html>
<html lang="en">

<head>
    <?php
    $title = 'Shopping Cart';
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

$sql = "SELECT username, productID, quantity FROM CART_ITEM";
$items = $conn->query($sql)->fetch_all();
$conn->close();
?>

<body>
<?php include('navbar.php'); ?>
<div class="container d-flex justify-content-center pb-5">
    <?php
    // Generating the product cards
    if (count($items) > 0) { ?>
    <div class="row">
        <?php
        foreach ($items as $item) {
            // Retrieve attributes from $product
            [$username, $productID, $quantity] = $item;

            // Create the card for the item ?>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 pt-5">
                <a href="#" class="card h-100 hover_expand text-decoration-none background text-color product-link"
                   item-id="<?php echo $productID; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $username; ?></h5>
                        <div class="d-flex justify-content-between">
                            <h6 class="card-subtitle text-success my-2">$<?php echo $productID; ?></h6>
                        </div>
                    </div>
                    <div class="me-3 mb-3">
                        <div class="d-flex justify-content-end">
                            <div class="input-group" data-no-link style="width: 9rem;">
                                <button type="button" class="btn btn-secondary d-flex align-items-center decrease-amt"
                                        data-field="<?php echo $productID; ?>">
                                    <img class="add_icon" src="../static/sub_black.svg" alt="Decrease Quantity"/>
                                </button>
                                <input type="text" id="<?php echo $productID; ?>-amt" class="form-control amt"
                                       value="<?php echo $quantity; ?>"
                                       min="0" max="100"/>
                                <button type="button" class="btn btn-secondary d-flex align-items-center increase-amt"
                                        data-field="<?php echo $productID; ?>">
                                    <img class="sub_icon" src="../static/add_black.svg" alt="Increase Quantity"/>
                                </button>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php }
        } ?>
    </div>
</div>
<?php include('footer.php'); ?>
</body>

</html>