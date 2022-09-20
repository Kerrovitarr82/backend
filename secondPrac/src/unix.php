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
    <p>ls</p>
    <?php
    echo system("ls");
    ?>
    <p>ps</p>
    <?php
    echo system("ps");
    ?>
    <p>whoami</p>
    <?php
    echo system("whoami");
    ?>
    <p>id</p>
    <?php
    echo system("id");
    ?>
</body>
</html>