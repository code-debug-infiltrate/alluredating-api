<?php
/** API Model For Registration
 *  Version 1.0.0
 *  March 2024
 *--------------------------------------------------------------------
 *  Model Configuration
 *---------------------------------------------------------------------
**/

//Required Files

//Models
require_once 'Admin.php';
//DB
require_once './Config/Db.php';
//Mails
require_once './Mails/LoginAlert.php';




class Login

{

    //Tables In Use
    protected $u_table = "app_users"; //Users Table
    protected $p_table = "app_profile";  //Profile Table

    //Database Connection
    private $con;
    //Function to construct pdo interface for connection
    public function __construct($db){
        $this->con = $db;
    }





    //Method for Unlock User Account (2FA Auth)
    public function confirm_login($params)
    {
        //open database connection
        $database = new Db();
        $db = $database->db_Connect();
        //Admin Model
        $admin_model = new Admin($db);
        $send_mail = new LoginAlert();
        //Fetch Company Details For Email
        $coy_info = $admin_model->coy_info();

        $newParams = array('email' => $params['email'], );

        try {

            $query = "SELECT * FROM " . $this->u_table ." WHERE email = :email LIMIT 1";
            $stmt = $this->con->prepare($query);
            //var_dump($newParams);
            foreach ($newParams as $key => &$value) {
                $stmt->bindParam($key, $value, PDO::PARAM_STR);
            }
            $stmt->execute($newParams);
            $user = $stmt->fetch(PDO::FETCH_ASSOC); 

            // Checking all User credentials...
            if ($user != NULL) {
                // Derive the code by shuffle
                if ($user['status'] === "New" || $user['status'] === "Activated") {

                    if (!password_verify($params['password'], $user['password'])) {

                        return 2;

                    } else {

                        $length = 6;
                        $chars = trim(getenv('COMBINATION'));
                        $code = substr(str_shuffle(trim($chars)), 0, $length);
                        $log_session = substr($params['email'], 0, $length).substr(str_shuffle(trim($chars)), 0, $length);
                        //Update DB with New Code
                        $newParams1 = array('uniqueid' => $user['uniqueid'], 'code' => $code, 'log_session' => $log_session,  'login_status' => "Logged_in", );
                        $query = "UPDATE ". $this->u_table ." SET `code` = :code, log_session = :log_session, login_status = :login_status WHERE uniqueid = :uniqueid LIMIT 1";
                        $stmt = $this->con->prepare($query);
                        foreach ($newParams1 as $key => &$value) {
                            $stmt->bindParam($key, $value, PDO::PARAM_STR);
                        }
                        $stmt->execute($newParams1);

                        if($user['notify'] === "On") {

                            //Send Email Alert To User
                            $emailInfo = array('username' => $user['username'], 'email' => $user['email'], 'code' => $code, );
                            $send_mail->unlockcode_alert($emailInfo, $coy_info);
                            //Record Activity
                            $info = array('uniqueid' => $user['uniqueid'], 'username' => $user['username'], 'category' => "Authentication", 'details' => $user['username']." Requested 2FA Unlock Code", ); 
                            $admin_model->record_activity($info);

                            return 3;
                        }
                        //Fetch User Credentials For Use!
                        $newParams2 = array('uniqueid' => $user['uniqueid'], );
                        $query1 = "SELECT * FROM ". $this->u_table .", ". $this->p_table ." WHERE ". $this->u_table .".uniqueid = :uniqueid AND ". $this->p_table .".uniqueid = :uniqueid LIMIT 1";
                        $stmt = $this->con->prepare($query1);
                        foreach ($newParams2 as $key => &$value) {
                            $stmt->bindParam($key, $value, PDO::PARAM_STR);
                        }
                        $stmt->execute($newParams2);
                        $userInfo = $stmt->fetch(PDO::FETCH_ASSOC); 
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

            $db->db_close();

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }
    








    //Method for Unlock User Account (2FA Auth)
    public function unlock_account($params)
    {
        //open database connection
        $database = new Db();
        $db = $database->db_Connect();
        //Admin Model
        $admin_model = new Admin($db);
        $send_mail = new LoginAlert();
        //Fetch Company Details For Email
        $coy_info = $admin_model->coy_info();

        $newParams = array('email' => $params['email'], 'code' => $params['code'], );

        try {

        	$query = "SELECT * FROM " . $this->u_table ." WHERE email = :email AND code = :code LIMIT 1";
            $stmt = $this->con->prepare($query);
            //var_dump($newParams);
            foreach ($newParams as $key => &$value) {
                $stmt->bindParam($key, $value, PDO::PARAM_STR);
            }
            $stmt->execute($newParams);
            $user = $stmt->fetch(PDO::FETCH_ASSOC); 

            // Checking all User credentials...
            if ($user != NULL) {
			    //Record Activity
	            $info = array('uniqueid' => $user['uniqueid'], 'username' => $user['username'], 'category' => "Authentication", 'details' => $user['username']." Successfully Logged In", ); 
                $admin_model->record_activity($info);

	            return true;

	        } else {

	            return false;
	        }

        	$db->db_close();

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }






    //Method for forgot password to send Code
    public function check_member($params)
    {
        //open database connection
        $database = new Db();
        $db = $database->db_Connect();
        //Admin Model
        $admin_model = new Admin($db);
        $send_mail = new LoginAlert();
        //Fetch Company Details For Email
        $coy_info = $admin_model->coy_info();

        $newParams = array('email' => $params['email'], );

        try {

        	$query = "SELECT * FROM " . $this->u_table ." WHERE email = :email LIMIT 1";
            $stmt = $this->con->prepare($query);
            //var_dump($newParams);
            foreach ($newParams as $key => &$value) {
                $stmt->bindParam($key, $value, PDO::PARAM_STR);
            }
            $stmt->execute($newParams);
            $user = $stmt->fetch(PDO::FETCH_ASSOC); 

            // Checking all User credentials...
            if ($user != NULL) {
                // Derive the code by shuffle
                $length = 6;
                $chars = trim(getenv('COMBINATION'));
                $code = substr(str_shuffle(trim($chars)), 0, $length);
                //Update DB with New Code
                $newParams1 = array('uniqueid' => $user['uniqueid'], 'code' => $code, );
                $query = "UPDATE ". $this->u_table ." SET `code` = :code WHERE uniqueid = :uniqueid LIMIT 1";
                $stmt = $this->con->prepare($query);
                foreach ($newParams1 as $key => &$value) {
                    $stmt->bindParam($key, $value, PDO::PARAM_STR);
                }
                $stmt->execute($newParams1);
			    //Send Email Alert To User
                $emailInfo = array('username' => $user['username'], 'email' => $user['email'], 'code' => $code, );
	            $send_mail->passcode_alert($emailInfo, $coy_info);
			    //Record Activity
	            $info = array('uniqueid' => $user['uniqueid'], 'username' => $user['username'], 'category' => "Authentication", 'details' => $user['username']." Requested Password Reset Code", ); 
                $admin_model->record_activity($info);

	            return true;

	        } else {

	            return false;
	        }

        	$db->db_close();

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }






    //Method for reset password
    public function reset_password($params)
    {
        //open database connection
        $database = new Db();
        $db = $database->db_Connect();
        //Admin Model
        $admin_model = new Admin($db);
        $send_mail = new LoginAlert();
        //Fetch Company Details For Email
        $coy_info = $admin_model->coy_info();

        $newParams = array('email' => $params['email'], 'code' => $params['code'], );

        try {

        	$query = "SELECT * FROM " . $this->u_table ." WHERE email = :email AND code = :code LIMIT 1";
            $stmt = $this->con->prepare($query);
            //var_dump($newParams);
            foreach ($newParams as $key => &$value) {
                $stmt->bindParam($key, $value, PDO::PARAM_STR);
            }
            $stmt->execute($newParams);
            $user = $stmt->fetch(PDO::FETCH_ASSOC); 

            // Checking all User credentials...
            if ($user != NULL) {
                // Derive the code by shuffle
                $length = 5;
                $chars = trim(getenv('COMBINATION'));
                $code = substr(str_shuffle(trim($chars)), 0, $length);
                //Update DB with New Password
                $newParams1 = array('uniqueid' => $user['uniqueid'], 'password' => password_hash($params['password'], PASSWORD_DEFAULT), 'code' => $code, );
                $query = "UPDATE ". $this->u_table ." SET `password` = :password, `code` = :code WHERE uniqueid = :uniqueid LIMIT 1";
                $stmt = $this->con->prepare($query);
                foreach ($newParams1 as $key => &$value) {
                    $stmt->bindParam($key, $value, PDO::PARAM_STR);
                }
                $stmt->execute($newParams1);
			    //Send Email Alert To User
                $emailInfo = array('username' => $user['username'], 'email' => $user['email'], );
	            $send_mail->passreset_alert($emailInfo, $coy_info);
			    //Record Activity
	            $info = array('uniqueid' => $user['uniqueid'], 'username' => $user['username'], 'category' => "Authentication", 'details' => $user['username']." Changed Password.", ); 
                $admin_model->record_activity($info);

	            return true;

	        } else {

	            return false;
	        }

        	$db->db_close();

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }














































































































    

    /*

        ******* 

        End oF file 

        ********

    */

}