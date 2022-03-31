<?php
session_start();

$theme = $_GET["theme"] ?? 'light';
$data = 'light';

if ($theme == 'dark') {
    $_SESSION['theme-var'] = 'dark';
} else if ($theme == 'light') {
    $_SESSION['theme-var'] = 'light';
}

header('Content-type: text/plain');
echo $theme;