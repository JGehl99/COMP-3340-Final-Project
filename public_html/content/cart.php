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
        <div class="col-12 p-2">
            <table class="table text-color">
                <thead>
                <tr>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($items as $item) {
                    // Retrieve attributes from $product
                    [$username, $productID, $quantity] = $item;
                    // Create the row for the item ?>
                    <tr>
                        <td>*Image here* *Product Name* <?php echo $productID; ?></td>
                        <td>*Price here*</td>
                        <td>
                            <div class="input-group" data-no-link style="width: 9rem;">
                                <button type="button" class="btn btn-secondary d-flex align-items-center decrease-amt"
                                        data-field="<?php echo $productID; ?>">
                                    <img class="sub_icon" src="../static/sub_black.svg" alt="Decrease Quantity"/>
                                </button>
                                <input type="text" id="<?php echo $productID; ?>-amt" class="form-control amt"
                                       value="<?php echo $quantity; ?>" data-field="<?php echo $productID; ?>"
                                       min="0" max="100"/>
                                <button type="button" class="btn btn-secondary d-flex align-items-center increase-amt"
                                        data-field="<?php echo $productID; ?>">
                                    <img class="add_icon" src="../static/add_black.svg" alt="Increase Quantity"/>
                                </button>
                            </div>
                        </td>
                        <td>*subtotal here*</td>
                    </tr>
                <?php }
                } ?>
                </tbody>
            </table>
        </div>
        <div class="col-6 p-2">
            <table class="table text-color">
                <thead>
                <tr>
                    <td>Cart Totals</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Subtotal</td>
                    <td>$111.22</td>
                </tr>
                <tr>
                    <td>Taxes</td>
                    <td>$13.00</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>$111.22</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-12 p-2">
            <button type="button" class="btn btn-primary d-flex align-items-center">Proceed To Checkout
            </button>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
<script src="../js/cart.js"></script>
</body>
</html>