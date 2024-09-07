<?php

//Required Files
require_once __DIR__.'/../Models/Admin.php';
require_once __DIR__.'/../../Config/Model.php';



class Members extends Model
{

    //Tables In Use
    protected $act_table = "app_activity"; //Activity Table
    protected $u_table = "app_users";  //Users Table
    protected $p_table = "app_profile";  //Profile Table
    protected $cur_table = "app_currency";  //Currency Table
    protected $notify_table = "app_notify";  //Notification Table
    protected $api_table = "app_thirdpartyapi";  //Third Party API Table
    protected $delAcc_table = "app_delete_account";  //Delete Account  Table
    //User Preferences
    protected $album_table = "app_user_album";  // Album Table
    protected $pref_table = "app_user_preferences";  //User Preferences Table
    protected $attr_table = "app_user_attributes";  //User Attributes Table
    protected $lng_table = "app_user_languages";  //Languages Table
    protected $workedu_table = "app_user_workeducation";  //Work & Education History Table
    protected $int_table = "app_user_interests";  //Interests Table
    protected $uact_table = "app_user_activity";  //Activity For Users Table





    //Fetch User Credentials
    public function user_info($param)
    {
        $newParams = array('uniqueid' => $param['uniqueid'], );

        try {
            //Fetch User Credentials For Use!
            $query1 = "SELECT * FROM ". $this->u_table .", ". $this->p_table ." WHERE ". $this->u_table .".uniqueid = :uniqueid AND ". $this->p_table .".uniqueid = :uniqueid LIMIT 1";
            $userInfo = $this->fetch_row($newParams, $query1); 

            return $userInfo;

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }




    //Update Username
    public function update_username($data = array())
    {
        //Admin Model
        $admin_model = new Admin();

        $b = array('username' => $data['newUsername'], );
        $c = array('uniqueid' => $data['uniqueid'], 'username' => $data['newUsername'], );

        try {
            $query = "SELECT * FROM ". $this->u_table ." WHERE username = :username LIMIT 1";
            $check = $this->fetch_row($b, $query);

            if (!$check) {

                $query = "UPDATE ". $this->u_table ." SET `username` = :username WHERE `uniqueid` = :uniqueid LIMIT 1";
                $this->update($c, $query); 

                //Record Activity
                $info = array('uniqueid' => $data['uniqueid'], 'username' => $data['newUsername'], 'category' => "Settings", 'details' => $data['username']." Updated Username To ".$data['newUsername'], ); 
                $admin_model->record_activity($info);

                return true;

            } else {

                return false;
            }

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 

            return $data;  
        }
    }




    //Update User Password
    public function update_password($data = array())
    {
        //Admin Model
        $admin_model = new Admin();

        $c = array('uniqueid' => $data['uniqueid'], );
        $d = array('uniqueid' => $data['uniqueid'], "password" => password_hash($data['newpass'], PASSWORD_DEFAULT), );

        try {
                $query = "SELECT * FROM ". $this->u_table ." WHERE uniqueid = :uniqueid LIMIT 1";
                $check = $this->fetch_row($c, $query);

                if (password_verify($data['oldpass'], $check['password'])) {
                    // code...
                    $query = "UPDATE ". $this->u_table ." SET `password` = :password WHERE `uniqueid` = :uniqueid LIMIT 1";
                    $this->update($d, $query);
                    //Record Activity
                    $info = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], 'category' => "Settings", 'details' => $data['username']." Updated Password Record", ); 
                    $admin_model->record_activity($info);

                    return true;

                } else {

                    return false;
                }

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            );

            return $data;   
        }           
    }




     //Method to Update Location
     public function update_location($params)
     {
         //Admin Model
         $admin_model = new Admin();
         $a = array('uniqueid' => $params['uniqueid'], );
         $newParams = array('uniqueid' => $params['uniqueid'], 'address' => $params['address'], 'city' => $params['city'], 'country' => $params['country'], );
         
         try {
             $query = "SELECT * FROM " . $this->p_table ." WHERE uniqueid = :uniqueid LIMIT 1";
             $loc = $this->fetch_row($a, $query); 
             // Checking all User credentials...
             if ($loc) {
 
                $query = "UPDATE ". $this->p_table ." SET address = :address, city = :city, country = :country WHERE uniqueid = :uniqueid LIMIT 1";
                $this->update($newParams, $query); 
                
                //Record Activity
                $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Location", 'details' => $params['username']." Updated Their Address", ); 
                $admin_model->record_activity($info);

                return true;

            } else {

                return false;
            }
 
         } catch (Exception $e) {
 
             return "There is some errors: " . $e->getMessage();
         }
     }




     //Method to Update Work N Education
     public function update_workneducation($params)
     {
         //Admin Model
         $admin_model = new Admin();
         $a = array('uniqueid' => $params['uniqueid'], 'category' => $params['category'], 'name' => $params['name'],);
         
         try {
             $query = "SELECT * FROM " . $this->workedu_table ." WHERE uniqueid = :uniqueid AND name = :name AND category = :category LIMIT 1";
             $loc = $this->fetch_row($a, $query); 
             // Checking all User credentials...
             if (!$loc) {

                $newParams = array('uniqueid' => $params['uniqueid'], 'name' => $params['name'], 'category' => $params['category'], 'end' => $params['to'], 'start' => $params['from'], 'details' => $params['details'], );
                    
                $query = "INSERT INTO ". $this->workedu_table ." (uniqueid, name, start, end, category, details) VALUES (:uniqueid, :name, :start, :end, :category, :details)";
                $this->insert($newParams, $query); 
                
                //Record Activity
                $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Work/Education", 'details' => $params['username']." Added ".$params['name'], ); 
                $admin_model->record_activity($info);

                return true;

            } else {

                return false;
            }
 
         } catch (Exception $e) {
 
             return "There is some errors: " . $e->getMessage();
         }
     }



    
    //Method to Update Bio
    public function update_bio($params)
    {
        //Admin Model
        $admin_model = new Admin();
        $a = array('uniqueid' => $params['uniqueid'], );
        $newParams = array('uniqueid' => $params['uniqueid'], 'fname' => $params['fname'], 'lname' => $params['lname'], 'number' => $params['number'], 'occupation' => $params['occupation'], 'gender' => $params['gender'], 'dob' => $params['dob'], 'details' => $params['details'], );
        
        try {
            $query = "SELECT * FROM " . $this->p_table ." WHERE uniqueid = :uniqueid LIMIT 1";
            $bio = $this->fetch_row($a, $query); 
            // Checking all User credentials...
            if ($bio) {

                $query0 = "UPDATE ". $this->p_table ." SET fname = :fname, lname = :lname, number = :number, occupation = :occupation, gender = :gender, dob = :dob, details = :details WHERE uniqueid = :uniqueid LIMIT 1";
                $this->update($newParams, $query0); 
                
                //Record Activity
                $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Settings", 'details' => $params['username']." Updated Their Bio Details", ); 
                $admin_model->record_activity($info);

                return true;

            } else {

                return false;
        }

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }



    //Fetch User Activities
    public function user_activity($param)
    {
        $newParams = array('uniqueid' => $param['uniqueid'], );

        try {
            //Fetch User Credentials For Use!
            $query1 = "SELECT * FROM ". $this->act_table ." WHERE uniqueid = :uniqueid ORDER BY created DESC LIMIT 50";
            $activityInfo = $this->fetch_spec($newParams, $query1); 

            return $activityInfo;

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }






    //Fetch User Album
    public function user_album($param)
    {
        $newParams = array('uniqueid' => $param['uniqueid'], );

        try {
            //Fetch User Credentials For Use!
            $query1 = "SELECT * FROM ". $this->album_table ." WHERE uniqueid = :uniqueid ORDER BY created DESC";
            $albumInfo = $this->fetch_spec($newParams, $query1); 

            return $albumInfo;

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }






    //Fetch User preferences
    public function user_preference($param)
    {
        $newParams = array('uniqueid' => $param['uniqueid'], );

        try {
            //Fetch User Credentials For Use!
            $query1 = "SELECT * FROM ". $this->pref_table ." WHERE uniqueid = :uniqueid LIMIT 1";
            $preferenceInfo = $this->fetch_row($newParams, $query1); 

            return $preferenceInfo;

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }






    //Method to Create New Interest
    public function create_interest($params)
    {
        //Admin Model
        $admin_model = new Admin();
        $newParams = array('uniqueid' => $params['uniqueid'], 'details' => $params['interest'], );
        
        try {
        	$query = "SELECT * FROM " . $this->int_table ." WHERE uniqueid = :uniqueid AND details = :details LIMIT 1";
            $inte = $this->fetch_row($newParams, $query); 
            // Checking all User credentials...
            if ($inte == null) {
                $newParam = array('uniqueid' => $params['uniqueid'], );

                $query = "SELECT count(*) FROM " . $this->int_table ." WHERE uniqueid = :uniqueid ";
                $count = $this->counter_spec($newParam, $query); ;

                if ($count < '5') {

                    $query = "INSERT INTO ". $this->int_table ." (uniqueid, details) VALUES (:uniqueid, :details)";
                    $this->insert($newParams, $query); 
                    
                    //Record Activity
                    $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Interests", 'details' => $params['username']." Created ".$params['interest']." Interest.", ); 
                    $admin_model->record_activity($info);

                    return true;

                } else {

                    return false;
                }

            } else {

                return false;
            }

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }



    //Fetch User Interests
    public function user_interests($param)
    {
        $newParams = array('uniqueid' => $param['uniqueid'], );

        try {
            //Fetch User Credentials For Use!
            $query1 = "SELECT * FROM ". $this->int_table ." WHERE uniqueid = :uniqueid ORDER BY created DESC";
            $interestsInfo = $this->fetch_spec($newParams, $query1); 

            return $interestsInfo;

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }






    //Fetch User Work & Education
    public function user_workeducation($param)
    {
        $newParams = array('uniqueid' => $param['uniqueid'], );

        try {
            //Fetch User Credentials For Use!
            $query1 = "SELECT * FROM ". $this->workedu_table ." WHERE uniqueid = :uniqueid ORDER BY created DESC";
            $workeducationInfo = $this->fetch_spec($newParams, $query1); 

            return $workeducationInfo;

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }





     //Method to Create New Interest
     public function create_language($params)
     {
         //Admin Model
         $admin_model = new Admin();
         $a = array('uniqueid' => $params['uniqueid'], );
         $newParams = array('uniqueid' => $params['uniqueid'], 'language' => $params['lang'], );
         
         try {
             $query = "SELECT * FROM " . $this->lng_table ." WHERE uniqueid = :uniqueid AND language = :language LIMIT 1";
             $language = $this->fetch_row($newParams, $query); 
             // Checking all User credentials...
             if ($language == null) {
 
                 $query = "SELECT count(*) FROM " . $this->lng_table ." WHERE uniqueid = :uniqueid ";
                 $count = $this->counter_spec($a, $query); ;
 
                 if ($count < '5') {
 
                     $query = "INSERT INTO ". $this->lng_table ." (uniqueid, language) VALUES (:uniqueid, :language)";
                     $this->insert($newParams, $query); 
                     
                     //Record Activity
                     $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Language", 'details' => $params['username']." Added ".$params['lang']." Language.", ); 
                     $admin_model->record_activity($info);
 
                     return true;
 
                 } else {
 
                     return false;
                 }
 
             } else {
 
                 return false;
             }
 
         } catch (Exception $e) {
 
             return "There is some errors: " . $e->getMessage();
         }
     }





    //Fetch User Languages
    public function user_language($param)
    {
        $newParams = array('uniqueid' => $param['uniqueid'], );

        try {
            //Fetch User Credentials For Use!
            $query1 = "SELECT * FROM ". $this->lng_table ." WHERE uniqueid = :uniqueid ORDER BY created DESC";
            $languageInfo = $this->fetch_spec($newParams, $query1); 

            return $languageInfo;

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }
























    //Login method For All Users
    public function deactivate_account($params)
    {
        $admin_model = new Admin();
        $c = array('uniqueid' => $params['uniqueid'], 'details' => $params['details'], );
        $d = array('uniqueid' => $params['uniqueid'], );
        $e = array('uniqueid' => $params['uniqueid'], 'login_status' => "Logged_out", 'log_session' => "End Session", 'status' => "Deactivated", );

        try {
            $query = "SELECT * FROM ". $this->u_table ." WHERE uniqueid = :uniqueid LIMIT 1";
            $user = $this->fetch_row($d, $query);

            if (password_verify($params['password'], $user['password'])) {

                $query0 = "INSERT INTO ". $this->delAcc_table ." (uniqueid, details) VALUES (:uniqueid, :details)";
                $this->insert($c, $query0); 
                
                $query1 = "UPDATE ". $this->u_table ." SET `login_status` = :login_status, `status` = :status, `log_session` = :log_session WHERE `uniqueid` = :uniqueid LIMIT 1";
                $this->logout($e, $query1);
                //Record Activity
                $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Authentication", 'details' => $params['username']." Deactivated Account", ); 
                $admin_model->record_activity($info);

                unset($params['uniqueid']);
                
                return true;
            } else {

                return false;

            }
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