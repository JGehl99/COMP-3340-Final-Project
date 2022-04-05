<?php
include_once("../static/config.php");

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

// Check to see if product already exists in cart
$sql = "SELECT quantity FROM CART_ITEM WHERE username=? AND productID=?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $username, $product_id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$cur_quantity = $result->fetch_assoc()['quantity'];

$response = new stdClass();
$response->quantity_cap = false;

if (!empty($cur_quantity)) {
//if product is already in cart
    $quantity_result = $cur_quantity + $quantity;
    if ($quantity_result > 100) {
        $quantity_result = 100;
        $response->quantity_cap = true;
    }
    $sql = "UPDATE CART_ITEM SET quantity=? WHERE username=? AND productID=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isi", $quantity_result, $username, $product_id);
} else {
//if product is not already in cart
    $sql = "INSERT INTO CART_ITEM (username, productID, quantity) VALUES (?, ?, ?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $username, $product_id, $quantity);
}
$stmt->execute();
$stmt->close();
$conn->close();

echo json_encode($response);