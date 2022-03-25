<!DOCTYPE html>

<?php
$title = 'Sign Up';
include('../content/navbar.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // If they aren't empty
    if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['cpassword'])) {

        // If passwords match
        if($_POST['password'] == $_POST['cpassword']){

            // Get username and create password hash
            $username = trim($_POST['username']);
            $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

            $dbServerName = "localhost";
            $dbUsername = "gehlj_OldChickenDB";
            $dbPassword = "Pt9me6124l";
            $dbName = "gehlj_OldChickenDB";
            $port = 3306;

            // create connection
            $conn = new mysqli($dbServerName, $dbUsername, $dbPassword, $dbName, $port);

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

            if(!empty($result->fetch_assoc()['username'])){
                // TODO: Username exists, tell user to choose new username
            } else{
                //TODO: Username doesn't exist, add account to db
            }
        }
    }
} ?>

<body class="vh-100">
<section>
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <form class="mb-md-5 mt-md-4" method="post" action="">

                            <h2 class="fw-bold mb-2 text-uppercase">Sign Up</h2>
                            <p class="text-white-50 mb-5">Please enter a valid username and password!</p>

                            <div class="form-outline form-white mb-4">
                                <input type="username" id="username_field" name="username" class="form-control form-control-lg" required minlength="8"/>
                                <label class="form-label" for="username_field">Username</label>
                            </div>

                            <div class="form-outline form-white mb-4">
                                <input type="password" id="password_field" name="password" class="form-control form-control-lg" required minlength="8"/>
                                <label class="form-label" for="password_field">Password</label>
                            </div>

                            <div class="form-outline form-white mb-5">
                                <input type="password" id="confirm_password_field" name="cpassword" class="form-control form-control-lg" />
                                <label class="form-label" for="confirm_password_field">Confirm Password</label>
                            </div>

                            <button class="btn btn-outline-light btn-lg px-5" type="submit">Sign Up</button>

                        </div>

                        <div class="d-flex justify-content-center pb-4">
                            <p class="mb-0">Already have an account? <a href="login.php" class="text-white-50 fw-bold">Login</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>