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