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




    //Method for forgot password
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