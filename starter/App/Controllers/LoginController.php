<?php 

//Required Files
require_once __DIR__.'/../Models/Login.php';



    class LoginController
    {



        //Method to Login user to Dashboard
        public function confirm_login($params)
        {
            //Register Model
            $model_connect = new Login();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $result = $model_connect->confirm_login($fillable);

            if ($result === 1) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Sorry, Your Account Has Technical Issues. Kindly Contact Support.",
                        ),
                    );
            } elseif ($result === 2) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Sorry, Your Account Password Is Incorrect. Try Again Later",
                        ),
                    );
            } elseif ($result === 3) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "202",
                            'type' => "success",
                            'message' => "A One-Time Code Has Been Sent To Your Provided Email, Check Your Inbox, Spam Or Junk Folder To Continue.",
                        ),
                    );
            } elseif ($result === false) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Sorry, This Credentials Does Not Exist In Our Records. Register To Become a Member.",
                        ),
                    );
            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Congratulations, You're Successfully Logged In.",
                            'userInfo' => $result,
                        ),
                    );

            }
            
            return $data; 
        }




        //Method to Unlock user account (2FA Auth)
        public function unlock_account($params)
        {
            //Register Model
            $model_connect = new Login();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $result = $model_connect->unlock_account($fillable);

            if ($result == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Congratulations, You're Successfully Logged In.",
                        ),
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Sorry, Action Aborted Untimely Due To Wrong Credentials. Retry After Sometime.",
                        ),
                    );
            }
            
            return $data; 
        }



        //Method to Check Email For Password Reset
        public function check_member($params)
        {
            //Register Model
            $model_connect = new Login();
            $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $checker = $model_connect->check_member($fillable);

            if ($checker == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "A One-Time Code Has Been Sent To The Provided Email. Check Your Email Inbox, Spam Or Junk Folder To Continue.",
                        ),
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Sorry, This Credentials Does Not Exist In Our Records, Create An Account To Continue.",
                        ),
                    );
            }
            
            return $data; 
        }




        //Method to Reset user account Password
        public function reset_password($params)
        {
            //Register Model
            $model_connect = new Login();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $result = $model_connect->reset_password($fillable);

            if ($result == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Congratulations, Your Account Password Was Reset Successfully. You Can Now Login.",
                        ),
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Sorry, Action Aborted Untimely Due To Wrong Credentials. Retry After Sometime.",
                        ),
                    );
            }
            
            return $data; 
        }






        //Method to Reset user account Password
        public function get_user_passcode($params)
        {
            //Register Model
            $model_connect = new Login();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $result = $model_connect->get_user_passcode($fillable);
            
            $data = array(
                'result_info' => 
                    array(
                        'code' => "200",
                        'type' => "success",
                        'message' => "Successful",
                    ),
                'user_info' => $result,
                );
            
            return $data; 
        }





        //Method to End User Session
        public function end_session($params)
        {
            //Register Model
            $model_connect = new Login();
            $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $result = $model_connect->end_session($fillable);

            if ($result == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "You are Successfully Logged Out.",
                        ),
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Sorry, Action Aborted Untimely Due To Wrong Credentials. Retry After Sometime.",
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