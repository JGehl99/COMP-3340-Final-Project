<!doctype html>
<html lang="en">

<head>
    <?php
    $title = 'Admin Homepage';
    include('headers.php');

    //    if (!isLoggedIn() || !isAdminUser()) {
    //        header("Location: /content/index.php");
    //    }
    ?>
</head>

<?php
//create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_SESSION["username"];
if (empty($username)) {
    die("No username found.");
}

$record_Count = 1;

$shipping_sql = "SELECT street_num, street_name, province, postal_code, country, city FROM SHIPPING_INFO WHERE username=?;";
$stmt = $conn->prepare(shipping_sql);
$stmt->bind_param("d", $username);
$stmt->execute();
$result = $stmt->get_result()->fetch_all();
$stmt->close();
$conn->close();
?>

<body class="page-background">
<?php include('navbar.php'); ?>
<div class="container my-5">
    <div class="row mb-5">
        <h1 class="text-color">User Account</h1>
        <div class="accordion" id="accordion">
            <div class="accordion-item background border border-secondary border-bottom-0">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed background" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne"
                            aria-expanded="true" aria-controls="collapseOne">
                        Shipping Info
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                     data-bs-parent="#accordion">
                    <div class="accordion-body text-color">
                        <h2>Manage Shipping Infos</h2>
                        <?php if (count($result) > 0) { ?>
                            <table class="table text-color">
                                <thead>
                                <tr>
                                    <th scope="col">Street Number</th>
                                    <th scope="col">Street Name</th>
                                    <th scope="col">Province</th>
                                    <th scope="col">Postal Code</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">City</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                while($record_Count <= count($result)) {
                                    [$street_num, $street_name, $province, $postal_code, $country, $city] = $result[$record_Count];
                                    $record_Count++;
                                    ?>
                                    <tr>
                                        <form action="user_homepage.php?username=<?php echo $username ?>">
                                            <td><input type="text" id="<?php echo $street_num; ?>"
                                                       class="form-control username" value="<?php echo $street_num; ?>"
                                                       readonly/></td>
                                            <td><input type="text" id="<?php echo $street_name; ?>"
                                                       class="form-control password" value="<?php echo $street_name; ?>"
                                                       readonly/></td>
                                            <td><input type="text" id="<?php echo $province; ?>"
                                                       class="form-control created-on"
                                                       value="<?php echo $province; ?>"
                                                       readonly/></td>
                                            <td><input type="text" id="<?php echo $postal_code; ?>"
                                                       class="form-control account-type" value="<?php echo $postal_code; ?>"
                                                       readonly/></td>
                                            <td><input type="text" id="<?php echo $country; ?>"
                                                       class="form-control account-type" value="<?php echo $country; ?>"
                                                       readonly/></td>
                                            <td><input type="text" id="<?php echo $city; ?>"
                                                       class="form-control account-type" value="<?php echo $city; ?>"
                                                       readonly/></td>
                                            <td>
                                                <button type="button" class="btn-empty"><img
                                                            src="../static/close_black_24dp.svg"
                                                            alt="Delete Account"/></button>
                                                <button type="button" class="btn-empty"><img
                                                            src="../static/mode_edit_black_24dp.svg"
                                                            alt="Edit Account"/></button>
                                                <button type="submit" class="btn-empty"><img
                                                            src="../static/check_black_24dp.svg"
                                                            alt="Confirm Edit"/></button>
                                            </td>
                                        </form>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        <?php } else { ?>
                            <p class="text-color">No shipping records found. Please create one below.</p>
                            <table class="table text-color">
                                <thead>
                                <tr>
                                    <th scope="col">Street Number</th>
                                    <th scope="col">Street Name</th>
                                    <th scope="col">Province</th>
                                    <th scope="col">Postal Code</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">City</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    [$street_num, $street_name, $province, $postal_code, $country, $city] = $result[0];
                                    ?>
                                    <tr>
                                        <form action="user_homepage.php?username=<?php echo $username ?>">
                                            <td><input type="text" id="<?php echo $street_num; ?>"
                                                       class="form-control username" value="<?php echo $street_num; ?>"
                                                       readonly/></td>
                                            <td><input type="text" id="<?php echo $street_name; ?>"
                                                       class="form-control password" value="<?php echo $street_name; ?>"
                                                       readonly/></td>
                                            <td><input type="text" id="<?php echo $province; ?>"
                                                       class="form-control created-on"
                                                       value="<?php echo $province; ?>"
                                                       readonly/></td>
                                            <td><input type="text" id="<?php echo $postal_code; ?>"
                                                       class="form-control account-type" value="<?php echo $postal_code; ?>"
                                                       readonly/></td>
                                            <td><input type="text" id="<?php echo $country; ?>"
                                                       class="form-control account-type" value="<?php echo $country; ?>"
                                                       readonly/></td>
                                            <td><input type="text" id="<?php echo $city; ?>"
                                                       class="form-control account-type" value="<?php echo $city; ?>"
                                                       readonly/></td>
                                            <td>
                                                <button type="button" class="btn-empty"><img
                                                            src="../static/close_black_24dp.svg"
                                                            alt="Delete Account"/></button>
                                                <button type="button" class="btn-empty"><img
                                                            src="../static/mode_edit_black_24dp.svg"
                                                            alt="Edit Account"/></button>
                                                <button type="submit" class="btn-empty"><img
                                                            src="../static/check_black_24dp.svg"
                                                            alt="Confirm Edit"/></button>
                                            </td>
                                        </form>
                                    </tr>
                                </tbody>
                            </table>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="accordion-item background border border-secondary">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed background" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Billing Info
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                     data-bs-parent="#accordion">
                    <div class="accordion-body text-color">
                        <h2>Manage Billing Info</h2>
                        <table class="table text-color">
                            <thead>
                            <tr>
                                <th scope="col">Card Number</th>
                                <th scope="col">Name on Card</th>
                                <th scope="col">Expiry Date</th>
                                <th scope="col">CVV</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php include('footer.php'); ?>
</body>

</html>
