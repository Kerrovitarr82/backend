<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Третье задание</title>
</head>
<body>
    <ul>
        <li><a href="index.php">Главная</a></li>
    </ul>
    <p><b>Список файлов</b></p>
    <?php
    echo system("ls");
    ?>
    <br><br>
    <p><b>Информация о процессах</b></p>
    <?php
    echo system("ps");
    ?>
    <br><br>
    <p><b>Пользователь</b></p>
    <?php
    echo system("whoami");
    ?>
    <br><br>
    <p><b>Идентификатор</b></p>
    <?php
    echo system("id");
    ?>
    <br><br>
</body>
</html>