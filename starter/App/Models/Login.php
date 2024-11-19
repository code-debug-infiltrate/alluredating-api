<?php

//Required Files
require_once __DIR__.'/../../Config/Model.php';
require_once __DIR__.'/../Models/Admin.php';
//require_once __DIR__.'/../Mails/LoginAlert.php';




class Login extends Model

{

    //Tables In Use
    protected $u_table = "app_users"; //Users Table
    protected $p_table = "app_profile";  //Profile Table


    //Method for Unlock User Account (2FA Auth)
    public function confirm_login($params)
    {
        //Admin Model
        $admin_model = new Admin();
        //$send_mail = new LoginAlert();
        //Fetch Company Details For Email
        //$coy_info = $admin_model->coy_info();

        try {
            $newParams = array('email' => $params['email'], );
            $query = "SELECT * FROM " . $this->u_table ." WHERE email = :email LIMIT 1";
            $user = $this->fetch_row($newParams, $query); 

            // Checking all User credentials...
            if ($user != NULL) {
                // Derive the code by shuffle
                if ($user['status'] === "New" || $user['status'] === "Activated") {

                    if (!password_verify($params['password'], $user['password'])) {

                        return 2;

                    } else {

                        $length = 6;
                        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
                        $code = substr(str_shuffle(trim($chars)), 0, $length);
                        $log_session = substr($params['email'], 0, $length).substr(str_shuffle(trim($chars)), 0, $length);
                        $login = date('Y-m-d H:i:s');
                        //Update DB with New Code
                        $newParams1 = array('uniqueid' => $user['uniqueid'], 'code' => $code, 'log_session' => $log_session, 'login_status' => "Logged_in", 'lastlogin' => date('Y-m-d H:i:s'), );
                        $query = "UPDATE ". $this->u_table ." SET `code` = :code, log_session = :log_session, login_status = :login_status, lastlogin = :lastlogin WHERE uniqueid = :uniqueid LIMIT 1";
                        $updatedLogin = $this->update($newParams1, $query);

                        if ($user['notify'] === "On") {
                            //Send Email Alert To User
                            $emailInfo = array('username' => $user['username'], 'email' => $user['email'], 'code' => $code, );
                            //$send_mail->unlockcode_alert($emailInfo, $coy_info);
                            //Record Activity
                            $info = array('uniqueid' => $user['uniqueid'], 'username' => $user['username'], 'category' => "Authentication", 'details' => $user['username']." Requested 2FA Unlock Code", ); 
                            $admin_model->record_activity($info);

                            return 3;
                        }
                        //Fetch User Credentials For Use!
                        $newParams2 = array('uniqueid' => $user['uniqueid'], );
                        $query1 = "SELECT * FROM ". $this->u_table .", ". $this->p_table ." WHERE ". $this->u_table .".uniqueid = :uniqueid AND ". $this->p_table .".uniqueid = :uniqueid LIMIT 1";
                        $userInfo = $this->fetch_row($newParams2, $query1); 
                        //Record Activity
                        $info = array('uniqueid' => $user['uniqueid'], 'username' => $user['username'], 'category' => "Authentication", 'details' => $user['username']." Logged In Successfully.", ); 
                        $admin_model->record_activity($info);
    
                        return $userInfo;
                    }

                } else {

                    return 1;
                }

            } else {

                return false;
            }

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }
    








    //Method for Unlock User Account (2FA Auth)
    public function unlock_account($params)
    {
        //Admin Model
        $admin_model = new Admin();

        $newParams = array('email' => $params['email'], 'code' => $params['code'], );

        try {
        	$query = "SELECT * FROM " . $this->u_table ." WHERE email = :email AND code = :code LIMIT 1";
            $user = $this->fetch_row($newParams, $query); 

            // Checking all User credentials...
            if ($user != NULL) {
			    //Record Activity
	            $info = array('uniqueid' => $user['uniqueid'], 'username' => $user['username'], 'category' => "Authentication", 'details' => $user['username']." Successfully Logged In", ); 
                $admin_model->record_activity($info);

	            return true;

	        } else {

	            return false;
	        }

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }






    //Method for forgot password to send Code
    public function check_member($params)
    {
        //Admin Model
        $admin_model = new Admin();
        //$send_mail = new LoginAlert();
        //Fetch Company Details For Email
        //$coy_info = $admin_model->coy_info();

        $newParams = array('email' => $params['email'], );

        try {
        	$query = "SELECT * FROM " . $this->u_table ." WHERE email = :email LIMIT 1";
            $user = $this->fetch_row($newParams, $query); 

            // Checking all User credentials...
            if ($user != NULL) {
                // Derive the code by shuffle
                $length = 6;
                $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
                $code = substr(str_shuffle(trim($chars)), 0, $length);

                //Update DB with New Code
                $newParams1 = array('uniqueid' => $user['uniqueid'], 'code' => $code, );
                $query = "UPDATE ". $this->u_table ." SET `code` = :code WHERE uniqueid = :uniqueid LIMIT 1";
                $this->update($newParams1, $query); 

			    //Send Email Alert To User
                //$emailInfo = array('username' => $user['username'], 'email' => $user['email'], 'code' => $code, );
	            //$send_mail->passcode_alert($emailInfo, $coy_info);
			    //Record Activity
	            $info = array('uniqueid' => $user['uniqueid'], 'username' => $user['username'], 'category' => "Authentication", 'details' => $user['username']." Requested Password Reset Code", ); 
                $admin_model->record_activity($info);

	            return true;

	        } else {

	            return false;
	        }

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }






    //Method for reset password
    public function reset_password($params)
    {
        //Admin Model
        $admin_model = new Admin();
        //$send_mail = new LoginAlert();
        //Fetch Company Details For Email
        //$coy_info = $admin_model->coy_info();

        $newParams = array('email' => $params['email'], 'code' => $params['code'], );

        try {
        	$query = "SELECT * FROM " . $this->u_table ." WHERE email = :email AND code = :code LIMIT 1";
            $user = $this->fetch_row($newParams, $query); 

            // Checking all User credentials...
            if ($user != NULL) {
                // Derive the code by shuffle
                $length = 5;
                $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
                $code = substr(str_shuffle(trim($chars)), 0, $length);

                //Update DB with New Password
                $newParams1 = array('uniqueid' => $user['uniqueid'], 'password' => password_hash($params['password'], PASSWORD_DEFAULT), 'code' => $code, );
                $query = "UPDATE ". $this->u_table ." SET `password` = :password, `code` = :code WHERE uniqueid = :uniqueid LIMIT 1";
                $this->update($newParams1, $query); 

			    //Send Email Alert To User
                //$emailInfo = array('username' => $user['username'], 'email' => $user['email'], );
	            //$send_mail->passreset_alert($emailInfo, $coy_info);
			    //Record Activity
	            $info = array('uniqueid' => $user['uniqueid'], 'username' => $user['username'], 'category' => "Authentication", 'details' => $user['username']." Changed Password.", ); 
                $admin_model->record_activity($info);

	            return true;

	        } else {

	            return false;
	        }

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }







    //Method for Getting User Passcode
    public function get_user_passcode($params)
    {
        $newParams = array('email' => $params['email'], );

        try {
        	$query = "SELECT * FROM " . $this->u_table ." WHERE email = :email LIMIT 1";
            $user = $this->fetch_row($newParams, $query); 
	        
            return $user;

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }









//Login method For All Users
public function end_session($params)
{
    $admin_model = new Admin();
    $d = array('uniqueid' => $params['uniqueid'], );
    $e = array('uniqueid' => $params['uniqueid'], 'login_status' => "Logged_out", 'log_session' => "End Session", );

    try {

        $query = "SELECT * FROM ". $this->u_table ." WHERE uniqueid = :uniqueid LIMIT 1";
        $user = $this->fetch_row($d, $query);
        
        $query0 = "UPDATE ". $this->u_table ." SET `login_status` = :login_status, `log_session` = :log_session WHERE `uniqueid` = :uniqueid LIMIT 1";
        $this->logout($e, $query0);
        //Record Activity
        $info = array('uniqueid' => $user['uniqueid'], 'username' => $user['username'], 'category' => "Authentication", 'details' => $user['username']." Logged Out", ); 
        $admin_model->record_activity($info);

        unset($params['uniqueid']);
        
        return true;

    } catch (Exception $e) {

        $data = array(
            "type" => "error",
            "message" => $e,
        );

        return $data;          
    }
}














































































































    

    /*

        ******* 

        End oF file 

        ********

    */

}