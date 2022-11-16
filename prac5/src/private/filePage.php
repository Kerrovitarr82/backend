<?php
session_start();
if (isset($_COOKIE['user'])) {
    setcookie('user', $_COOKIE['user'], time() + (10 * 365 * 24 * 60 * 60), '/');
} else {
    header("Location: ../auth.html");
    exit();
}
setcookie('lastScreen', 'filePage', time() + (10 * 365 * 24 * 60 * 60), '/');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вставка файла</title>
</head>
<body>

<form action="fileOperations.php" method="post" enctype="multipart/form-data">
    <p>Выберите pdf для загрузки на сервер</p>
    <input type="file" name="fileToUpload" id="fileToUpload" required>
    <p></p>
    <input type="submit" value="Загрузить" name="submit">
</form>
<h1>Загруженные файлы</h1>
<?php
if ($handle = opendir('uploads')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            echo <<<END
            <form action="fileOperations.php" method="get">
                <input type="submit" value="$entry" name="download">
            </form>
            <p></p>
END;
        }
    }
    closedir($handle);
}
?>


</body>
</html>