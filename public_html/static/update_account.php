<?php
include_once("config.php");

$data = json_decode(file_get_contents('php://input'), true);

$old_username = $data['old_username'];
$username = $data['username'];
$password = $data['password'];
$created_on = $data['created_on'];
$account_type = $data['account_type'];

// create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Build the SQL query based on the fields that need to be updated
$first_param_found = false;
$sql = "UPDATE ACCOUNT SET ";
$types = "";
$data = array();

if (!empty($username)) {
    $sql .= "username = ?";
    $types .= "s";
    $data[] = $username;
    $first_param_found = true;
}
if (!empty($password)) {
    if ($first_param_found) $sql .= ", ";
    $sql .= "password = ?";
    $types .= "s";
    $data[] = $password;
    $first_param_found = true;
}
if (!empty($created_on)) {
    if ($first_param_found) $sql .= ", ";
    $sql .= "created_on = ?";
    $types .= "s";
    $data[] = $created_on;
    $first_param_found = true;
}
if (!empty($account_type)) {
    if ($first_param_found) $sql .= ", ";
    $sql .= "type = ?";
    $types .= "i";
    $data[] = $account_type;
}

$types .= "s";
$data[] = $old_username;

$sql .= " WHERE username = ?;";

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$data);
$stmt->execute();

$stmt->close();
$conn->close();

echo "Updated " . $old_username . " account.";
