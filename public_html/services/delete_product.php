<?php
include_once("../static/config.php");

$data = json_decode(file_get_contents('php://input'), true);

// The pk field arrives in the format "product-<id>", so we need to extract id
$row_id = $data['pk'];
$id = substr($row_id, strpos($row_id, "-") + 1);

// create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM PRODUCT WHERE id = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->close();
$conn->close();

echo "Deleted product " . $id . " from product table.";
