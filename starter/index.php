<?php


//Required Files
require_once __DIR__.'/App/Controllers/NewMember.php';
require_once __DIR__.'/App/Controllers/MemberLogin.php';

$BASE_URI = "/starter/";
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
    $app_name = getenv('APP_NAME');
    echo json_encode("You're Welcome To ". $app_name ." API End-Points!", JSON_FORCE_OBJECT);
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
    
    echo json_encode("Hello! " . $requestData["name"], JSON_FORCE_OBJECT);
};





/**
 * prints a default message if the endpoint path does not exist.
 * @param array $requestData contains the parameters sent in the request, 
 *                           for this endpoint they are ignored.
 * @return void
 */
$endpoints["404"] = function ($requestData): void {

    echo json_encode("Endpoint " . $requestData["endpointName"] . " not found.", JSON_FORCE_OBJECT);
};




/**
 * prints a greeting message with the name specified in the $requestData["name"] item.
 * if the variable is empty a default name is used.
 * @param array $requestData this array must contain an item with key "name" 
 *                           if you want to display a custom name in the greeting.
 * @return void
 */
$endpoints["create-user"] = function (array $requestData): void {

    if ((!isset($requestData["fname"])) || (!isset($requestData["lname"])) || (!isset($requestData["email"]))) {
        
        $info = array(
            'result_info' => 
                array(
                    'code' => "401",
                    'type' => "error",
                    'message' => "Declined. One Or More Required Fields Cannot Be Empty",
                ),
            );

    } elseif (strlen($requestData['fname']) < "5" || strlen($requestData['lname']) < "5") { 

        $info = array(
            'result_info' => 
                array(
                    'code' => "401",
                    'type' => "error",
                    'message' => "First Or Last Name Field Is Too Short, Must Be 5 Or More Characters.",
                ),
            );

    } else {

        //Connect to Controller
        $api_connect = new NewMember();
        $info = $api_connect->new_member($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};






/**
 * prints a greeting message with the name specified in the $requestData["name"] item.
 * if the variable is empty a default name is used.
 * @param array $requestData this array must contain an item with key "name" 
 *                           if you want to display a custom name in the greeting.
 * @return void
 */
$endpoints["confirm-email"] = function (array $requestData): void {

    if ((!isset($requestData["uniqueid"])) || (!isset($requestData["key"]))) {
        
        $info = array(
            'result_info' => 
                array(
                    'code' => "401",
                    'type' => "error",
                    'message' => "Declined. One Or More Required Fields Cannot Be Empty",
                ),
            );

    } else {

        //Connect to Controller
        $api_connect = new NewMember();
        $info = $api_connect->verify_email($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};




/**
 * prints a greeting message with the name specified in the $requestData["name"] item.
 * if the variable is empty a default name is used.
 * @param array $requestData this array must contain an item with key "name" 
 *                           if you want to display a custom name in the greeting.
 * @return void
 */
$endpoints["forgot-password"] = function (array $requestData): void {

    if (!isset($requestData["email"])) {
        
        $info = array(
            'result_info' => 
                array(
                    'code' => "401",
                    'type' => "error",
                    'message' => "Declined. Email Is a Required Field & Cannot Be Empty",
                ),
            );

    } else {

        //Connect to Controller
        $api_connect = new MemberLogin();
        $info = $api_connect->check_member($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};





/**
 * prints a greeting message with the name specified in the $requestData["name"] item.
 * if the variable is empty a default name is used.
 * @param array $requestData this array must contain an item with key "name" 
 *                           if you want to display a custom name in the greeting.
 * @return void
 */
$endpoints["reset-password"] = function (array $requestData): void {

    if ((!isset($requestData["email"])) || (!isset($requestData["password"])) || (!isset($requestData["key"]))) {
        
        $info = array(
            'result_info' => 
                array(
                    'code' => "401",
                    'type' => "error",
                    'message' => "Declined. Required Fields Cannot Be Empty",
                ),
            );

    } else {

        //Connect to Controller
        $api_connect = new MemberLogin();
        $info = $api_connect->reset_password($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};






/**
 * prints a greeting message with the name specified in the $requestData["name"] item.
 * if the variable is empty a default name is used.
 * @param array $requestData this array must contain an item with key "name" 
 *                           if you want to display a custom name in the greeting.
 * @return void
 */
$endpoints["confirm-login"] = function (array $requestData): void {

    if ((!isset($requestData["email"])) || (!isset($requestData["password"]))) {
        
        $info = array(
            'result_info' => 
                array(
                    'code' => "401",
                    'type' => "error",
                    'message' => "Declined. Required Fields Cannot Be Empty",
                ),
            );

    } else {

        //Connect to Controller
        $api_connect = new MemberLogin();
        $info = $api_connect->confirm_login($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};






/**
 * prints a greeting message with the name specified in the $requestData["name"] item.
 * if the variable is empty a default name is used.
 * @param array $requestData this array must contain an item with key "name" 
 *                           if you want to display a custom name in the greeting.
 * @return void
 */
$endpoints["unlock-dashboard"] = function (array $requestData): void {

    if ((!isset($requestData["email"])) || (!isset($requestData["key"]))) {
        
        $info = array(
            'result_info' => 
                array(
                    'code' => "401",
                    'type' => "error",
                    'message' => "Declined. Required Fields Cannot Be Empty",
                ),
            );

    } else {

        //Connect to Controller
        $api_connect = new MemberLogin();
        $info = $api_connect->unlock_account($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
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
        "c9cfa3b2-a96dc9c-48c9ca8-82c9cad-0cbdd3e5d" => ""
    );

    if (!isset($requestData["token"])) {
        echo json_encode("No token was received to authorize the operation. Verify the information sent", JSON_FORCE_OBJECT);

        exit;
    }

    if (!isset($tokens[$requestData["token"]])) {
        echo json_encode("The token  " . $requestData["token"] . 
        " does not exists or is not authorized to perform this operation.", JSON_FORCE_OBJECT);
        
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