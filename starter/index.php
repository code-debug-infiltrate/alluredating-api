<?php


//Required Files
require_once __DIR__.'/App/Controllers/RegisterController.php';
require_once __DIR__.'/App/Controllers/LoginController.php';
require_once __DIR__.'/App/Controllers/UserController.php';
require_once __DIR__.'/App/Controllers/HomeController.php';

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









//Subscriber
$endpoints["visitor-info"] = function (array $requestData): void {

    if ((!isset($requestData["ip"])) || (!isset($requestData["user_agent"]))) {
        
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
        $api_connect = new HomeController();
        $info = $api_connect->visitor_info($requestData);

        echo json_encode($info, JSON_FORCE_OBJECT);
    }
};



//Create New User
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

    } else {

        //Connect to Controller
        $api_connect = new RegisterController();
        $info = $api_connect->new_member($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};




//COnfirm Registration Email
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
        $api_connect = new RegisterController();
        $info = $api_connect->verify_email($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};



//Forgot password
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
        $api_connect = new LoginController();
        $info = $api_connect->check_member($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};




//Reset Password
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
        $api_connect = new LoginController();
        $info = $api_connect->reset_password($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};




//User Login 
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
        $api_connect = new LoginController();
        $info = $api_connect->confirm_login($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};





//Unlock User Dashboard
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
        $api_connect = new LoginController();
        $info = $api_connect->unlock_account($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};





//LoggedIn User Credentials
$endpoints["get-user-passcode"] = function (array $requestData): void {

    if (!isset($requestData["email"])) {
        
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
        $api_connect = new LoginController();
        $info = $api_connect->get_user_passcode($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};





//Contact Us
$endpoints["contact-us"] = function (array $requestData): void {

    if ((!isset($requestData["email"])) || (!isset($requestData["phone"])) || (!isset($requestData["details"]))) {
        
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
        $api_connect = new RegisterController();
        $info = $api_connect->contact_us($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};





//Subscriber
$endpoints["confirm-subscriber"] = function (array $requestData): void {

    if (!isset($requestData["email"])) {
        
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
        $api_connect = new RegisterController();
        $info = $api_connect->user_subscriber($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};




//Get Company Information
$endpoints["coy-info"] = function (array $requestData): void {
    //Connect to Controller
    $api_connect = new HomeController();
    $info = $api_connect->coy_info();

    echo json_encode($info, JSON_FORCE_OBJECT);
};





//LoggedIn User Credentials
$endpoints["user-info"] = function (array $requestData): void {

    if (!isset($requestData["uniqueid"])) {
        
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
        $api_connect = new UserController();
        $info = $api_connect->user_information($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};



//Get User Activity
$endpoints["user-activity"] = function (array $requestData): void {
    //Connect to Controller
    $api_connect = new UserController();
    $info = $api_connect->user_activity($requestData);

    echo json_encode($info, JSON_FORCE_OBJECT);
};



//Get User Interests
$endpoints["user-interests"] = function (array $requestData): void {
    //Connect to Controller
    $api_connect = new UserController();
    $info = $api_connect->user_interests($requestData);

    echo json_encode($info, JSON_FORCE_OBJECT);
};



//Get All User Profiles
$endpoints["user-profiles"] = function (array $requestData): void {
    //Connect to Controller
    $api_connect = new UserController();
    $info = $api_connect->user_profiles();

    echo json_encode($info, JSON_FORCE_OBJECT);
};


//Get All Users Online Status
$endpoints["users-online-status"] = function (array $requestData): void {
    //Connect to Controller
    $api_connect = new UserController();
    $info = $api_connect->users_online_status();

    echo json_encode($info, JSON_FORCE_OBJECT);
};



//Get User Myself Attributes
$endpoints["user-myself"] = function (array $requestData): void {
    //Connect to Controller
    $api_connect = new UserController();
    $info = $api_connect->user_myself($requestData);

    echo json_encode($info, JSON_FORCE_OBJECT);
};



//Get User Preference
$endpoints["user-preference"] = function (array $requestData): void {
    //Connect to Controller
    $api_connect = new UserController();
    $info = $api_connect->user_preference($requestData);

    echo json_encode($info, JSON_FORCE_OBJECT);
};




//Get User Album
$endpoints["user-album"] = function (array $requestData): void {
    //Connect to Controller
    $api_connect = new UserController();
    $info = $api_connect->user_album($requestData);

    echo json_encode($info, JSON_FORCE_OBJECT);
};



//Get User Languages
$endpoints["user-language"] = function (array $requestData): void {
    //Connect to Controller
    $api_connect = new UserController();
    $info = $api_connect->user_language($requestData);

    echo json_encode($info, JSON_FORCE_OBJECT);
};



//Get User Work & Education
$endpoints["user-workeducation"] = function (array $requestData): void {
    //Connect to Controller
    $api_connect = new UserController();
    $info = $api_connect->user_workeducation($requestData);

    echo json_encode($info, JSON_FORCE_OBJECT);
};



//Update User Username
$endpoints["update-username"] = function (array $requestData): void {

    if ((!isset($requestData["uniqueid"])) || (!isset($requestData["newUsername"]))) {
        
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
        $api_connect = new UserController();
        $info = $api_connect->update_username($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};



//Update User Password
$endpoints["update-password"] = function (array $requestData): void {

    if ((!isset($requestData["uniqueid"])) || (!isset($requestData["oldpass"]))) {
        
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
        $api_connect = new UserController();
        $info = $api_connect->update_password($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};



//Create New Interest
$endpoints["new-interest"] = function (array $requestData): void {

    if ((!isset($requestData["uniqueid"])) || (!isset($requestData["interest"]))) {
        
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
        $api_connect = new UserController();
        $info = $api_connect->create_interest($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};




//Create New Language
$endpoints["new-language"] = function (array $requestData): void {

    if ((!isset($requestData["uniqueid"])) || (!isset($requestData["lang"]))) {
        
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
        $api_connect = new UserController();
        $info = $api_connect->create_language($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};



//Create New Location
$endpoints["new-location"] = function (array $requestData): void {

    if ((!isset($requestData["uniqueid"])) || (!isset($requestData["city"]))) {
        
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
        $api_connect = new UserController();
        $info = $api_connect->update_location($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};



//Create New Location
$endpoints["new-workneducation"] = function (array $requestData): void {

    if ((!isset($requestData["uniqueid"])) || (!isset($requestData["name"]))) {
        
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
        $api_connect = new UserController();
        $info = $api_connect->update_workneducation($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};



//Update User Bio
$endpoints["update-bio"] = function (array $requestData): void {

    if ((!isset($requestData["uniqueid"])) || (!isset($requestData["lname"]))) {
        
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
        $api_connect = new UserController();
        $info = $api_connect->update_bio($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};


//Update User Attributes
$endpoints["update-myself"] = function (array $requestData): void {

    if ((!isset($requestData["uniqueid"])) || (!isset($requestData["details"]))) {
        
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
        $api_connect = new UserController();
        $info = $api_connect->update_myself($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};


//Update Profile Photo 
$endpoints["upload-profile-photo"] = function (array $requestData): void {

    if ((!isset($requestData["uniqueid"])) || (!isset($requestData["profileimage"]))) {
        
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
        $api_connect = new UserController();
        $info = $api_connect->update_profile_photo($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};


//Update Cover Photo
$endpoints["upload-cover-photo"] = function (array $requestData): void {

    if ((!isset($requestData["uniqueid"])) || (!isset($requestData["coverimage"]))) {
        
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
        $api_connect = new UserController();
        $info = $api_connect->update_cover_photo($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};



//Update User Preference
$endpoints["update-preference"] = function (array $requestData): void {

    if ((!isset($requestData["uniqueid"])) || (!isset($requestData["details"]))) {
        
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
        $api_connect = new UserController();
        $info = $api_connect->update_preference($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};



//Find Matches 
$endpoints["user-find-people"] = function (array $requestData): void {

    if (!isset($requestData["uniqueid"])) {
        
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
        $api_connect = new UserController();
        $info = $api_connect->user_find_people($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};


//Random Matches 
$endpoints["user-random-people"] = function (array $requestData): void {

    if (!isset($requestData["uniqueid"])) {
        
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
        $api_connect = new UserController();
        $info = $api_connect->user_random_people($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};


//Count Online/Active Users 
$endpoints["online-now-count"] = function (array $requestData): void {

    //Connect to Controller
    $api_connect = new UserController();
    $info = $api_connect->online_now_count();

    echo json_encode($info, JSON_FORCE_OBJECT);
};


//Count Users Activity 
$endpoints["count-user-activity"] = function (array $requestData): void {

    if (!isset($requestData["uniqueid"])) {
        
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
        $api_connect = new UserController();
        $info = $api_connect->count_user_activity($requestData);

        echo json_encode($info, JSON_FORCE_OBJECT);
    }
};


//Count Users Views 
$endpoints["count-user-views"] = function (array $requestData): void {

    if (!isset($requestData["uniqueid"])) {
        
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
        $api_connect = new UserController();
        $info = $api_connect->count_user_views($requestData);

        echo json_encode($info, JSON_FORCE_OBJECT);
    }
};


//Count Users Views 
$endpoints["count-user-likes"] = function (array $requestData): void {

    if (!isset($requestData["uniqueid"])) {
        
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
        $api_connect = new UserController();
        $info = $api_connect->count_user_likes($requestData);

        echo json_encode($info, JSON_FORCE_OBJECT);
    }
};



//Get ALl Buddy Activity 
$endpoints["buddy-activity"] = function (array $requestData): void {

    if (!isset($requestData["uniqueid"])) {
        
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
        $api_connect = new UserController();
        $info = $api_connect->buddy_activities($requestData);

        echo json_encode($info, JSON_FORCE_OBJECT);
    }
};



//View User Profile
$endpoints["user-views"] = function (array $requestData): void {

    if (!isset($requestData["uniqueid"])) {
        
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
        $api_connect = new UserController();
        $info = $api_connect->user_views($requestData);

        echo json_encode($info, JSON_FORCE_OBJECT);
    }
};


//Buddy Action On User Profile
$endpoints["user-actions"] = function (array $requestData): void {

    if (!isset($requestData["uniqueid"])) {
        
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
        $api_connect = new UserController();
        $info = $api_connect->user_actions($requestData);

        echo json_encode($info, JSON_FORCE_OBJECT);
    }
};



//Buddy Friend Request
$endpoints["user-add-buddy"] = function (array $requestData): void {

    if ((!isset($requestData["uniqueid"])) || (!isset($requestData["buddyid"]))) {
        
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
        $api_connect = new UserController();
        $info = $api_connect->user_add_buddy($requestData);

        echo json_encode($info, JSON_FORCE_OBJECT);
    }
};


//Buddy Accept Request
$endpoints["user-accept-buddy"] = function (array $requestData): void {

    if ((!isset($requestData["uniqueid"])) || (!isset($requestData["buddyid"]))) {
        
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
        $api_connect = new UserController();
        $info = $api_connect->user_accept_buddy($requestData);

        echo json_encode($info, JSON_FORCE_OBJECT);
    }
};


//Buddies Count
$endpoints["user-buddies-count"] = function (array $requestData): void {

    if (!isset($requestData["uniqueid"])) {
        
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
        $api_connect = new UserController();
        $info = $api_connect->user_buddies_count($requestData);

        echo json_encode($info, JSON_FORCE_OBJECT);
    }
};



//Buddies List
$endpoints["user-buddies-list"] = function (array $requestData): void {

    if (!isset($requestData["uniqueid"])) {
        
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
        $api_connect = new UserController();
        $info = $api_connect->user_buddies_list($requestData);

        echo json_encode($info, JSON_FORCE_OBJECT);
    }
};













//Logout
$endpoints["end-session"] = function (array $requestData): void {

    if (!isset($requestData["uniqueid"])) {
        
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
        $api_connect = new LoginController();
        $info = $api_connect->end_session($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};







//Logout
$endpoints["deactivate-account"] = function (array $requestData): void {

    if ((!isset($requestData["uniqueid"])) || (!isset($requestData["details"])) || (!isset($requestData["password"]))) {
        
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
        $api_connect = new UserController();
        $info = $api_connect->deactivate_account($requestData);
    }

    echo json_encode($info, JSON_FORCE_OBJECT);
};










































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