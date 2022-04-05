<?php
include_once("config.php");

$data = json_decode(file_get_contents('php://input'), true);

session_start();
$username = $_SESSION['username'];
$product_id = $data['pk'];

//create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);

//check connection
if ($conn->connect_error) {
    die("Connection failed: " + $conn->connect_error);
}

//if product is already in cart
$sql = "DELETE FROM CART_ITEM WHERE username=? AND productID=?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $username, $product_id);
$stmt->execute();
$stmt->close();

$response = new stdClass();
$response->empty = false;

$sql = "SELECT username FROM CART_ITEM WHERE username=?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$items = $stmt->get_result()->fetch_all();
$stmt->close();
if (count($items) === 0) {
    $response->empty = true;
}

$conn->close();

echo json_encode($response);
