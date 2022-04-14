<!doctype html>
<html lang="en">

<head>
    <?php
    $title = 'Sign Up';
    include('headers.php');
    ?>
    <meta name="title" content="Sign Up">
    <meta name="description"
          content="Create an OldChicken account to unlock low prices on a wide range of computer parts and PC components including graphics cards, CPUs, and much more">
    <meta name="keywords"
          content="old chicken,e-commerce,account,sign up,user,graphics card,gpu,computer parts,components">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
</head>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // If they aren't empty
    if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['cpassword'])) {

        // If passwords match
        if ($_POST['password'] !== $_POST['cpassword']) {
            $msg = "<p class=\"text-danger mb-5\">Passwords do not match!</p>";
        } else {

            // Get username and create password hash
            $username = trim($_POST['username']);
            $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

            // create connection
            $conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);

            // check connection
            if ($conn->connect_error) {
                echo "connection failed";
                die("Connection failed: " . $conn->connect_error);
            }

            // Check to see if username already exists in db
            $sql = "SELECT username, password, created_on, type FROM ACCOUNT WHERE username=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

            echo "<p>" . $result->fetch_assoc()['username'] . "</p>";

            if (!empty($result->fetch_assoc()['username'])) {
                $msg = "<p class=\"text-danger mb-5\">Username Already Exists!</p>";
            } else {
                //Username doesn't exist, add account to db
                $date = date("Y-m-d h:i:s");
                $type = 0;
                $sql = "INSERT INTO ACCOUNT VALUES(?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssi", $username, $password, $date, $type);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
                $msg = "<p class=\"text-success mb-5\">Account Created! <a href='login.php'>Log in here!</a></p>";
            }
        }
    }
} ?>

<body class="page-background">
<?php include('navbar.php'); ?>
<div class="container py-5 min_height">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card text-color background rounded-5 shadow">
                <div class="card-body p-5 text-center">
                    <form class="mb-md-5 mt-md-4" method="post">
                        <h2 class="fw-bold mb-2 text-uppercase">Sign Up</h2>
                        <p class="text-color mb-5">Please enter a valid username and password!</p>
                        <?php if (!empty($msg)) echo $msg ?>
                        <div class="form-outline form-white mb-4">
                            <input type="text" id="username_field" name="username"
                                   class="form-control form-control-lg text-color" required minlength="8"/>
                            <label class="form-label" for="username_field">Username</label>
                        </div>

                        <div class="form-outline form-white mb-4">
                            <input type="password" id="password_field" name="password"
                                   class="form-control form-control-lg text-color" required minlength="8"/>
                            <label class="form-label" for="password_field">Password</label>
                        </div>

                        <div class="form-outline form-white mb-5">
                            <input type="password" id="confirm_password_field" name="cpassword"
                                   class="form-control form-control-lg text-color"/>
                            <label class="form-label" for="confirm_password_field">Confirm Password</label>
                        </div>

                        <button class="btn btn-secondary btn-lg px-5 shadow" type="submit">Sign Up</button>
                    </form>
                </div>
                <div class="d-flex justify-content-center pb-4">
                    <p class="mb-0 text-color">
                        Already have an account?
                        <a href="login.php" class="link-primary fw-bold">Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
</body>
</html>