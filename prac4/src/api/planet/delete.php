<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../config/database.php";
include_once "../objects/planet.php";

$database = new Database();
$db = $database->getConnection();

$planet = new Planet($db);

$data = json_decode(file_get_contents("php://input"));

$planet->id = $data->id;

if ($planet->delete()) {
    http_response_code(200);

    echo json_encode(array("message" => "Планета была удалена"), JSON_UNESCAPED_UNICODE);
} else {
    http_response_code(503);

    echo json_encode(array("message" => "Не удалось удалить планету"));
}