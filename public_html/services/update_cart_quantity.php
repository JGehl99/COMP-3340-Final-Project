<?php
include_once("../static/config.php");

$data = json_decode(file_get_contents('php://input'), true);

session_start();
$username = $_SESSION['username'];
$product_ids = $data['pks'];
$quantities = $data['quantities'];

//create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);

//check connection
if ($conn->connect_error) {
    die("Connection failed: " + $conn->connect_error);
}

// Check that all the fields are not empty
if (!isset($username) || !isset($product_ids) || !isset($quantities)) {
    exit();
}
for ($x = 0; $x < count($product_ids); $x++) {
    //if product is already in cart
    $sql = "UPDATE CART_ITEM SET quantity=? WHERE username=? AND productID=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isi", $quantities[$x], $username, $product_ids[$x]);
    $stmt->execute();
    $stmt->close();
}
$conn->close();

echo "Cart has been updated";