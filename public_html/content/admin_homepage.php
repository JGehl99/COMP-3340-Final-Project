<!doctype html>
<html lang="en">

<head>
    <?php
    $title = 'Admin Homepage';
    include('headers.php');

    if (!isLoggedIn() || !isAdminUser()) {
        header("Location: /content/index.php");
    }
    ?>
</head>

<?php
// create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$accounts_sql = "SELECT username, type FROM ACCOUNT;";
$accounts = $conn->query($accounts_sql)->fetch_all();

$products_sql = "SELECT id, name, description, imageURL, price FROM PRODUCT";
$products = $conn->query($products_sql)->fetch_all();

$conn->close();
?>

<body class="page-background">
<?php include('navbar.php'); ?>
<div class="container my-5 page-background">
    <div class="row mb-5">
        <h1 class="text-color">Administration</h1>
        <div class="accordion rounded-5" id="adminAccordion">
            <div class="accordion-item background card_border shadow">
                <h2 class="accordion-header" id="adminHeadingOne">
                    <button class="accordion-button collapsed background" type="button" data-bs-toggle="collapse"
                            data-bs-target="#adminCollapseOne"
                            aria-expanded="true" aria-controls="adminCollapseOne">
                        User Administration
                    </button>
                </h2>
                <div id="adminCollapseOne" class="accordion-collapse collapse shadow" aria-labelledby="adminHeadingOne"
                     data-bs-parent="#adminAccordion">
                    <div class="accordion-body text-color">
                        <h2>Manage Users</h2>
                        <table class="table text-color">
                            <thead>
                            <tr>
                                <th scope="col">Username</th>
                                <th scope="col">Change Password</th>
                                <th scope="col">Account Type</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody id="account-tbody">
                            <?php
                            foreach ($accounts as $account) {
                                [$username, $type] = $account;
                                ?>
                                <tr id="<?php echo $username ?>">
                                    <td>
                                        <input type="text"
                                               name="username"
                                               class="form-control"
                                               value="<?php echo $username; ?>"
                                               readonly/>
                                    </td>
                                    <td>
                                        <input type="text"
                                               name="password"
                                               class="form-control"
                                               value=""
                                               readonly/>
                                    </td>
                                    <td>
                                        <input type="text"
                                               name="account_type"
                                               class="form-control"
                                               value="<?php echo $type; ?>"
                                               readonly/>
                                    </td>
                                    <td>
                                        <button type="button" class="btn-empty delete-record"
                                                onclick="deleteRecord('<?php echo $username ?>', 0)">
                                            <img src="../static/close_black.svg"
                                                 alt="Delete Account"
                                                 class="delete_icon"/>
                                        </button>
                                        <button type="button" class="btn-empty toggle-edit-record"
                                                onclick="toggleRecordEditable('<?php echo $username ?>')">
                                            <img src="../static/edit_black.svg"
                                                 alt="Edit Account"
                                                 class="edit_icon"/>
                                        </button>
                                        <button type="button" class="btn-empty confirm-edit-record"
                                                onclick="confirmRecordEdit('<?php echo $username ?>', 0)">
                                            <img src="../static/check_black.svg"
                                                 alt="Confirm Edit"
                                                 class="confirm_icon"/>
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary ms-2" id="create-account-btn"
                                onclick="createNewAccountRow()">
                            Create Account
                        </button>
                    </div>
                </div>
            </div>
            <div class="accordion-item background card_border shadow">
                <h2 class="accordion-header" id="adminHeadingTwo">
                    <button class="accordion-button collapsed background" type="button" data-bs-toggle="collapse"
                            data-bs-target="#adminCollapseTwo" aria-expanded="false" aria-controls="adminCollapseTwo">
                        Product Administration
                    </button>
                </h2>
                <div id="adminCollapseTwo" class="accordion-collapse collapse shadow" aria-labelledby="adminHeadingTwo"
                     data-bs-parent="#adminAccordion">
                    <div class="accordion-body text-color">
                        <h2>Manage Products</h2>
                        <table class="table text-color">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Image URL</th>
                                <th scope="col">Price</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody id="product-tbody">
                            <?php
                            foreach ($products as $product) {
                                [$id, $name, $description, $imageURL, $price] = $product;
                                ?>
                                <tr id="product-<?php echo $id ?>">
                                    <td>
                                        <input type="text"
                                               name="product_name"
                                               class="form-control"
                                               value="<?php echo $name; ?>"
                                               readonly/>
                                    </td>
                                    <td>
                                        <input type="text"
                                               name="description"
                                               class="form-control"
                                               value="<?php echo $description; ?>"
                                               readonly/>
                                    </td>
                                    <td>
                                        <input type="text"
                                               name="image_url"
                                               class="form-control"
                                               value="<?php echo $imageURL; ?>"
                                               readonly/>
                                    </td>
                                    <td>
                                        <input type="text"
                                               name="price"
                                               class="form-control"
                                               value="<?php echo $price; ?>"
                                               readonly/>
                                    </td>
                                    <td>
                                        <button type="button" class="btn-empty delete-record"
                                                onclick="deleteRecord('product-<?php echo $id ?>', 1)">
                                            <img src="../static/close_black.svg"
                                                 alt="Delete Product"
                                                 class="delete_icon"/>
                                        </button>
                                        <button type="button" class="btn-empty toggle-edit-record"
                                                onclick="toggleRecordEditable('product-<?php echo $id ?>')">
                                            <img src="../static/edit_black.svg"
                                                 alt="Edit Product"
                                                 class="edit_icon"/>
                                        </button>
                                        <button type="submit" class="btn-empty confirm-edit-record"
                                                onclick="confirmRecordEdit('product-<?php echo $id ?>', 1)">
                                            <img src="../static/check_black.svg"
                                                 alt="Confirm Edit"
                                                 class="confirm_icon"/>
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary ms-2" id="create-product-btn"
                                onclick="createNewProductRow()">
                            Create Product
                        </button>
                    </div>
                </div>
            </div>
            <div class="accordion-item background card_border shadow">
                <h2 class="accordion-header" id="adminHeadingThree">
                    <button class="accordion-button collapsed background" type="button" data-bs-toggle="collapse"
                            data-bs-target="#adminCollapseThree" aria-expanded="false"
                            aria-controls="adminCollapseThree">
                        Documentation
                    </button>
                </h2>
                <div id="adminCollapseThree" class="accordion-collapse collapse shadow"
                     aria-labelledby="adminHeadingThree"
                     data-bs-parent="#adminAccordion">
                    <div class="accordion-body text-color">
                        <h2>User Administration</h2>
                        <p>Expand the first dropdown to manage users. You can create, modify, and delete users.</p>
                        <h4>Creating Users</h4>
                        <p>To create a new user, click the Create Account button below the table. Enter all the fields
                            for the new user, then click the check mark button to create the account. See the "Field
                            Constraints" section below for input validation details.</p>
                        <h4>Modifying Users</h4>
                        <p>To modify a user, click the pencil button for the selected user to toggle editing. Enter new
                            information for the user, then click the checkmark button. Note: not all fields need to be
                            changed, but at least one must be changed to confirm the edit. See the "Field
                            Constraints" section below for input validation details.</p>
                        <h4>Deleting Users</h4>
                        <p>To delete a user, simply click the X button for the selected user.</p>
                        <h4>Field Constraints</h4>
                        <table class="table text-color">
                            <thead>
                            <tr>
                                <th scope="col">Field</th>
                                <th scope="col">Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Username</td>
                                <td>Between 8 and 255 characters</td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td>At least 8 characters</td>
                            </tr>
                            <tr>
                                <td>Account Type</td>
                                <td>Non-negative single-digit integer</td>
                            </tr>
                            </tbody>
                        </table>
                        <h2 class="mt-5">Product Administration</h2>
                        <p>Expand the second dropdown to manage products. You can create, modify, and delete
                            products.</p>
                        <h4>Creating Products</h4>
                        <p>To create a new product, click the Create Product button below the table. Enter all the
                            fields for the new product, then click the check mark button to create the product. See the
                            "Field Constraints" section below for input validation details.</p>
                        <h4>Modifying Products</h4>
                        <p>To modify a product, click the pencil button for the selected product to toggle editing.
                            Enter new information for the product, then click the checkmark button. Note: not all fields
                            need to be changed, but at least one must be changed to confirm the edit. See the "Field
                            Constraints" section below for input validation details.</p>
                        <h4>Deleting Products</h4>
                        <p>To delete a product, simply click the X button for the selected product.</p>
                        <h4>Field Constraints</h4>
                        <table class="table text-color">
                            <thead>
                            <tr>
                                <th scope="col">Field</th>
                                <th scope="col">Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Name</td>
                                <td>Between 8 and 255 characters</td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>Comma separated string, between 1 and 1024 characters</td>
                            </tr>
                            <tr>
                                <td>Image URL</td>
                                <td>Valid URL to an image, between 12 and 100 characters</td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td>Non-negative decimal number with at most 6 digits and 2 decimal places (i.e., 0 -
                                    9999.99)
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  User Account  -->
    <?php include('user_homepage_inner.php'); ?>
</div>
<?php include('footer.php'); ?>
<script src="../js/admin.js"></script>
</body>

</html>