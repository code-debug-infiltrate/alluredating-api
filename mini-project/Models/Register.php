<?php
/** API Model For Registration
 *  Version 1.0.0
 *  March 2024
 *--------------------------------------------------------------------
 *  Model Configuration
 *---------------------------------------------------------------------
**/

//Required Files
require './Config/Db.php';



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

        //Check User Info Parameters
        $checkvalue = array(
            $this->uniqueid => $params['uniqueid'],
            $this->email => $params['email'],
        );

        //Profile Parameters
        $fill = array(
            $this->uniqueid => $params['uniqueid'],
            $this->fname => $params['fname'],
            $this->lname => $params['lname'],
        );

        //User Account Parameters
        $fillable = array(
            $this->uniqueid => $params['uniqueid'],
            $this->username => $params['username'],
            $this->email => $params['email'],
            $this->password => password_hash($params['password'], PASSWORD_DEFAULT),
            $this->code => $params['code'],
            $this->hash => $params['hash'],
            $this->ip => $params['ip'],
            $this->user_agent => $params['user_agent']
        );

        try {

        	$query = "SELECT * FROM " . $this->u_table ." WHERE uniqueid = :uniqueid || email = :email LIMIT 1";

            $stmt = $this->con->prepare($query);
            $check = $stmt->execute($checkvalue);

	        if ($check == false) {

	            $query = "INSERT INTO ". $this->u_table ." (uniqueid, username, email, password, code, hash, ip, user_agent) VALUES (:uniqueid, :username, :email, :password, :code, :hash, :ip, :user_agent)";

	               $this->con->prepare($query);
                   $stmt->execute($fillable);

	            $query1 = "INSERT INTO ". $this->p_table ." (uniqueid, fname, lname) VALUES (:uniqueid, :fname, :lname)";
	               $this->con->prepare($query1);
                   $stmt->execute($fill);            

			/*//Send Email Alert To User
	            $alert = new RegistrationAlert();
	            $alert->new_member($params, $hash, $uniqueid);

			//Record Activity
	            $info = array('id' => $uniqueid, 'username' => $params['username'], 'details' => $params['username']." Just Registered", ); 

	            $activity = new Admin();
	            $activity->record_activity($info);*/

	            return true;

	        } else{

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

