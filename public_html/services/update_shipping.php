<?php
include_once("../static/config.php");

$data = json_decode(file_get_contents('php://input'), true);

// The pk field arrives in the format "product-<id>", so we need to extract id
$row_id = $data['pk'];
$id = substr($row_id, strpos($row_id, "-") + 1);

$street_num = $data['street_num'];
$street_name = $data['street_name'];
$city = $data['city'];
$province = $data['province'];
$postal_code = $data['postal_code'];

// create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Build the SQL query based on the fields that need to be updated
$first_param_found = false;
$sql = "UPDATE SHIPPING_INFO SET ";
$types = "";
$params = array();

if (isset($street_num)) {
    $sql .= "street_num = ?";
    $types .= "s";
    $params[] = $street_num;
    $first_param_found = true;
}
if (isset($street_name)) {
    if ($first_param_found) $sql .= ", ";
    $sql .= "street_name = ?";
    $types .= "s";
    $params[] = $street_name;
    $first_param_found = true;
}
if (isset($city)) {
    if ($first_param_found) $sql .= ", ";
    $sql .= "city = ?";
    $types .= "s";
    $params[] = $city;
    $first_param_found = true;
}
if (isset($province)) {
    if ($first_param_found) $sql .= ", ";
    $sql .= "province = ?";
    $types .= "s";
    $params[] = $province;
    $first_param_found = true;
}
if (isset($postal_code)) {
    if ($first_param_found) $sql .= ", ";
    $sql .= "postal_code = ?";
    $types .= "s";
    $params[] = $postal_code;
}

$sql .= " WHERE id = ?;";
$types .= "i";
$params[] = $id;

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();

$stmt->close();
$conn->close();

echo "Updated shipping info record " . $id . ".";
