<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Второе задание</title>
</head>
<body>
<ul>
    <li><a href="index.php">Главная</a></li>
</ul>
<?php
function shell_Sort($my_array)
{
    $my_array = explode(', ', $my_array);
    $x = round(count($my_array) / 2);
    while ($x > 0) {
        for ($i = $x; $i < count($my_array); $i++) {
            $temp = $my_array[$i];
            $j = $i;
            while ($j >= $x && $my_array[$j - $x] > $temp) {
                $my_array[$j] = $my_array[$j - $x];
                $j -= $x;
            }
            $my_array[$j] = $temp;
        }
        $x = round($x / 2.2);
    }
    return $my_array;
}

$test_array = '3, 0, 2, 5, -1, 4, 1';
echo "<p> Начальный массив: ";
echo $test_array;
echo "</p> <p> Отсортированный массив: ";
echo implode(', ', shell_Sort($test_array));
echo "</p>";
?>
</body>
</html>