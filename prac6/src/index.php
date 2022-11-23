<?php
ini_set('session.save_handler', 'redis');
ini_set('session.save_path', 'redis');
session_start();
if (isset($_COOKIE['user'])) {
    setcookie('user', $_COOKIE['user'], time() + (10 * 365 * 24 * 60 * 60), '/');
    if (isset($_COOKIE['lastScreen']) and $_COOKIE['lastScreen'] === 'home') {
        header("Location: private/home.php");
    } else if (isset($_COOKIE['lastScreen']) and $_COOKIE['lastScreen'] === 'filePage') {
        header("Location: private/filePage.php");
    } else if (isset($_COOKIE['lastScreen']) and $_COOKIE['lastScreen'] === 'fixtures') {
        header("Location: private/fixtures.php");
    } else {
        header("Location: private/home.php");
    }
} else {
    header("Location: auth.html");
}
exit();
