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

<body class="page-background">
<?php include('navbar.php'); ?>
<div class="container">
    <h1>Admin Homepage</h1>
</div>
<?php include('footer.php'); ?>
</body>

</html>