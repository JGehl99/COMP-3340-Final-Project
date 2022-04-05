<?php
include_once("../static/config.php");

$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'];
$record_type = $data['record_type'];

// create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$response = new stdClass();

$sql = '';
if ($record_type === 2) {
    $sql = 'SELECT COUNT(*) AS count FROM SHIPPING_INFO WHERE username = ?;';
} else if ($record_type === 3) {
    $sql = 'SELECT COUNT(*) AS count FROM BILLING_INFO WHERE username = ?;';
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();

$results = $stmt->get_result()->fetch_assoc();

$stmt->close();
$conn->close();

$response->can_add = $results['count'] < 3;
echo json_encode($response);

