<!DOCTYPE html>

<?php
$title = 'Sign Up';
include('../content/navbar.php');
?>

<body class="vh-100">
<section>
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card text-black" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <div class="mb-md-5 mt-md-4">

                            <h2 class="fw-bold mb-2 text-uppercase">Sign Up</h2>
                            <p class="text-50 mb-5">Please enter a valid email and password!</p>

                            <div class="form-outline form-white mb-4">
                                <input type="email" id="typeEmailX" class="form-control form-control-lg" />
                                <label class="form-label" for="typeEmailX">Email</label>
                            </div>

                            <div class="form-outline form-white mb-4">
                                <input type="password" id="typePasswordX" class="form-control form-control-lg" />
                                <label class="form-label" for="typePasswordX">Password</label>
                            </div>

                            <div class="form-outline form-white mb-5">
                                <input type="password" id="confirmPasswordX" class="form-control form-control-lg" />
                                <label class="form-label" for="confirmPasswordX">Confirm Password</label>
                            </div>

                            <button class="btn btn-dark btn-lg px-5" type="submit">Sign Up</button>

                        </div>

                        <div>
                            <p class="mb-0">Already have an account? <a href="login.php" class="text-50 fw-bold">Login</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>