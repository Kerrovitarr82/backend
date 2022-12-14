<?php
require_once '/var/www/html/vendor/autoload.php';
require_once '/var/www/html/jpgraph/src/jpgraph.php';
require_once '/var/www/html/jpgraph/src/jpgraph_pie.php';
require_once '/var/www/html/jpgraph/src/jpgraph_bar.php';
require_once '/var/www/html/jpgraph/src/jpgraph_scatter.php';
include_once "../api/config/database.php";

session_start();
if (isset($_COOKIE['user'])) {
    setcookie('user', $_COOKIE['user'], time() + (10 * 365 * 24 * 60 * 60), '/');
} else {
    header("Location: ../auth.html");
    exit();
}
setcookie('lastScreen', 'fixtures', time() + (10 * 365 * 24 * 60 * 60), '/');
echo '<p><a href="home.php">Главная</a></p>';

$faker = Faker\Factory::create();

$database = new Database();
$db = $database->getConnection();

$query = ("DELETE from planets_faker");
$stmt = $db->prepare($query);
$stmt->execute();

$distanceArr = array();
$massArr = array();
$radiusArr = array();

for ($i = 0; $i < 50; $i++) {
    $query = ("INSERT INTO planets_faker (name, description, distance_from_star, mass, radius) VALUES (?,?,?,?,?)");
    $stmt = $db->prepare($query);
    $distanceArr[] = $faker->randomDigit();
    $massArr[] = $faker->randomDigit();
    $radiusArr[] = $faker->randomDigit();
    $stmt->execute([$faker->word(), $faker->paragraph(), end($distanceArr), end($massArr), end($radiusArr)]);
}

$query = "SELECT * FROM planets_faker";
$stmt = $db->prepare($query);
$stmt->execute();

while ($row = $stmt->fetch()) {
    echo "id: " . $row["id"] . " - Name: " . $row["name"] .
        " - Distance from star: " . $row["distance_from_star"] .
        " - Mass: " . $row["mass"] .
        " - Radius: " . $row["radius"] . "<br>";
}

$graph = new Graph(900, 300);
$graph->SetScale('textlin');
$graph->SetMargin(40, 30, 20, 40);
$array_keys = array_count_values($massArr);
ksort($array_keys);
$graph->xaxis->SetTickLabels(array_keys($array_keys));
$b1 = new BarPlot(array_count_values($massArr));
$graph->Add($b1);
$graph->title->Set('Mass');
$graph->yaxis->title->Set('Number of occurrences');
$graph->xaxis->title->Set('Mass');
$graph->Stroke('charts/bar.png');

$graph = new PieGraph(500, 400);
$p1 = new PiePlot(array_count_values($distanceArr));
$graph->title->Set('Distance');
$p1->SetLegends(array_keys(array_count_values($distanceArr)));
$p1->SetLabelType(PIE_VALUE_ABS);
$p1->value->SetFormat('%d');
$p1->value->Show();
$graph->Add($p1);
$graph->Stroke('charts/pie.png');

$graph = new Graph(700, 800);
$graph->SetScale("linlin");
$graph->img->SetMargin(40, 40, 40, 40);
$graph->SetShadow();
$graph->title->Set('Radius');
$sp1 = new ScatterPlot(array_count_values($radiusArr));
$graph->Add($sp1);
$graph->Stroke('charts/scatter.png');

water('charts/bar.png');
water('charts/pie.png');
water('charts/scatter.png');

echo '<img src="charts/bar.png"><br>';
echo '<img src="charts/pie.png"><br>';
echo '<img src="charts/scatter.png"><br>';


function water($path): void
{
    $stamp = imagecreatefrompng('watermark/mark.png');
    $im = imagecreatefrompng($path);
    $marge_right = 300;
    $marge_bottom = 150;
    $sx = imagesx($stamp);
    $sy = imagesy($stamp);
    imagecopymerge($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp), 50);
    imagepng($im, $path);
    imagedestroy($im);
}