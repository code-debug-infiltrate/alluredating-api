<?php

//Required Files
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







    //Fetch User Activities
    public function user_activity($param)
    {
        $newParams = array('uniqueid' => $param['uniqueid'], );

        try {
            //Fetch User Credentials For Use!
            $query1 = "SELECT * FROM ". $this->act_table ." WHERE uniqueid = :uniqueid ORDER BY created DESC";
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