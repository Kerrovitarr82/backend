<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

include_once "../config/database.php";
include_once "../objects/planet.php";

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