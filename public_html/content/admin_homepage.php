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

$accounts_sql = "SELECT username, password, created_on, type FROM ACCOUNT;";
$accounts = $conn->query($accounts_sql)->fetch_all();

$products_sql = "SELECT id, name, description, imageURL, price FROM PRODUCT";
$products = $conn->query($products_sql)->fetch_all();

$conn->close();
?>

<body class="page-background">
<?php include('navbar.php'); ?>
<div class="container my-5">
    <div class="row mb-5">
        <h1 class="text-color">Administration</h1>
        <div class="accordion" id="accordion">
            <div class="accordion-item background border border-secondary border-bottom-0">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed background" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne"
                            aria-expanded="true" aria-controls="collapseOne">
                        User Administration
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                     data-bs-parent="#accordion">
                    <div class="accordion-body text-color">
                        <h2>Manage Users</h2>
                        <?php if (count($accounts) > 0) { ?>
                            <table class="table text-color">
                                <thead>
                                <tr>
                                    <th scope="col">Username</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Created On</th>
                                    <th scope="col">Account Type</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($accounts as $account) {
                                    [$username, $password, $created_on, $type] = $account;
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
                                                   value="<?php echo $password; ?>"
                                                   readonly/>
                                        </td>
                                        <td>
                                            <input type="text"
                                                   name="created_on"
                                                   class="form-control"
                                                   value="<?php echo $created_on; ?>"
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
                        <?php } else { ?>
                            <p class="text-color">No accounts found.</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="accordion-item background border border-secondary border-bottom-0">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed background" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Product Administration
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                     data-bs-parent="#accordion">
                    <div class="accordion-body text-color">
                        <h2>Manage Products</h2>
                        <?php if (count($products) > 0) { ?>
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
                                <tbody>
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
                        <?php } else { ?>
                            <p class="text-color">No products found.</p>
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
                        <h2>User Administration</h2>
                        <p>Expand the first dropdown to manage users.</p>
                        <h2>Product Administration</h2>
                        <p>Expand the second dropdown to manage products.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <h1 class="text-color">User Account</h1>
    </div>
</div>
<?php include('footer.php'); ?>
<script src="../js/admin.js"></script>
</body>

</html>