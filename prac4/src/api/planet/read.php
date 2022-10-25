<?php

header("Content-Type: application/json; charset=UTF-8");

include_once "../config/database.php";
include_once "../objects/planet.php";

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $database = new Database();
    $db = $database->getConnection();

    $planet = new Planet($db);

    $stmt = $planet->read();
    $num = $stmt->rowCount();

    if ($num > 0) {

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        http_response_code(200);

        echo json_encode($result);
    } else {
        http_response_code(404);

        echo json_encode(array("message" => "Планеты не найдены."), JSON_UNESCAPED_UNICODE);
    }
} else {
    http_response_code(400);
    echo "Wrong Request method";
}
