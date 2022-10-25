<?php

header("Content-Type: application/json; charset=UTF-8");

include_once "../config/database.php";
include_once "../objects/planet.php";

if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
    $database = new Database();
    $db = $database->getConnection();

    $planet = new Planet($db);

    $planet->id = $_GET["id"] ?? die();;

    if ($planet->delete()) {
        http_response_code(200);

        echo json_encode(array("message" => "Планета была удалена"), JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(503);

        echo json_encode(array("message" => "Не удалось удалить планету"));
    }
} else {
    http_response_code(400);
    echo "Wrong Request method";
}
