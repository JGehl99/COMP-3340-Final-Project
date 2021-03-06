<?php
include_once("../static/config.php");

$data = json_decode(file_get_contents('php://input'), true);

$old_username = $data['pk'];
$username = $data['username'];
$password = $data['password'];
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
$params = array();

if (isset($username)) {
    $sql .= "username = ?";
    $types .= "s";
    $params[] = $username;
    $first_param_found = true;
}
if (isset($password)) {
    if ($first_param_found) $sql .= ", ";
    $sql .= "password = ?";
    $types .= "s";
    $hashed_password = password_hash(trim($password), PASSWORD_DEFAULT);
    $params[] = $hashed_password;
    $first_param_found = true;
}
if (isset($account_type)) {
    if ($first_param_found) $sql .= ", ";
    $sql .= "type = ?";
    $types .= "i";
    $params[] = $account_type;
}

$sql .= " WHERE username = ?;";
$types .= "s";
$params[] = $old_username;

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();

$stmt->close();
$conn->close();

echo "Updated " . $old_username . " account.";
