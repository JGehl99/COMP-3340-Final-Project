<?php
include_once("config.php");

$data = json_decode(file_get_contents('php://input'), true);

$username = $data['username'];
$password = $data['password'];
$account_type = $data['account_type'];
$date = date("Y-m-d h:i:s");

// create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Constructs an empty object to use for the JSON responses
$response = new stdClass();

// Check that all the fields are not empty
if (!isset($username) || !isset($password) || !isset($account_type)) {
    $response->error = 'missing field';
    echo json_encode($response);
    exit();
}

$sql = 'INSERT INTO ACCOUNT (username, password, created_on, type) VALUES (?, ?, ?, ?);';

$stmt = $conn->prepare($sql);
$hashed_password = password_hash(trim($password), PASSWORD_DEFAULT);
$stmt->bind_param('sssi', $username, $hashed_password, $date, $account_type);
$stmt->execute();

$stmt->close();
$conn->close();

$response->id = $username;
echo json_encode($response);
