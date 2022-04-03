<!doctype html>
<html lang="en">

<head>
    <?php
    $title = 'User Homepage';
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

$username = $_SESSION['username'];
if (empty($username)) {
    die("No username found.");
}

$shipping_sql = "SELECT id, street_num, street_name, city, province, postal_code FROM SHIPPING_INFO WHERE username=?;";
$billing_sql = "SELECT id, card_num, card_name, exp_date, cvv FROM BILLING_INFO WHERE username=?;";

$stmt = $conn->prepare($shipping_sql);
$stmt->bind_param("s", $username);
$stmt->execute();

$result_Shipping = $stmt->get_result()->fetch_all();

$stmt2 = $conn->prepare($billing_sql);
$stmt2->bind_param("s", $username);
$stmt2->execute();

$result_Billing = $stmt2->get_result()->fetch_all();

$stmt->close();
$stmt2->close();
$conn->close();
?>

<body class="page-background">
<?php include('navbar.php'); ?>
<div class="container my-5 min_height">
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
                        <?php if (count($result_Shipping) > 0) { ?>
                            <table class="table text-color">
                                <thead>
                                <tr>
                                    <th scope="col">Street Number</th>
                                    <th scope="col">Street Name</th>
                                    <th scope="col">City</th>
                                    <th scope="col">Province</th>
                                    <th scope="col">Postal Code</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($result_Shipping as $resultS) {
                                    [$id, $street_num, $street_name, $city, $province, $postal_code] = $resultS;
                                    ?>
                                    <tr>
                                        <form action="user_homepage.php?username=<?php echo $username ?>">
                                            <td><input type="text" id="<?php echo $street_num; ?>"
                                                       class="form-control street_num" value="<?php echo $street_num; ?>"
                                                       readonly/></td>
                                            <td><input type="text" id="<?php echo $street_name; ?>"
                                                       class="form-control street_name" value="<?php echo $street_name; ?>"
                                                       readonly/></td>
                                            <td><input type="text" id="<?php echo $city; ?>"
                                                       class="form-control city" value="<?php echo $city; ?>"
                                                       readonly/></td>
                                            <td><input type="text" id="<?php echo $province; ?>"
                                                       class="form-control province"
                                                       value="<?php echo $province; ?>"
                                                       readonly/></td>
                                            <td><input type="text" id="<?php echo $postal_code; ?>"
                                                       class="form-control postal_code" value="<?php echo $postal_code; ?>"
                                                       readonly/></td>
                                            <td>
                                                <button type="button" class="btn-empty"><img
                                                            src="../static/close_black_24dp.svg"
                                                            alt="Delete Record"/></button>
                                                <button type="button" class="btn-empty"><img
                                                            src="../static/mode_edit_black_24dp.svg"
                                                            alt="Edit Record"/></button>
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
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="accordion-item background border border-secondary border-bottom-0">
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
                        <?php if (count($result_Billing) > 0) { ?>
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
                                <tbody>
                                <?php
                                foreach ($result_Billing as $resultB) {
                                    [$id, $card_num, $card_name, $exp_date, $cvv] = $resultB;

                                    ?>
                                    <tr>
                                        <form action="user_homepage.php?username=<?php echo $username ?>">
                                            <td><input type="text" id="<?php echo $card_num; ?>"
                                                       class="form-control card_num" value="<?php echo $card_num; ?>"
                                                       readonly/></td>
                                            <td><input type="text" id="<?php echo $card_name; ?>"
                                                       class="form-control card_name" value="<?php echo $card_name; ?>"
                                                       readonly/></td>
                                            <td><input type="text" id="<?php echo $exp_date; ?>"
                                                       class="form-control exp_date"
                                                       value="<?php echo $exp_date; ?>"
                                                       readonly/></td>
                                            <td><input type="text" id="<?php echo $cvv; ?>"
                                                       class="form-control cvv" value="<?php echo $cvv; ?>"
                                                       readonly/></td>
                                            <td>
                                                <button type="button" class="btn-empty"><img
                                                            src="../static/close_black_24dp.svg"
                                                            alt="Delete Record"/></button>
                                                <button type="button" class="btn-empty"><img
                                                            src="../static/mode_edit_black_24dp.svg"
                                                            alt="Edit Record"/></button>
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
                            <p class="text-color">No billing records found. Please create one below.</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="accordion-item background border border-secondary">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed background" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Documentation
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                     data-bs-parent="#accordion">
                    <div class="accordion-body text-color">
                        <h2>Shipping</h2>
                        <p>Expand the first dropdown to manage saved shipping addresses.</p>
                        <h3>Adding a Shipping Record</h3>
                        <p>To add a shipping address click the Create Record button. Make sure to enter all fields for the address and then click the check mark
                            button to save the record. See the "Field Constraints" section below for input validation details.
                        </p>
                        <h3>Modifying a Shipping Record</h3>
                        <p>To modify an existing address, click the pencil button for the desired address to allow editing. Change the fields that need to be changed
                            and then click the check mark button to accept the changes. Note: Not all fields need to be changed but at least one must be changed in order
                            to confirm the edit. See the "Field Constraints" section below for input validation details.
                        </p>
                        <h3>Deleting a Shipping Record</h3>
                        <p>To delete an existing address, click the X button on the desired address.</p>
                        <h3>Field Constraints</h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Field</th>
                                <th scope="col">Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Street Number</td>
                                <td>Non-negative integer</td>
                            </tr>
                            <tr>
                                <td>Street Name</td>
                                <td>Between 5 and 255 characters</td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>Between 3 and 255 characters</td>
                            </tr>

                            <tr>
                                <td>Province</td>
                                <td>Between 5 and 255 characters.</td>
                            </tr>
                            <tr>
                                <td>Postal Code</td>
                                <td>6 characters in length in the format: A1A 1A1</td>
                            </tr>
                            </tbody>
                        </table>
                        <h2>Billing</h2>
                        <p>Expand the second dropdown to manage saved billing records.</p>
                        <h3>Adding a Billing Record</h3>
                        <p>To add a billing record click the Create Record button. Make sure to enter all fields and then click the check mark
                            button to save the record. See the "Field Constraints" section below for input validation details.
                        </p>
                        <h3>Modifying a Billing Record</h3>
                        <p>To modify an existing record, click the pencil button for the desired record to allow editing. Change the fields that need to be changed
                            and then click the check mark button to accept the changes. Note: Not all fields need to be changed but at least one must be changed in order
                            to confirm the edit. See the "Field Constraints" section below for input validation details.
                        </p>
                        <h3>Deleting a Billing Record</h3>
                        <p>To delete an existing record, click the X button on the desired record.</p>
                        <h3>Field Constraints</h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Field</th>
                                <th scope="col">Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Card Number</td>
                                <td>Length of 16 digits.</td>
                            </tr>
                            <tr>
                                <td>Name on Card</td>
                                <td>Between 1 and 255 characters</td>
                            </tr>
                            <tr>
                                <td>Expiry Date</td>
                                <td>Format of MM/YY</td>
                            </tr>

                            <tr>
                                <td>CVV</td>
                                <td>3 characters in length, found on back of card.</td>
                            </tr>
                            </tbody>
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
