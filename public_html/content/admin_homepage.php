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
// create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$accounts_sql = "SELECT username, password, created_on, type FROM ACCOUNT;";
$accounts = $conn->query($accounts_sql)->fetch_all();

$products_sql = "SELECT name, description, imageURL, price FROM PRODUCT";
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
                                    <tr>
                                        <form action="admin_homepage.php?username=<?php echo $username ?>">
                                            <td><input type="text" id="<?php echo $username; ?>"
                                                       class="form-control username" value="<?php echo $username; ?>"
                                                       readonly/></td>
                                            <td><input type="text" id="<?php echo $password; ?>"
                                                       class="form-control password" value="<?php echo $password; ?>"
                                                       readonly/></td>
                                            <td><input type="text" id="<?php echo $created_on; ?>"
                                                       class="form-control created-on"
                                                       value="<?php echo $created_on; ?>"
                                                       readonly/></td>
                                            <td><input type="text" id="<?php echo $type; ?>"
                                                       class="form-control account-type" value="<?php echo $type; ?>"
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
                                    [$name, $description, $imageURL, $price] = $product;
                                    ?>
                                    <tr>
                                        <td><input type="text" id="<?php echo $name; ?>"
                                                   class="form-control name" value="<?php echo $name; ?>"
                                                   readonly/></td>
                                        <td><input type="text" id="<?php echo $description; ?>"
                                                   class="form-control description" value="<?php echo $description; ?>"
                                                   readonly/></td>
                                        <td><input type="text" id="<?php echo $imageURL; ?>"
                                                   class="form-control imageURL" value="<?php echo $imageURL; ?>"
                                                   readonly/></td>
                                        <td><input type="text" id="<?php echo $price; ?>"
                                                   class="form-control price" value="<?php echo $price; ?>"
                                                   readonly/></td>
                                        <td>
                                            <button class="btn-empty"><img src="../static/close_black_24dp.svg"
                                                                           alt="Delete Product"/></button>
                                            <button class="btn-empty"><img src="../static/mode_edit_black_24dp.svg"
                                                                           alt="Edit Product"/></button>
                                            <button class="btn-empty"><img src="../static/check_black_24dp.svg"
                                                                           alt="Confirm Edit"/></button>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        <?php } else { ?>
                            <p>No products found.</p>
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
</body>

</html>