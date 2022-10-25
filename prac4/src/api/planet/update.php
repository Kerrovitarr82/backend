<?php

header("Content-Type: application/json; charset=UTF-8");

include_once "../config/database.php";
include_once "../objects/planet.php";

if ($_SERVER['REQUEST_METHOD'] == "PATCH") {
    $database = new Database();
    $db = $database->getConnection();

    $planet = new Planet($db);

    $data = json_decode(file_get_contents("php://input"));

    $planet->id = $_GET["id"] ?? die();

    if (!empty($data->name)) {
        $planet->name = $data->name;
    }
    if (!empty($data->description)) {
        $planet->description = $data->description;
    }

    if ($planet->update()) {
        http_response_code(200);

        echo json_encode(array("message" => "Планета была обновлена"), JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(503);

        echo json_encode(array("message" => "Невозможно обновить планету"), JSON_UNESCAPED_UNICODE);
    }
} else {
    http_response_code(400);
    echo "Wrong Request method";
}
