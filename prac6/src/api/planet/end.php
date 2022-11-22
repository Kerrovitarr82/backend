<?php

header("Content-Type: application/json; charset=UTF-8");

include_once "../config/database.php";
include_once "../objects/planet.php";

switch ($_SERVER['REQUEST_METHOD']) {
    case "GET":
        $database = new Database();
        $db = $database->getConnection();

        $planet = new Planet($db);
        if (key_exists("id", $_GET)) {
            $planet->id = $_GET["id"];
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
        }
        break;
    case "DELETE":
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
        break;
    case "PATCH":
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
        break;
    case "POST":
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
        break;
    default:
        http_response_code(400);
        echo "Wrong Request method";
        break;
}