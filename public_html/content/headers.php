<?php
    session_start();

    function isLoggedIn() {
        if (!empty($_SESSION['logged_in'])) {
            return $_SESSION['logged_in'];
        } else {
            return false;
        }
    }

    function logOut() {
        $_SESSION['logged_in'] = false;
    }
?>

<head>
    <!-- Ensure $title isn't undefined, if undefined: initialize to empty string-->
    <title> <?php if (empty($title)) $title = ""; echo $title; ?> </title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/anims.css">

</head>