<?php
$mysqli = new mysqli("database", "user", "password", "appDB2");
$result = $mysqli->query("SELECT * FROM admins WHERE userName='{$_POST['uname']}'");
if ($result->num_rows != 0) {
    foreach ($result as $row) {
        if ($row['passwd'] == '{SHA}' . base64_encode(sha1($_POST['psw'], TRUE))) {
            session_start();
            setcookie('user', $_POST['uname'], time() + (10 * 365 * 24 * 60 * 60));
            header("Location: private/home.php");
            exit();
        }
    }
} else {
    header("Location: auth.html");
    exit();
}


