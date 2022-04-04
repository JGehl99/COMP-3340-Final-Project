<?php
include_once("config.php");

$data = json_decode(file_get_contents('php://input'), true);

$card_num = $data['card_num'];
$card_name = $data['card_name'];
$exp_date = $data['exp_date'];
$cvv = $data['cvve'];


// create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Constructs an empty object to use for the JSON responses
$response = new stdClass();


// Check that all the fields are not empty
if (!isset($card_num) || !isset($card_name) || !isset($exp_date) || !isset($cvv)) {
    $response->error = 'missing field';
    echo json_encode($response);
    exit();
}

$sql = 'INSERT INTO BILLING_INFO (card_num, card_name, exp_date, cvv) VALUES (?, ?, ?, ?);';

$stmt = $conn->prepare($sql);
$stmt->bind_param('ssss', $card_num, $card_name, $exp_date, $cvv);
$stmt->execute();

$stmt->close();
$conn->close();

$id = $stmt->insert_id;
$response_id_str = 'billing-info-' . $id;

$response->id = $response_id_str;
echo json_encode($response);
