<?php
include_once("../static/config.php");

$data = json_decode(file_get_contents('php://input'), true);

$name = $data['product_name'];
$description = $data['description'];
$imageURL = $data['image_url'];
$price = $data['price'];

// create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Constructs an empty object to use for the JSON responses
$response = new stdClass();

// Check that all the fields are not empty
if (!isset($name) || !isset($description) || !isset($imageURL) || !isset($price)) {
    $response->error = 'missing field';
    echo json_encode($response);
    exit();
}

$sql = 'INSERT INTO PRODUCT (name, description, imageURL, price) VALUES (?, ?, ?, ?);';

$stmt = $conn->prepare($sql);
$stmt->bind_param('sssd', $name, $description, $imageURL, $price);
$stmt->execute();

$last_id = $stmt->insert_id;
$response_id_str = 'product-' . $last_id;

$stmt->close();
$conn->close();

$response->id = $response_id_str;
echo json_encode($response);
