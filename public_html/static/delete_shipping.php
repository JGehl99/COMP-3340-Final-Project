<?php
include_once("config.php");

$data = json_decode(file_get_contents('php://input'), true);

$username = $data['pk'];

// create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM SHIPPING_INFO WHERE username = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $username);
$stmt->execute();

$stmt->close();
$conn->close();

echo "Deleted shipping address from your account.";
