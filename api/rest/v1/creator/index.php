<?php

//required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
//date_default_timezone_set("America/Sao_Paulo");

// get posted data
$dataBase = json_decode(file_get_contents('php://input'), true);

// make sure data is not empty
if (isset($dataBase['name'])) {
    // set values
    $nome = $dataBase['name'];
    $email = $dataBase['email'];
    $data = $dataBase['data'];
    $hora = $dataBase['hora'];

    // treatment
    if ($nome) {
        // set response code - 201 created
        http_response_code(201);
        // tell the user
        echo json_encode(array("status"=> "1", "message" => "Lead cadastrado."));
    } else {
        // set response code - 503 service unavailable
        http_response_code(503);
        // tell the user
        echo json_encode(array("status" => "0","message" => "Erro ao cadastrar."));
    }
} else { // tell the user data is incomplete
    // set response code - 400 bad request
    http_response_code(400);
    // tell the user
    //echo json_encode(array("message" => "Falha ao cadastrar, dados incompletos."));
    echo json_encode(array("message" => "Falha ao cadastrar, dados incompletos."));
}