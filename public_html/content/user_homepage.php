<!doctype html>
<html lang="en">

<head>
    <?php
    $title = 'User Homepage';
    include('headers.php');

    if (!isLoggedIn()) {
        header("Location: /content/index.php");
    }


    ?>
</head>

<body class="page-background">
<?php include('navbar.php'); ?>
<div class="container my-5 min_height">
    <?php
    include_once('user_homepage_inner.php');
    ?>
</div>

<?php include('footer.php'); ?>
<script src="../js/user.js"></script>
</body>
</html>
