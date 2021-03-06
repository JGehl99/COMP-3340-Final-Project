<?php
include_once("../static/config.php");

$data = json_decode(file_get_contents('php://input'), true);

$street_num = $data['street_num'];
$street_name = $data['street_name'];
$city = $data['city'];
$province = $data['province'];
$postal_code = $data['postal_code'];
$username = $data['username'];

// create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Constructs an empty object to use for the JSON responses
$response = new stdClass();

// Check that all the fields are not empty
if (!isset($street_num) || !isset($street_name) || !isset($city) || !isset($province) || !isset($postal_code) || !isset($username)) {
    $response->error = 'missing field';
    echo json_encode($response);
    exit();
}

$sql = 'INSERT INTO SHIPPING_INFO (street_num, street_name, city, province, postal_code, username) VALUES (?, ?, ?, ?, ?, ?);';

$stmt = $conn->prepare($sql);
$stmt->bind_param('ssssss', $street_num, $street_name, $city, $province, $postal_code, $username);
$stmt->execute();

$id = $stmt->insert_id;
$response_id_str = 'shipping-' . $id;

$stmt->close();
$conn->close();

$response->id = $response_id_str;
echo json_encode($response);
