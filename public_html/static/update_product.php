<?php
include_once("config.php");

$data = json_decode(file_get_contents('php://input'), true);

// The pk field arrives in the format "product-<id>", so we need to extract id
$row_id = $data['pk'];
$id = substr($row_id, strpos($row_id, "-") + 1);

$name = $data['product_name'];
$description = $data['description'];
$image_url = $data['image_url'];
$price = $data['price'];

// create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Build the SQL query based on the fields that need to be updated
$first_param_found = false;
$sql = "UPDATE PRODUCT SET ";
$types = "";
$params = array();

if (isset($name)) {
    $sql .= "name = ?";
    $types .= "s";
    $params[] = $name;
    $first_param_found = true;
}
if (isset($description)) {
    if ($first_param_found) $sql .= ", ";
    $sql .= "description = ?";
    $types .= "s";
    $params[] = $description;
    $first_param_found = true;
}
if (isset($image_url)) {
    if ($first_param_found) $sql .= ", ";
    $sql .= "imageURL = ?";
    $types .= "s";
    $params[] = $image_url;
    $first_param_found = true;
}
if (isset($price)) {
    if ($first_param_found) $sql .= ", ";
    $sql .= "price = ?";
    $types .= "d";
    $params[] = $price;
}

$sql .= " WHERE id = ?;";
$types .= "i";
$params[] = $id;

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();

$stmt->close();
$conn->close();

echo "Updated product " . $id . ".";
