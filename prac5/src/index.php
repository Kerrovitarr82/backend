<?php
session_start();
if (isset($_COOKIE['user'])) {
    header("Location: private/home.php");
} else {
    header("Location: auth.html");
}
exit();
