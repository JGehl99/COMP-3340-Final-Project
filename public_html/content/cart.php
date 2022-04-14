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

session_start();
$username = $_SESSION['username'];
$sum = 0;

$sql = "SELECT productID, quantity FROM CART_ITEM WHERE username=?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$items = $stmt->get_result()->fetch_all();
$stmt->close();
?>

<body class="page-background" onbeforeunload="updateCart()">
<?php include('navbar.php'); ?>
<div class="container pt-3 page-background min_height">
    <?php
    // Generating the product cards
    if (count($items) > 0) { ?>
        <div id="cart" class="row d-flex h-100">
            <div class="col-12 overflow-auto">
                <table class="table text-color">
                    <thead>
                    <tr>
                        <td></td>
                        <td>Product</td>
                        <td class="d-none d-md-block"></td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Subtotal</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($items as $item) {
                        // Retrieve attributes from $product
                        [$productID, $quantity] = $item;
                        $sql = "SELECT name, imageURL, price FROM PRODUCT WHERE id=?;";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $productID);
                        $stmt->execute();
                        $result = $stmt->get_result()->fetch_assoc();
                        $stmt->close();
                        $name = $result['name'];
                        $imageURL = $result['imageURL'];
                        $price = $result['price'];
                        $subtotal = number_format($quantity * $price, 2);
                        $sum += $quantity * $price;
                        // Create the row for the item ?>
                        <tr id="<?php echo $productID; ?>-row" class="align-middle px-3">
                            <td>
                                <button type="button"
                                        class="btn btn-secondary d-flex align-items-center remove-item"
                                        data-field="<?php echo $productID; ?>">
                                    <img class="delete_icon" src="../static/close_black.svg" alt="Remove Item"/>
                                </button>
                            </td>
                            <td style="min-width: 200px" class="d-none d-md-block">
                                <a class="link-color text-decoration-none"
                                   href="https://oldchicken.myweb.cs.uwindsor.ca/content/product.php?item-id=<?php echo $productID; ?>">
                                    <img src="<?php echo $imageURL ?>" alt="<?php echo $name ?>"/>
                                </a>
                            </td>
                            <td style="min-width: 300px">
                                <a class="link-color text-decoration-none"
                                   href="https://oldchicken.myweb.cs.uwindsor.ca/content/product.php?item-id=<?php echo $productID; ?>"><?php echo $name; ?></a>
                            </td>
                            <td>$<?php echo number_format($price, 2); ?></td>
                            <td>
                                <div class="input-group" data-no-link style="width: 9rem;">
                                    <button type="button"
                                            class="btn btn-secondary d-flex align-items-center decrease-amt"
                                            data-field="<?php echo $productID; ?>">
                                        <img class="sub_icon" src="../static/sub_black.svg" alt="Decrease Quantity"/>
                                    </button>
                                    <input type="text" id="<?php echo $productID; ?>-amt" class="form-control amt"
                                           value="<?php echo $quantity; ?>" data-field="<?php echo $productID; ?>"
                                           aria-label="quantity"/>
                                    <button type="button"
                                            class="btn btn-secondary d-flex align-items-center increase-amt"
                                            data-field="<?php echo $productID; ?>">
                                        <img class="add_icon" src="../static/add_black.svg" alt="Increase Quantity"/>
                                    </button>
                                </div>
                            </td>
                            <td id="<?php echo $productID; ?>-subtotal" class="subtotal"
                                data-field="<?php echo $price; ?>">$<?php echo $subtotal; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-6 col-xl-6 p-2">
                <table class="table text-color">
                    <thead>
                    <tr>
                        <th>Cart Totals</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Subtotal</td>
                        <td id="subtotal">$<?php echo number_format($sum, 2); ?></td>
                    </tr>
                    <tr>
                        <td>Taxes</td>
                        <td id="taxes">$<?php echo number_format($sum * 0.13, 2); ?></td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td id="total">$<?php echo number_format($sum * 1.13, 2); ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12 p-2">
                <button id="checkout" type="button" class="btn btn-primary d-flex align-items-center">Proceed To
                    Checkout
                </button>
            </div>
        </div>
    <?php } else { ?>
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 mt-5">
                <div class="card background text-color rounded-5 shadow">
                    <div class="card-body p-3 text-center">
                        <h1>Your shopping cart is empty :(</h1>
                        <h6 class="card-subtitle text-success my-2">
                            Add products to your cart to shop with Old Chicken</h6>
                        <a class="btn btn-primary text-decoration-none"
                           href="products.php">View Products</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <div id="empty-cart" class="row d-flex justify-content-center align-items-center h-100 d-none">
        <div class="col-12 mt-5">
            <div class="card background text-color rounded-5 shadow">
                <div class="card-body p-3 text-center">
                    <h1>Your shopping cart is empty :(</h1>
                    <h6 class="card-subtitle text-success my-2">
                        Add products to your cart to shop with Old Chicken</h6>
                    <a class="btn btn-primary text-decoration-none"
                       href="products.php">View Products</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$conn->close();
include('footer.php');
?>
<script src="../js/cart.js"></script>
</body>
</html>