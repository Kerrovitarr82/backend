<?php
if (isset($_COOKIE['theme'])) {
    if ($_COOKIE['theme'] == 'light') {
        setcookie('theme', 'dark', time() + (10 * 365 * 24 * 60 * 60), '/');
    } else {
        setcookie('theme', 'light', time() + (10 * 365 * 24 * 60 * 60), '/');
    }
}
echo "<script> location.href='filePage.php'; </script>";
