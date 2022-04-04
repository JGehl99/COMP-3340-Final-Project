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

<div class="row mb-5">
    <h1 class="text-color">User Account</h1>
    <div class="accordion" id="accordion">
        <div class="accordion-item background border border-secondary border-bottom-0">
            <h2 class="accordion-header" id="userHeadingOne">
                <button class="accordion-button collapsed background" type="button" data-bs-toggle="collapse"
                        data-bs-target="#userCollapseOne"
                        aria-expanded="true" aria-controls="userCollapseOne">
                    Shipping Info
                </button>
            </h2>
            <div id="userCollapseOne" class="accordion-collapse collapse" aria-labelledby="userHeadingOne"
                 data-bs-parent="#accordion">
                <div class="accordion-body text-color">
                    <h2>Manage Shipping Infos</h2>
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
                        <tbody id="shipping-tbody">
                        <?php
                        foreach ($result_Shipping as $resultS) {
                            [$id, $street_num, $street_name, $city, $province, $postal_code] = $resultS;
                            ?>
                            <tr id="shipping-<?php echo $id ?>">
                                <td>
                                    <input type="text"
                                           name="street_num"
                                           class="form-control"
                                           value="<?php echo $street_num; ?>"
                                           readonly/>
                                </td>
                                <td>
                                    <input type="text"
                                           name="street_name"
                                           class="form-control"
                                           value="<?php echo $street_name; ?>"
                                           readonly/>
                                </td>
                                <td>
                                    <input type="text"
                                           name="city"
                                           class="form-control"
                                           value="<?php echo $city; ?>"
                                           readonly/>
                                </td>
                                <td>
                                    <input type="text"
                                           name="province"
                                           class="form-control"
                                           value="<?php echo $province; ?>"
                                           readonly/>
                                </td>
                                <td>
                                    <input type="text"
                                           name="postal_code"
                                           class="form-control"
                                           value="<?php echo $postal_code; ?>"
                                           readonly/>
                                </td>
                                <td>
                                    <button type="button" class="btn-empty delete-record"
                                            onclick="deleteRecord('shipping-<?php echo $id ?>', 0)">
                                        <img src="../static/close_black.svg"
                                             alt="Delete Record"/>
                                    </button>
                                    <button type="button" class="btn-empty toggle-edit-record"
                                            onclick="toggleRecordEditable('shipping-<?php echo $id ?>')">
                                        <img src="../static/edit_black.svg"
                                             alt="Edit Record"/>
                                    </button>
                                    <button type="submit" class="btn-empty confirm-edit-record"
                                            onclick="confirmRecordEdit('shipping-<?php echo $id ?>', 0)">
                                        <img src="../static/check_black.svg"
                                             alt="Confirm Edit"/>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary ms-2" id="create-shipping-btn"
                            onclick="createNewShippingRow('<?php echo $username ?>')">
                        Add Shipping Info
                    </button>
                </div>
            </div>
        </div>
        <div class="accordion-item background border border-secondary border-bottom-0">
            <h2 class="accordion-header" id="userHeadingTwo">
                <button class="accordion-button collapsed background" type="button" data-bs-toggle="collapse"
                        data-bs-target="#userCollapseTwo" aria-expanded="false" aria-controls="userCollapseTwo">
                    Billing Info
                </button>
            </h2>
            <div id="userCollapseTwo" class="accordion-collapse collapse" aria-labelledby="userHeadingTwo"
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
                        <tbody id="billing-tbody">
                        <?php
                        foreach ($result_Billing as $resultB) {
                            [$id, $card_num, $card_name, $exp_date, $cvv] = $resultB;

                            ?>
                            <tr id="billing-<?php echo $id ?>">
                                <td>
                                    <input type="text"
                                           name="card_num"
                                           class="form-control"
                                           value="<?php echo $card_num; ?>"
                                           readonly/>
                                </td>
                                <td>
                                    <input type="text"
                                           name="card_name"
                                           class="form-control"
                                           value="<?php echo $card_name; ?>"
                                           readonly/>
                                </td>
                                <td>
                                    <input type="text"
                                           name="exp_date"
                                           class="form-control"
                                           value="<?php echo $exp_date; ?>"
                                           readonly/>
                                </td>
                                <td>
                                    <input type="text"
                                           name="cvv"
                                           class="form-control"
                                           value="<?php echo $cvv; ?>"
                                           readonly/>
                                </td>
                                <td>
                                    <button type="button" class="btn-empty delete-record"
                                            onclick="deleteRecord('billing-<?php echo $id ?>', 1)">
                                        <img src="../static/close_black.svg"
                                             alt="Delete Record"/>
                                    </button>
                                    <button type="button" class="btn-empty toggle-edit-record"
                                            onclick="toggleRecordEditable('billing-<?php echo $id ?>')">
                                        <img src="../static/edit_black.svg"
                                             alt="Edit Record"/>
                                    </button>
                                    <button type="submit" class="btn-empty confirm-edit-record"
                                            onclick="confirmRecordEdit('billing-<?php echo $id ?>', 1)">
                                        <img src="../static/check_black.svg"
                                             alt="Confirm Edit"/>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary ms-2" id="create-billing-btn"
                            onclick="createNewBillingRow('<?php echo $username ?>')">
                        Add Billing Info
                    </button>
                </div>
            </div>
        </div>
        <div class="accordion-item background border border-secondary">
            <h2 class="accordion-header" id="userHeadingThree">
                <button class="accordion-button collapsed background" type="button" data-bs-toggle="collapse"
                        data-bs-target="#userCollapseThree" aria-expanded="false" aria-controls="userCollapseThree">
                    Documentation
                </button>
            </h2>
            <div id="userCollapseThree" class="accordion-collapse collapse" aria-labelledby="userHeadingThree"
                 data-bs-parent="#accordion">
                <div class="accordion-body text-color">
                    <h2>Shipping</h2>
                    <p>Expand the first dropdown to manage saved shipping addresses.</p>
                    <h3>Adding a Shipping Record</h3>
                    <p>To add a shipping address click the Add Shipping button. Make sure to enter all fields for the
                        address and then click the check mark
                        button to save the record. See the "Field Constraints" section below for input validation
                        details.
                    </p>
                    <h3>Modifying a Shipping Record</h3>
                    <p>To modify an existing address, click the pencil button for the desired address to allow editing.
                        Change the fields that need to be changed
                        and then click the check mark button to accept the changes. Note: Not all fields need to be
                        changed but at least one must be changed in order
                        to confirm the edit. See the "Field Constraints" section below for input validation details.
                    </p>
                    <h3>Deleting a Shipping Record</h3>
                    <p>To delete an existing address, click the X button on the desired address.</p>
                    <h3>Field Constraints</h3>
                    <table class="table text-color">
                        <thead>
                        <tr>
                            <th scope="col">Field</th>
                            <th scope="col">Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Street Number</td>
                            <td>Between 1 and 255 characters</td>
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
                            <td>Between 5 and 255 characters</td>
                        </tr>
                        <tr>
                            <td>Postal Code</td>
                            <td>6 characters in length in the format: A1A 1A1 or A1A1A1</td>
                        </tr>
                        </tbody>
                    </table>
                    <h2>Billing</h2>
                    <p>Expand the second dropdown to manage saved billing records.</p>
                    <h3>Adding a Billing Record</h3>
                    <p>To add a billing record click the addShipping Info button. Make sure to enter all fields and then
                        click the check mark
                        button to save the record. See the "Field Constraints" section below for input validation
                        details.
                    </p>
                    <h3>Modifying a Billing Record</h3>
                    <p>To modify an existing record, click the pencil button for the desired record to allow editing.
                        Change the fields that need to be changed
                        and then click the check mark button to accept the changes. Note: Not all fields need to be
                        changed but at least one must be changed in order
                        to confirm the edit. See the "Field Constraints" section below for input validation details.
                    </p>
                    <h3>Deleting a Billing Record</h3>
                    <p>To delete an existing record, click the X button on the desired record.</p>
                    <h3>Field Constraints</h3>
                    <table class="table text-color">
                        <thead>
                        <tr>
                            <th scope="col">Field</th>
                            <th scope="col">Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Card Number</td>
                            <td>16 digits</td>
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
                            <td>3 digits</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

