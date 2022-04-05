<?php
session_start();

if (isset($_GET['theme'])) {
    $theme = $_GET["theme"];
    if ($theme == 'dark') {
        $_SESSION['theme-var'] = 'dark';
    } else if ($theme == 'light') {
        $_SESSION['theme-var'] = 'light';
    }

}
header('Content-type: text/plain');
echo $_SESSION['theme-var'];