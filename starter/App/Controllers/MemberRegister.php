<?php 

//Required Files
require_once __DIR__.'/../Models/Register.php';



class MemberRegister
{


    //Method to register new user account
    public function new_member($params)
    {
        //Register Model
        $model_connect = new Register();

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
                        'message' => "Congratulations, You Successfully Registered. Check Your Email Inbox, Spam Or Junk Folder For Login Credentials.",
                    ),
                'user_info' => $fillable,
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
        //Register Model
        $model_connect = new Register();
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







    //Method to Verify new user account
    public function user_subscriber($params)
    {
        //Register Model
        $model_connect = new Register();
        //User Account Parameters
        $fillable = array(
            'email' => htmlspecialchars($params['email']),
            'ip' => htmlspecialchars($params['ip']),
            'user_agent' => htmlspecialchars($params['user_agent']),
        );

        //Model Function Call
        $result = $model_connect->user_subscriber($fillable);

        if ($result == true) {

            $data = array(
                'result_info' => 
                    array(
                        'code' => "200",
                        'type' => "success",
                        'message' => "Congratulations, Your Email Has Been Subscribed To Newsletter.",
                    ),
                );

        } else {

            $data = array(
                'result_info' => 
                    array(
                        'code' => "401",
                        'type' => "error",
                        'message' => "Sorry, Action Aborted Untimely Due To Wrong Credentials.",
                    ),
                );
        }
        
        return $data; 
    }







    //Method to Send Contact Form Details
    public function contact_us($params)
    {
        //Register Model
        $model_connect = new Register();
        //User Account Parameters
        $fillable = array(
            'fname' => htmlspecialchars($params['fname']),
            'lname' => htmlspecialchars($params['lname']),
            'email' => htmlspecialchars($params['email']),
            'phone' => htmlspecialchars($params['phone']),
            'subject' => htmlspecialchars($params['subject']),
            'details' => htmlspecialchars($params['details']),
            'ip' => htmlspecialchars($params['ip']),
            'user_agent' => htmlspecialchars($params['user_agent']),
        );

        //Model Function Call
        $result = $model_connect->contact_us($fillable);

        if ($result == true) {

            $data = array(
                'result_info' => 
                    array(
                        'code' => "200",
                        'type' => "success",
                        'message' => "Congratulations, Your Message Report Has Been Sent Successfully.",
                    ),
                );

        } else {

            $data = array(
                'result_info' => 
                    array(
                        'code' => "401",
                        'type' => "error",
                        'message' => "Sorry, Action Aborted Untimely Due To Wrong Credentials.",
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