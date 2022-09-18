<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<title>Первое задание</title>
</head>
<body>
<ul>
    <li><a href="index.php">Главная</a></li>
</ul>
<?php

class CircleObj
{
    private int $radius;
    private bool $filled;

    function __construct(int $radius, bool $filled) {
        $this->radius = $radius;
        $this->filled = $filled;
    }

    public function getTag() {
        $center = $this->radius + 10;
        if ($this->filled)
            $circleTag = "<circle cx='$center' cy='$center' r='$this->radius' fill='red' stroke='black' stroke-width='3'/>";
        else
            $circleTag = "<circle cx='$center' cy='$center' r='$this->radius' fill='none' stroke='black' stroke-width='3'/>";
        return $circleTag;
    }
}

class RectObj
{
    private int $side;
    private bool $filled;

    function __construct(int $side, bool $filled) {
        $this->side = $side;
        $this->filled = $filled;
    }

    public function getTag() {
        if ($this->filled)
            $rectTag = "<rect width='$this->side' height='$this->side' style='fill:red;stroke-width:3;stroke:rgb(0,0,0)'/>";
        else
            $rectTag = "<rect width='$this->side' height='$this->side' style='fill:none;stroke-width:3;stroke:rgb(0,0,0)'/>";

        return $rectTag;
    }
}

function drawFigure($binnum): void {
    if ($binnum[0]) {
        if ($binnum[1]) {
            if ($binnum[2])
                $figure = new RectObj(400, true);
            else
                $figure = new RectObj(400, false);
        }
        else {
            if ($binnum[2])
                $figure = new RectObj(200, true);
            else
                $figure = new RectObj(200, false);
        }
    }
    else {
        if ($binnum[1]) {
            if ($binnum[2])
                $figure = new CircleObj(200, true);
            else
                $figure = new CircleObj(200, false);
        }
        else {
            if ($binnum[2])
                $figure = new CircleObj(100, true);
            else
                $figure = new CircleObj(100, false);
        }
    }
    print_r($binnum);
    echo "<svg width='500' height='500'>";
    echo $figure->getTag();
    echo "</svg>";
}

function getFigure(string $num) {
    $binnum = str_split(sprintf( "%03d", decbin( $num )));
    return $binnum;
}
drawFigure(getFigure($_GET["num"]));

?>
</body>
</html>