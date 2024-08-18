<?php 
/** API For Registration
 *  Version 1.0.0
 *  March 2024
 *--------------------------------------------------------------------
 *  New Member Controller Configuration
 *---------------------------------------------------------------------
**/

//Required Files
	//require __DIR__.'/config/connect.php';
	require __DIR__.'/../../Models/Register.php';


    class NewMember

    {


        //Method to register new user account
        public function new_member($params)
        {

                // Generate the UniqueID, Hash and Code
                $hash = md5(rand(0,1000));
                $length = 5;
                $chars = getenv('COMBINATION');
                $code = substr(str_shuffle(trim($chars)), 0, $length);
                $uniqueid = trim('uid').trim($code);



                if (isset($_POST['join'])) { 
                    //Check Variables
                    if ((empty($params['fname'])) || (empty($params['lname'])) || (empty($params['email'])) || (empty($params['dob']))  || (empty($params['gender']))) { 
                        
                        $data = $data = json_encode(
                            array(
                                'result_info' => 
                                        array(
                                            'code' => "401",
                                            'type' => "error",
                                            'message' => "One Or More Fields Cannot Be Empty, Fill All Fields To Continue",
                                        ),
                                        
                                    ), JSON_FORCE_OBJECT);

                        return $data;

                    } else {

                        //User Account Parameters
                        $fillable = array(
                            'uniqueid' => $uniqueid,
                            'fname' => htmlspecialchars($params['fname']),
                            'lname' => htmlspecialchars($params['lname']),
                            'username' => htmlspecialchars($params['fname'].$code),
                            'email' => htmlspecialchars($params['email']),
                            'gender' => htmlspecialchars($params['gender']),
                            'dob' => htmlspecialchars($params['dob']),
                            'password' => password_hash(htmlspecialchars($params['lname']).$code, PASSWORD_DEFAULT),
                            'code' => $code,
                            'hash' => $hash,
                            'ip' => htmlspecialchars($params['ip']),
                            'user_agent' => htmlspecialchars($params['user_agent'])
                        );

                        //Model Function Call
                        $model_connect = new Register();
                        $member = $model_connect->new_member($fillable);

                        if ($member == true) {

                            $data = json_encode(
                                array(
                                    'result_info' => 
                                            array(
                                                'code' => "200",
                                                'type' => "success",
                                                'message' => "Successfully Registered. Check Your Email Inbox, Spam Or Junk Folder To Continue",
                                            ),
                                            
                                        ), JSON_FORCE_OBJECT);
                
                            return $data;

                        } else {

                            $data = json_encode(
                                array(
                                    'result_info' => 
                                            array(
                                                'code' => "401",
                                                'type' => "error",
                                                'message' => "Declined. Credentials Are ALready In Use, Login To Continue",
                                            ),
                                            
                                        ), JSON_FORCE_OBJECT);
                
                            return $data;
                        }

                    }
                }
        }




    }