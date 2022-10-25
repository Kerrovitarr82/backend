<?php

header("Content-Type: application/json; charset=UTF-8");

include_once "../config/database.php";
include_once "../objects/planet.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $database = new Database();
    $db = $database->getConnection();
    $planet = new Planet($db);

    $data = json_decode(file_get_contents("php://input"));

    if (
        !empty($data->name) &&
        !empty($data->description)
    ) {
        $planet->name = $data->name;
        $planet->description = $data->description;

        if ($planet->create()) {
            http_response_code(201);

            echo json_encode(array("message" => "Планета была создана."), JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(503);

            echo json_encode(array("message" => "Невозможно создать планету."), JSON_UNESCAPED_UNICODE);
        }
    } else {
        http_response_code(400);

        echo json_encode(array("message" => "Невозможно создать планету. Данные неполные."), JSON_UNESCAPED_UNICODE);

    }
} else {
    http_response_code(400);
    echo "Wrong Request method";
}