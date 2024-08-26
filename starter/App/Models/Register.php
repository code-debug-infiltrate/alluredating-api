<?php

//Required Files
require_once __DIR__.'/../../Config/Model.php';
require_once __DIR__.'/../Models/Admin.php';
//require_once __DIR__.'/../Mails/RegistrationAlert.php';


class Register extends Model

{

    //Tables In Use
    protected $u_table = "app_users"; //Users Table
    protected $p_table = "app_profile";  //Profile Table
    protected $sub_table = "app_subscribe";  //Subscribe Table


    //Method to register new user account
    public function new_member($params)
    {
        //Admin Model
        $admin_model = new Admin();
        //$send_mail = new RegistrationAlert();
        //Fetch Company Details For Email
        //$coy_info = $admin_model->coy_info();
        
        $newParams = array('uniqueid' => $params['uniqueid'], 'email' => $params['email'], );
        $newParams1 = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'email' => $params['email'], 'password' => password_hash($params['password'], PASSWORD_DEFAULT), 'code' => $params['code'], 'hash' => $params['hash'], 'ip' => $params['ip'], 'user_agent' => $params['user_agent'], );
        $newParams2 = array('uniqueid' => $params['uniqueid'], 'fname' => $params['fname'], 'lname' => $params['lname'], 'dob' => $params['dob'], 'gender' => $params['gender'],  );

        try {
        	$query = "SELECT * FROM " . $this->u_table ." WHERE uniqueid = :uniqueid || email = :email LIMIT 1";
            $RowCount = $this->fetch_row($newParams, $query); 

            // Checking all User credentials...
            if (!$RowCount) {
                $query = "INSERT INTO ". $this->u_table ." (uniqueid, username, email, password, code, hash, ip, user_agent) VALUES (:uniqueid, :username, :email, :password, :code, :hash, :ip, :user_agent)";
                $this->insert($newParams1, $query); 

	            $query1 = "INSERT INTO ". $this->p_table ." (uniqueid, fname, lname, dob, gender) VALUES (:uniqueid, :fname, :lname, :dob, :gender)";
                $this->insert($newParams2, $query1); 
                
			    //Send Email Alert To User
	            //$send_mail->newmember_alert($params, $coy_info);
			    //Record Activity
	            $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Registration", 'details' => $params['username']." Just Registered", ); 
                $admin_model->record_activity($info);

	            return true;

	        } else {

	            return false;
	        }

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }








    //Method to verify new user account
    public function verify_email($params)
    {
        //Admin Model
        $admin_model = new Admin();
        //$send_mail = new RegistrationAlert();
        //Fetch Company Details For Email
        //$coy_info = $admin_model->coy_info();

        $newParams = array('uniqueid' => $params['uniqueid'], 'hash' => $params['hash'], 'status' => "New",  );
        
        try {
        	$query = "SELECT * FROM " . $this->u_table ." WHERE uniqueid = :uniqueid AND hash = :hash AND status = :status LIMIT 1";
            $user = $this->fetch_row($newParams, $query); 
            // Checking all User credentials...
            if ($user != NULL) {
                $newParams1 = array('uniqueid' => $params['uniqueid'], 'status' => "Activated", );
                $query = "UPDATE ". $this->u_table ." SET `status` = :status WHERE uniqueid = :uniqueid LIMIT 1";
                $this->update($newParams1, $query); 
			    //Send Email Alert To User
	            //$send_mail->verification_alert($user, $coy_info);
			    //Record Activity
	            $info = array('uniqueid' => $user['uniqueid'], 'username' => $user['username'], 'category' => "Registration", 'details' => $user['username']." Verified Account.", ); 
                $admin_model->record_activity($info);

	            return true;

	        } else {

	            return false;
	        }

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }

    }









    //Method to verify new user account
    public function user_subscriber($params)
    {
        //Admin Model
        $admin_model = new Admin();
        //$send_mail = new RegistrationAlert();
        //Fetch Company Details For Email
        //$coy_info = $admin_model->coy_info();

        $newParams = array('email' => $params['email'], );
        
        try {
        	$query = "SELECT * FROM " . $this->sub_table ." WHERE email = :email LIMIT 1";
            $user = $this->fetch_row($newParams, $query); 
            // Checking all User credentials...
            if ($user) {

                if ($user['status'] == "Unactive") {

                    $newParams1 = array('email' => $params['email'], 'status' => "Active", );
                    $query = "UPDATE ". $this->sub_table ." SET `status` = :status WHERE email = :email LIMIT 1";
                    $this->update($newParams1, $query);
                    
                    //Record Activity
                    $info = array('uniqueid' => $user['email'], 'username' => $user['username'], 'category' => "Newsletter", 'details' => $user['email']." Reactivated Subscriber Alert.", ); 
                    $admin_model->record_activity($info);
    
                    return true;
                }

            } else {

                $newParams0 = array('email' => $params['email'], 'ip' => $params['ip'], 'user_agent' => $params['user_agent'], );
                $query = "INSERT INTO ". $this->sub_table ." (email, ip, user_agent) VALUES (:email, :ip, :user_agent)";
                $this->insert($newParams0, $query); 
                //Send Email Alert To User
	            //$send_mail->subscriber_alert($newParams0, $coy_info);
			    //Record Activity
	            $info = array('uniqueid' => $newParams0['email'], 'username' => $newParams0['email'], 'category' => "Newsletter", 'details' => $newParams0['email']." Subscribed To Newsletter.", ); 
                $admin_model->record_activity($info);

	            return true;

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

