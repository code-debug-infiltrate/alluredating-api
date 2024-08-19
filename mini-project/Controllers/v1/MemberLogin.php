<?php 
/** API For Registration
 *  Version 1.0.0
 *  March 2024
 *--------------------------------------------------------------------
 *  New Member Controller Configuration
 *---------------------------------------------------------------------
**/

//Required Files
	require __DIR__.'/../../Models/Login.php';



    class MemberLogin
    {





        




        //Method to Login user to Dashboard
        public function confirm_login($params)
        {
            //open database connection
            $database = new Db();
            $db = $database->db_Connect();
            //Register Model
            $model_connect = new Login($db);

             //User Account Parameters
            $fillable = array(
                'email' => htmlspecialchars($params['email']),
                'password' => htmlspecialchars($params['password']),
            );

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
                            'code' => "200",
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
            //open database connection
            $database = new Db();
            $db = $database->db_Connect();
            //Register Model
            $model_connect = new Login($db);

             //User Account Parameters
            $fillable = array(
                'email' => htmlspecialchars($params['email']),
                'code' => htmlspecialchars($params['key']),
            );

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
            //open database connection
            $database = new Db();
            $db = $database->db_Connect();
            //Register Model
            $model_connect = new Login($db);

            //User Account Parameters
            $fillable = array('email' => htmlspecialchars($params['email']),  );

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
            //open database connection
            $database = new Db();
            $db = $database->db_Connect();
            //Register Model
            $model_connect = new Login($db);

             //User Account Parameters
            $fillable = array(
                'email' => htmlspecialchars($params['email']),
                'password' => htmlspecialchars($params['password']),
                'code' => htmlspecialchars($params['key']),
            );

            //Model Function Call
            $result = $model_connect->reset_password($fillable);

            if ($result == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Congratulations, Your Account Password Was Reset Successfully.",
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