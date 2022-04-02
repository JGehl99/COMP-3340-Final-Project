<?php
include_once("config.php");

$data = json_decode(file_get_contents('php://input'), true);

$username = $_SESSION['username'];
$product_id = $data['pk'];
$quantity = $data['quantity'];

//create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);

//check connection
if ($conn->connect_error) {
    die("Connection failed: " + $conn->connect_error);
}

// Check to see if product already exists in cart
$sql = "SELECT quantity FROM CART_ITEM WHERE username=? AND productID=?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $username, $product_id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

if (!empty($result->fetch_assoc()['quantity'])) {
    //if product is already in cart
    $sql = "UPDATE CART_ITEM SET quantity=? WHERE username=? AND productID=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isi", $quantity, $username, $product_id);
} else {
    //if product is not already in cart
    $sql = "INSERT INTO CART_ITEM (username, productID, quantity) VALUES (?, ?, ?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $username, $product_id, $quantity);
}
$stmt->execute();
$stmt->close();
$conn->close();

echo "Added $quantity of product $product_id to cart.";