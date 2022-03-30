<!doctype html>
<html lang="en">

<head>
    <?php
    $title = 'Product';
    include('../content/headers.php');
    ?>
</head>


<?php
// create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$item_id = $_GET["item-id"];
if (empty($item_id)) {
    die("Invalid item ID");
}

$sql = "SELECT id, name, description, imageURL, price, rating, numRatings FROM PRODUCT WHERE id =?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("d", $item_id);
$stmt->execute();
$result = $stmt->get_result()->fetch_all();
$stmt->close();
$conn->close();
?>

<body class="bg-white">
<?php include('../content/navbar.php'); ?>
<div class="container text-wrap py-5">
    <?php
    // Generating the product card
    if (count($result) === 1) {
        // Retrieve attributes from $result[0]
        [$id, $name, $description, $imageURL, $price, $rating, $numRatings] = $result[0];

        // Get an array of description items
        $description_items = explode(",", $description);
        // $row["description"] ends in a comma, so remove the last empty element from the array
        array_pop($description_items);

        // Create the product cards ?>
        <div class="row">
            <div class="col-12 col-lg-4 mb-4">
                <div class="card bg-light">
                    <div class="card-body">
                        <img src="<?php echo $imageURL ?>" alt="<?php echo $name ?>" class="w-100"/>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card bg-light">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm">
                                <h4 class="card-title text-dark"><?php echo $name ?></h4>
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


                                    <h6 class="card-subtitle text-muted d-inline-block"><?php echo $numRatings ?></h6>
                                </div>
                            </div>
                            <span class="d-none d-sm-block col-1"></span>
                            <div class="col col-sm-4 col-md-3 col-lg-4 col-xl-3">
                                <h4 class="text-success text-end">$<?php echo $price ?></h4>
                                <div class="d-flex justify-content-end mb-2">
                                    <div class="input-group" style="width: 9rem;">
                                        <button type="button" class="btn btn-secondary d-flex align-items-center"
                                                id="decrease-amt">
                                            <img src="../static/dash-lg.svg" alt="Decrease Quantity"/>
                                        </button>
                                        <input type="text" id="item-amt" class="form-control amt" value="0" min="0"
                                               max="100"/>
                                        <button type="button" class="btn btn-secondary d-flex align-items-center"
                                                id="increase-amt">
                                            <img src="../static/plus-lg.svg" alt="Increase Quantity"/>
                                        </button>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-primary d-flex align-items-center"
                                            id="add-to-cart"
                                            data-field="<?php echo $id ?>">
                                        <img src="../static/cart.svg" alt="Add To Cart"/>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div>
                            <ul class="card-text mt-2">
                                <?php
                                // Add the bullet points for the description
                                foreach ($description_items as $description_item) { ?>
                                    <li class="text-dark"><?php echo $description_item ?></li>
                                <?php } ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>
</div>
<?php include('../content/footer.php'); ?>
<script src="../js/product-cart-quantity.js"></script>
</body>
</html>
