<?php 

namespace Controllers\v1;

require 'vendor/autoload.php';

/** API For Registration
 *  Version 1.0.0
 *  March 2024
 *--------------------------------------------------------------------
 *  New Member Controller Configuration
 *---------------------------------------------------------------------
**/

//Required Files
use Models\Register;
//require __DIR__.'/../../Models/Register.php';



    class NewMember
    {


        //Method to register new user account
        public function new_member($params)
        {
            //open database connection
            $database = new Db();
            $db = $database->db_Connect();
            //Register Model
            $model_connect = new Register($db);

            // Generate the UniqueID, Hash and Code
            $hash = md5(rand(0,1000));
            $length = 5;
            $chars = getenv('COMBINATION');
            $code = substr(str_shuffle(trim($chars)), 0, $length);
            $uniqueid = trim('uid').trim($code);

            //User Account Parameters
            $fillable = array(
                'uniqueid' => $uniqueid,
                'fname' => htmlspecialchars($params['fname']),
                'lname' => htmlspecialchars($params['lname']),
                'username' => htmlspecialchars(substr($params['fname'], 0,3).substr($params['lname'], 0,3)),
                'email' => htmlspecialchars($params['email']),
                'gender' => htmlspecialchars($params['gender']),
                'dob' => htmlspecialchars($params['dob']),
                'password' => substr(htmlspecialchars($params['lname']), 0,3).substr($hash, 0,7),
                'code' => $code,
                'hash' => $hash,
                'ip' => htmlspecialchars($params['ip']),
                'user_agent' => htmlspecialchars($params['user_agent']),
            );

            //Model Function Call
            $member = $model_connect->new_member($fillable);

            if ($member == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Congratulations, You Successfully Registered. Check Your Email Inbox, Spam Or Junk Folder.",
                        ),
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Sorry, This Credentials Already Exists In Our Records, Login Or Contact Support.",
                        ),
                    );
            }
            
            return $data; 
        }






        //Method to Verify new user account
        public function verify_email($params)
        {
            //open database connection
            $database = new Db();
            $db = $database->db_Connect();
            //Register Model
            $model_connect = new Register($db);

             //User Account Parameters
            $fillable = array(
                'uniqueid' => htmlspecialchars($params['uniqueid']),
                'hash' => htmlspecialchars($params['key']),
            );

            //Model Function Call
            $result = $model_connect->verify_email($fillable);

            if ($result == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Congratulations, Your Email Has Been Verified And Your Account Activated For Full Membership Freebies.",
                        ),
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Sorry, Action Aborted Untimely Due To Wrong Credentials, Contact Support For Help.",
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