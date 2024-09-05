<?php 

//Required Files
require_once __DIR__.'/../Models/Members.php';



    class UserController
    {



        //Method For User Dashboard
        public function user_information($params)
        {
            //User Model
            $model_connect = new Members();
            //User Account Parameters
            $fillable = array('uniqueid' => htmlspecialchars($params['uniqueid']), );

            //Model Function Call
            $userInfo = $model_connect->user_info($fillable);

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful, User Is Active", ),
                    'user_info' => $userInfo,
                );

            return $data; 
        }



        //Method For User Interests
        public function user_interests($params)
        {
            //User Model
            $model_connect = new Members();
            //User Account Parameters
            $fillable = array('uniqueid' => htmlspecialchars($params['uniqueid']), );

            //Model Function Call
            $actInfo = $model_connect->user_interests($fillable);

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'interests_info' => $actInfo,
                );

            return $data; 
        }




        //Method For User Activities
        public function user_preference($params)
        {
            //User Model
            $model_connect = new Members();
            //User Account Parameters
            $fillable = array('uniqueid' => htmlspecialchars($params['uniqueid']), );

            //Model Function Call
            $actInfo = $model_connect->user_preference($fillable);

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'preference_info' => $actInfo,
                );

            return $data; 
        }




        //Method For User Album
        public function user_album($params)
        {
            //User Model
            $model_connect = new Members();
            //User Account Parameters
            $fillable = array('uniqueid' => htmlspecialchars($params['uniqueid']), );

            //Model Function Call
            $actInfo = $model_connect->user_album($fillable);

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'album_info' => $actInfo,
                );

            return $data; 
        }






        //Method For User Work & Education
        public function user_workeducation($params)
        {
            //User Model
            $model_connect = new Members();
            //User Account Parameters
            $fillable = array('uniqueid' => htmlspecialchars($params['uniqueid']), );

            //Model Function Call
            $actInfo = $model_connect->user_workeducation($fillable);

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'workeducation_info' => $actInfo,
                );

            return $data; 
        }






        //Method For User Language
        public function user_language($params)
        {
            //User Model
            $model_connect = new Members();
            //User Account Parameters
            $fillable = array('uniqueid' => htmlspecialchars($params['uniqueid']), );

            //Model Function Call
            $actInfo = $model_connect->user_language($fillable);

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'language_info' => $actInfo,
                );

            return $data; 
        }





        //Method For User Activities
        public function user_activity($params)
        {
            //User Model
            $model_connect = new Members();
            //User Account Parameters
            $fillable = array('uniqueid' => htmlspecialchars($params['uniqueid']), );

            //Model Function Call
            $actInfo = $model_connect->user_activity($fillable);

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'activity_info' => $actInfo,
                );

            return $data; 
        }



        //Method For Create Interest
        public function create_interest($params)
        {
            //User Model
            $model_connect = new Members();
            //User Account Parameters
            $fillable = array(
                'uniqueid' => htmlspecialchars($params['uniqueid']), 
                'username' => htmlspecialchars($params['username']), 
                'interest' => htmlspecialchars($params['interest']), 
            );

            //Model Function Call
            $result = $model_connect->create_interest($fillable);

            if ($result == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Successful, Interest Added!",
                        ),
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Max Number Reached Or Retry With New Details",
                        ),
                    );
            }

            return $data; 
        }




        //Method For Create language
        public function create_language($params)
        {
            //User Model
            $model_connect = new Members();
            //User Account Parameters
            $fillable = array(
                'uniqueid' => htmlspecialchars($params['uniqueid']), 
                'username' => htmlspecialchars($params['username']), 
                'lang' => htmlspecialchars($params['lang']), 
            );

            //Model Function Call
            $result = $model_connect->create_language($fillable);

            if ($result == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Successful, Language Added!",
                        ),
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Max Number Reached Or Retry With New Details",
                        ),
                    );
            }

            return $data; 
        }





        //Method For User Activities
        public function update_password($params)
        {
            //User Model
            $model_connect = new Members();
            //User Account Parameters
            $fillable = array(
                'uniqueid' => htmlspecialchars($params['uniqueid']), 
                'username' => htmlspecialchars($params['username']), 
                'oldpass' => htmlspecialchars($params['oldpass']), 
                'newpass' => htmlspecialchars($params['newpass']), 
            );

            //Model Function Call
            $result = $model_connect->update_password($fillable);

            if ($result == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Successful, Password Updated!",
                        ),
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Wrong Credentials, Retry With New Information.",
                        ),
                    );
            }

            return $data; 
        }




        //Method For User Activities
        public function update_username($params)
        {
            //User Model
            $model_connect = new Members();
            //User Account Parameters
            $fillable = array(
                'uniqueid' => htmlspecialchars($params['uniqueid']), 
                'username' => htmlspecialchars($params['username']), 
                'newUsername' => htmlspecialchars($params['newUsername']), 
            );

            //Model Function Call
            $result = $model_connect->update_username($fillable);

            if ($result == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Successful, Username Updated!",
                        ),
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Username Taken, Retry With New Information.",
                        ),
                    );
            }

            return $data; 
        }



        //Method For Update Location
        public function update_location($params)
        {
            //User Model
            $model_connect = new Members();
            //User Account Parameters
            $fillable = array(
                'uniqueid' => htmlspecialchars($params['uniqueid']), 
                'username' => htmlspecialchars($params['username']), 
                'address' => htmlspecialchars($params['address']), 
                'city' => htmlspecialchars($params['city']), 
                'country' => htmlspecialchars($params['country']), 
            );

            //Model Function Call
            $result = $model_connect->update_location($fillable);

            if ($result == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Successful, Location Updated!",
                        ),
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Retry With New Details",
                        ),
                    );
            }

            return $data; 
        }




        //Method For Update Bio Details
        public function update_bio($params)
        {
            //User Model
            $model_connect = new Members();
            //User Account Parameters
            $fillable = array(
                'uniqueid' => htmlspecialchars($params['uniqueid']), 
                'username' => htmlspecialchars($params['username']), 
                'fname' => htmlspecialchars($params['fname']), 
                'lname' => htmlspecialchars($params['lname']), 
                'number' => htmlspecialchars($params['number']),
                'occupation' => htmlspecialchars($params['occupation']), 
                'gender' => htmlspecialchars($params['gender']),
                'dob' => htmlspecialchars($params['dob']),
                'details' => htmlspecialchars($params['details']),
            );

            //Model Function Call
            $result = $model_connect->update_bio($fillable);

            if ($result == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Successful, Bio Details Updated!",
                        ),
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Retry With New Details",
                        ),
                    );
            }

            return $data; 
        }





        

        


        

        











//Method For Create language
public function deactivate_account($params)
{
    //User Model
    $model_connect = new Members();
    //User Account Parameters
    $fillable = array(
        'uniqueid' => htmlspecialchars($params['uniqueid']), 
        'username' => htmlspecialchars($params['username']), 
        'password' => htmlspecialchars($params['password']),
        'details' => htmlspecialchars($params['details']), 
    );

    //Model Function Call
    $result = $model_connect->deactivate_account($fillable);

    if ($result == true) {

        $data = array(
            'result_info' => 
                array(
                    'code' => "200",
                    'type' => "success",
                    'message' => "Successful, Account Has Been Deactivated & Trashed After 180 Days!",
                ),
            );

    } else {

        $data = array(
            'result_info' => 
                array(
                    'code' => "401",
                    'type' => "error",
                    'message' => "Error, Something Came Up.",
                ),
            );
    }

    return $data; 
}









        

    /*

        ******* 

        End oF file 

        ********

    */


    }