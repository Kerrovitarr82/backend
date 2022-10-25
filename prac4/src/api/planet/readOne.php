<?php

header("Content-Type: application/json");

include_once "../config/database.php";
include_once "../objects/planet.php";

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $database = new Database();
    $db = $database->getConnection();

    $planet = new Planet($db);

    $planet->id = $_GET["id"] ?? die();

    $planet->readOne();

    if ($planet->name != null) {

        $product_arr = array(
            "id" => $planet->id,
            "name" => $planet->name,
            "description" => $planet->description,
        );

        http_response_code(200);

        echo json_encode($product_arr);
    } else {
        http_response_code(404);

        echo json_encode(array("message" => "Планета не существует"), JSON_UNESCAPED_UNICODE);
    }
} else {
    http_response_code(400);
    echo "Wrong Request method";
}
