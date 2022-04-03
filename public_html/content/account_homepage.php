<?php
include("headers.php");
if (!isLoggedIn() || !isset($_SESSION['account_type'])) {
    header("Location: /content/index.php");
} else if ($_SESSION['account_type'] === 1) {
    header("Location: /content/admin_homepage.php");
} else {
    header("Location: /content/user_homepage.php");
}
