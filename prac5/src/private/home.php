<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Космос</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="head">
    <ul class="menu">
        <li><a href="home.php#earth">Земля</a></li>
        <li><a href="home.php#mercury">Меркурий</a></li>
        <li><a href="home.php#venus">Венера</a></li>
        <li><a href="home.php#mars">Марс</a></li>
        <li><a href="home.php#jupiter">Юпитер</a></li>
        <li><a href="home.php#saturn">Сатурн</a></li>
        <li><a href="home.php#uranus">Уран</a></li>
        <li><a href="home.php#neptun">Нептун</a></li>
        <li><a href="home.php#sun">Солнце</a></li>
        <li><a href="filePage.php">Вставка файла</a></li>
    </ul>
</header>
<header class="burg">
    <div class="bar">
        <span class="bar-1"> </span>
        <span class="bar-2"> </span>
        <span class="bar-3"> </span>
    </div>
    <ul class="burger-menu menu1">
        <li><a href="home.php#earth">Земля</a></li>
        <li><a href="home.php#mercury">Меркурий</a></li>
        <li><a href="home.php#venus">Венера</a></li>
        <li><a href="home.php#mars">Марс</a></li>
        <li><a href="home.php#jupiter">Юпитер</a></li>
        <li><a href="home.php#saturn">Сатурн</a></li>
        <li><a href="home.php#uranus">Уран</a></li>
        <li><a href="home.php#neptun">Нептун</a></li>
        <li><a href="home.php#sun">Солнце</a></li>
        <li><a href="filePage.php">Вставка файла</a></li>
    </ul>
</header>
<main class="mainContent">
    <?php
    session_start();
    setcookie('user', $_POST['uname'], time() + (10 * 365 * 24 * 60 * 60));
    $celestial_body = file_get_contents("texts/earth.txt", true);
    echo $celestial_body;
    $celestial_body = file_get_contents("texts/mercury.txt", true);
    echo $celestial_body;
    $celestial_body = file_get_contents("texts/venus.txt", true);
    echo $celestial_body;
    $celestial_body = file_get_contents("texts/mars.txt", true);
    echo $celestial_body;
    $celestial_body = file_get_contents("texts/jupiter.txt", true);
    echo $celestial_body;
    $celestial_body = file_get_contents("texts/saturn.txt", true);
    echo $celestial_body;
    $celestial_body = file_get_contents("texts/uranus.txt", true);
    echo $celestial_body;
    $celestial_body = file_get_contents("texts/neptun.txt", true);
    echo $celestial_body;
    $celestial_body = file_get_contents("texts/sun.txt", true);
    echo $celestial_body;
    ?>
</main>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="script.js"></script>
</body>
</html>