<!DOCTYPE html>

<?php
    $title = 'Login';
include('../content/navbar.php');
include('../static/config.php');

ob_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

    // If they aren't empty
    if(!empty($_POST['username']) && !empty($_POST['password'])) {

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
        if(empty($result['username'])){
            $msg = "<p class=\"text-danger mb-5\">Username or password is incorrect!</p>";
        } else{
            if (password_verify($password, $result['password'])) {
                $_SESSION['logged_in'] = true;
                echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
        exit();
            } else{
                $msg = "<p class=\"text-danger mb-5\">Username or password is incorrect!</p>";
            }
        }
    }
}
?>

<body class="vh-100">
<section>
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <form class="mb-md-5 mt-md-4 pb-5" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

                            <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                            <p class="text-white-50 mb-5">Please enter your login and password!</p>
                            <?php if (!empty($msg)) echo $msg ?>

                            <div class="form-outline form-white mb-4">
                                <input type="text" id="username" name="username" class="form-control form-control-lg" />
                                <label class="form-label" for="username">Username</label>
                            </div>

                            <div class="form-outline form-white mb-4">
                                <input type="password" id="password" name="password" class="form-control form-control-lg" />
                                <label class="form-label" for="password">Password</label>
                            </div>

                            <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

                        </form>

                        <div>
                            <p class="mb-0">Don't have an account? <a href="sign_up.php" class="text-white-50 fw-bold">Sign Up</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('../content/footer.php'); ?>
</body>