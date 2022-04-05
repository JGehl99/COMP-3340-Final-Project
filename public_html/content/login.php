<!DOCTYPE html>
<html>

<head>
    <?php
    $title = 'Login';
    include('headers.php');
    ?>
</head>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // If they aren't empty
    if (!empty($_POST['username']) && !empty($_POST['password'])) {

        // Get username and password
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        // create connection
        $conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);

        // check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check to see if username already exists in db
        $sql = "SELECT username, password, created_on, type FROM ACCOUNT WHERE username=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        $conn->close();

        // If username empty or password doesn't match, display error
        // Else set session variable to denote being logged in, redirect to main page
        if (empty($result['username'])) {
            $msg = "<p class=\"text-danger mb-5\">Username or password is incorrect!</p>";
        } else {
            if (password_verify($password, $result['password'])) {
                $_SESSION['logged_in'] = true;
                $_SESSION['account_type'] = $result['type'];
                $_SESSION['username'] = $result['username'];
                echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
                exit();
            } else {
                $msg = "<p class=\"text-danger mb-5\">Username or password is incorrect!</p>";
            }
        }
    }
}
?>

<body class="page-background">
<?php include('navbar.php'); ?>
<section>
    <div class="container py-5 min_height">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card background text-black rounded-5 shadow">
                    <div class="card-body p-5 text-center">
                        <form class="mb-md-5 mt-md-4 pb-5" method="post"
                              action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

                            <h2 class="fw-bold mb-2 text-uppercase text-color">Login</h2>
                            <p class="text-color mb-5">Please enter your login and password!</p>
                            <?php if (!empty($msg)) echo $msg ?>

                            <div class="form-outline form-white mb-4">
                                <input type="text" id="username" name="username" class="form-control form-control-lg"/>
                                <label class="form-label text-color" for="username">Username</label>
                            </div>

                            <div class="form-outline form-white mb-4">
                                <input type="password" id="password" name="password"
                                       class="form-control form-control-lg"/>
                                <label class="form-label text-color" for="password">Password</label>
                            </div>

                            <button class="btn btn-secondary btn-lg px-5 shadow" type="submit">Login</button>
                        </form>
                        <div>
                            <p class="mb-0 text-color">
                                Don't have an account?
                                <a href="sign_up.php" class="link-primary fw-bold">Sign Up</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('footer.php'); ?>
</body>
</html>