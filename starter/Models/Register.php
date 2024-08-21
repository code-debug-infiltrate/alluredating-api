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
require_once './Mails/RegistrationAlert.php';




class Register

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

    //Method to register new user account
    public function new_member($params)
    {
        //open database connection
        $database = new Db();
        $db = $database->db_Connect();
        //Admin Model
        $admin_model = new Admin($db);
        $send_mail = new RegistrationAlert();
        //Fetch Company Details For Email
        $coy_info = $admin_model->coy_info();
        
        $newParams = array('uniqueid' => $params['uniqueid'], 'email' => $params['email'], );
        $newParams1 = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'email' => $params['email'], 'password' => password_hash($params['password'], PASSWORD_DEFAULT), 'code' => $params['code'], 'hash' => $params['hash'], 'ip' => $params['ip'], 'user_agent' => $params['user_agent'], );
        $newParams2 = array('uniqueid' => $params['uniqueid'], 'fname' => $params['fname'], 'lname' => $params['lname'], 'dob' => $params['dob'], 'gender' => $params['gender'],  );

        try {

        	$query = "SELECT * FROM " . $this->u_table ." WHERE uniqueid = :uniqueid || email = :email LIMIT 1";
            $stmt = $this->con->prepare($query);
            //var_dump($newParams);
            foreach ($newParams as $key => &$value) {
                $stmt->bindParam($key, $value, PDO::PARAM_STR);
            }
            $stmt->execute($newParams);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);    
            $RowCount = $stmt->rowCount();

            // Checking all User credentials...
            if ($RowCount === 0) {
                
                $query = "INSERT INTO ". $this->u_table ." (uniqueid, username, email, password, code, hash, ip, user_agent) VALUES (:uniqueid, :username, :email, :password, :code, :hash, :ip, :user_agent)";
                $stmt = $this->con->prepare($query);
                foreach ($newParams1 as $key => &$value) {
                    $stmt->bindParam($key, $value, PDO::PARAM_STR);
                }
                $stmt->execute($newParams1);

	            $query1 = "INSERT INTO ". $this->p_table ." (uniqueid, fname, lname, dob, gender) VALUES (:uniqueid, :fname, :lname, :dob, :gender)";
                $stmt = $this->con->prepare($query1);
                foreach ($newParams2 as $key => &$value) {
                    $stmt->bindParam($key, $value, PDO::PARAM_STR);
                }
                $stmt->execute($newParams2);
                
			    //Send Email Alert To User
	            $send_mail->newmember_alert($params, $coy_info);
			    //Record Activity
	            $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Registration", 'details' => $params['username']." Just Registered", ); 
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








    //Method to verify new user account
    public function verify_email($params)
    {
        //open database connection
        $database = new Db();
        $db = $database->db_Connect();
        //Admin Model
        $admin_model = new Admin($db);
        $send_mail = new RegistrationAlert();
        //Fetch Company Details For Email
        $coy_info = $admin_model->coy_info();

        $newParams = array('uniqueid' => $params['uniqueid'], 'hash' => $params['hash'], 'status' => "New",  );
        
        try {

        	$query = "SELECT * FROM " . $this->u_table ." WHERE uniqueid = :uniqueid AND hash = :hash AND status = :status LIMIT 1";
            $stmt = $this->con->prepare($query);
            //var_dump($newParams);
            foreach ($newParams as $key => &$value) {
                $stmt->bindParam($key, $value, PDO::PARAM_STR);
            }
            $stmt->execute($newParams);
            $user = $stmt->fetch(PDO::FETCH_ASSOC); 
            // Checking all User credentials...
            if ($user != NULL) {
                
                $newParams1 = array('uniqueid' => $params['uniqueid'], 'status' => "Activated", );
                $query = "UPDATE ". $this->u_table ." SET `status` = :status WHERE uniqueid = :uniqueid LIMIT 1";
                $stmt = $this->con->prepare($query);
                foreach ($newParams1 as $key => &$value) {
                    $stmt->bindParam($key, $value, PDO::PARAM_STR);
                }
                $stmt->execute($newParams1);
                
			    //Send Email Alert To User
	            $send_mail->verification_alert($user, $coy_info);
			    //Record Activity
	            $info = array('uniqueid' => $user['uniqueid'], 'username' => $user['username'], 'category' => "Registration", 'details' => $user['username']." Verified Account.", ); 
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

