<?php

$BASE_URI = "/api-v1/";
$endpoints = array();
$requestData = array();

//collect incoming parameters
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $requestData = $_POST;
        break;
    case 'GET':
        $requestData = $_GET;
        break;
    case 'DELETE':
        $requestData = $_DELETE;
        break;
    case 'PUT':
    case 'PATCH':
        parse_str(file_get_contents('php://input'), $requestData);

        //if the information received cannot be interpreted as an arrangement it is ignored.
        if (!is_array($requestData)) {
            $requestData = array();
        }

        break;
    default:
        //TODO: implement here any other type of request method that may arise.
        break;
}

//If the token is sent in a header X-API-KEY
if (isset($_SERVER["HTTP_X_API_KEY"])) {
    $requestData["token"] = $_SERVER["HTTP_X_API_KEY"];
}

$parsedURI = parse_url($_SERVER["REQUEST_URI"]);
$endpointName = str_replace($BASE_URI, "", $parsedURI["path"]);

if (empty($endpointName)) {
    $endpointName = "/";
}

// closures to define each endpoint logic, 
// I know, this can be improved with some OOP but this is a basic example, 
// don't do this at home, well, or if you want to do it, don't feel judged.

/**
 * prints a default message if the API base path is queried.
 * @param array $requestData contains the parameters sent in the request, for this endpoint they are ignored.
 * @return void
 */
$endpoints["/"] = function (array $requestData): void {

    echo json_encode("Welcome to my API!");
};

/**
 * prints a greeting message with the name specified in the $requestData["name"] item.
 * if the variable is empty a default name is used.
 * @param array $requestData this array must contain an item with key "name" 
 *                           if you want to display a custom name in the greeting.
 * @return void
 */
$endpoints["sayhello"] = function (array $requestData): void {

    if (!isset($requestData["name"])) {
        $requestData["name"] = "Misterious masked individual";
    }

    echo json_encode("hello! " . $requestData["name"]);
};

/**
 * prints a default message if the endpoint path does not exist.
 * @param array $requestData contains the parameters sent in the request, 
 *                           for this endpoint they are ignored.
 * @return void
 */
$endpoints["404"] = function ($requestData): void {

    echo json_encode("Endpoint " . $requestData["endpointName"] . " not found.");
};

/**
 * checks if the token is valid, and prevents the execution of 
 * the requested endpoint.
 * @param array $requestData contains the parameters sent in the request, 
 *                           for this endpoint is required an item with 
 *                           key "token" that contains the token
 *                           received to authenticate and authorize 
 *                           the request.
 * @return void
 */
$endpoints["checktoken"] = function ($requestData): void {

    //you can create secure tokens with this line, but that is a discussion for another post.. 
    //but i am using UUIDv4 instead.
    //$token = str_replace("=", "", base64_encode(random_bytes(160 / 8)));

    //authorized tokens
    $tokens = array(
        "fa3b2c9c-a96d-48a8-82ad-0cb775dd3e5d" => ""
    );

    if (!isset($requestData["token"])) {
        echo json_encode("No token was received to authorize the operation. Verify the information sent");

        exit;
    }

    if (!isset($tokens[$requestData["token"]])) {
        echo json_encode("The token  " . $requestData["token"] . 
        " does not exists or is not authorized to perform this operation.");
        
        exit;
    }
};

//we define the response encoding, by default we will use json
header("Content-Type: application/json; charset=UTF-8");

if (isset($endpoints[$endpointName])) {
    $endpoints["checktoken"]($requestData);
    $endpoints[$endpointName]($requestData);
} else {
    $endpoints["404"](array("endpointName" => $endpointName));
}