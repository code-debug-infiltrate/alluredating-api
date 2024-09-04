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
    //User Preferences
    protected $album_table = "app_user_album";  // Album Table
    protected $wnts_table = "app_user_wants";  //User Preferences Table
    protected $lng_table = "app_user_languages";  //Languages Table
    protected $wkedu_table = "app_user_workeducation";  //Work & Education History Table
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
            $query1 = "SELECT * FROM ". $this->wnts_table ." WHERE uniqueid = :uniqueid LIMIT 1";
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

        $newParams = array('uniqueid' => $params['uniqueid'], 'interest' => $params['interest'], );
        
        try {
        	$query = "SELECT * FROM " . $this->int_table ." WHERE uniqueid = :uniqueid AND interest = :interest LIMIT 1";
            $interest = $this->fetch_row($newParams, $query); 
            // Checking all User credentials...
            if ($interest == null) {

                $query = "SELECT count(*) FROM " . $this->int_table ." WHERE uniqueid = :uniqueid ";
                $count = $this->counter_spec($newParams, $query); ;

                if ($count < '5') {

                    $query = "INSERT INTO ". $this->int_table ." (uniqueid, interest) VALUES (:uniqueid, :interest)";
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
            $query1 = "SELECT * FROM ". $this->wkedu_table ." WHERE uniqueid = :uniqueid ORDER BY created DESC";
            $workeducationInfo = $this->fetch_spec($newParams, $query1); 

            return $workeducationInfo;

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







































    




    /*

        ******* 

        End oF file 

        ********

    */



}