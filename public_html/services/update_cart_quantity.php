<?php
include_once("config.php");

$data = json_decode(file_get_contents('php://input'), true);

session_start();
$username = $_SESSION['username'];
$product_id = $data['pk'];
$quantity = $data['quantity'];

//create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);

//check connection
if ($conn->connect_error) {
    die("Connection failed: " + $conn->connect_error);
}

// Check that all the fields are not empty
if (!isset($username) || !isset($product_id) || !isset($quantity)) {
    exit();
}

//if product is already in cart
$sql = "UPDATE CART_ITEM SET quantity=? WHERE username=? AND productID=?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isi", $quantity, $username, $product_id);
$stmt->execute();
$stmt->close();
$conn->close();

echo "There is now $quantity of product $product_id in cart.";