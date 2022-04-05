<?php
include_once("../static/config.php");

$data = json_decode(file_get_contents('php://input'), true);

// The pk field arrives in the format "product-<id>", so we need to extract id
$row_id = $data['pk'];
$id = substr($row_id, strpos($row_id, "-") + 1);

$card_num = $data['card_num'];
$card_name = $data['card_name'];
$exp_date = $data['exp_date'];
$cvv = $data['cvv'];

// create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Build the SQL query based on the fields that need to be updated
$first_param_found = false;
$sql = "UPDATE BILLING_INFO SET ";
$types = "";
$params = array();

if (isset($card_num)) {
    $sql .= "card_num = ?";
    $types .= "s";
    $params[] = $card_num;
    $first_param_found = true;
}
if (isset($card_name)) {
    if ($first_param_found) $sql .= ", ";
    $sql .= "card_name = ?";
    $types .= "s";
    $params[] = $card_name;
    $first_param_found = true;
}
if (isset($exp_date)) {
    if ($first_param_found) $sql .= ", ";
    $sql .= "exp_date = ?";
    $types .= "s";
    $params[] = $exp_date;
    $first_param_found = true;
}
if (isset($cvv)) {
    if ($first_param_found) $sql .= ", ";
    $sql .= "cvv = ?";
    $types .= "s";
    $params[] = $cvv;
}

$sql .= " WHERE id = ?;";
$types .= "i";
$params[] = $id;

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();

$stmt->close();
$conn->close();

echo "Updated billing info record " . $id . ".";
