<?php
/** API Model For Registration
 *  Version 1.0.0
 *  March 2024
 *--------------------------------------------------------------------
 *  Model Configuration
 *---------------------------------------------------------------------
**/

//Required Files
require 'Admin.php';
require_once './Config/Db.php';
require './Mails/RegistrationAlert.php';



class Register

{
    //User Properties
    public $uniqueid;
    public $fname;
    public $lname;
    public $username;
    public $email;
    public $password;
    public $code;
    public $hash;
    public $ip;
    public $user_agent;

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

        try {

        	$query = "SELECT * FROM " . $this->u_table ." WHERE uniqueid = :uniqueid || email = :email LIMIT 1";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(':uniqueid', $params['uniqueid']);
            $stmt->bindParam(':email', $params['email']);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);    
            $RowCount = $stmt->rowCount();

            // Checking all User credentials...
            if ($RowCount === 0) {

                $newPass = password_hash($params['password'], PASSWORD_DEFAULT);
                
	            $query = "INSERT INTO ". $this->u_table ." (uniqueid, username, email, password, code, hash, ip, user_agent) VALUES (:uniqueid, :username, :email, :password, :code, :hash, :ip, :user_agent)";
                $stmt = $this->con->prepare($query);
                $stmt->bindParam(':uniqueid', $params['uniqueid']);
                $stmt->bindParam(':username', $params['username']);
                $stmt->bindParam(':email', $params['email']);
                $stmt->bindParam(':password',  $newPass);
                $stmt->bindParam(':code', $params['code']);
                $stmt->bindParam(':hash', $params['hash']);
                $stmt->bindParam(':ip', $params['ip']);
                $stmt->bindParam(':user_agent', $params['user_agent']);
                $stmt->execute();

	            $query1 = "INSERT INTO ". $this->p_table ." (uniqueid, fname, lname) VALUES (:uniqueid, :fname, :lname)";
                $stmt = $this->con->prepare($query1);
                $stmt->bindParam(':uniqueid', $params['uniqueid']);
                $stmt->bindParam(':fname', $params['fname']);
                $stmt->bindParam(':lname', $params['lname']);
                $stmt->execute(); 

                //Fetch Company Details For Email
                $coy_info = $admin_model->coy_info();
			    //Send Email Alert To User
	            Mailer::mailer('RegistrationAlert')->newmember_alert($params, $coy_info);

			    //Record Activity
	            $info = array('id' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Registration", 'details' => $params['username']." Just Registered", ); 
	            $admin_model->record_activity($info);

	            return true;

	        } else {

	            return false;
	        }
        	
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

