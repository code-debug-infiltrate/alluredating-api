<?php

//Required Files
require_once __DIR__.'/../../Config/Model.php';



class Admin extends Model
{

    //Tables In Use
    protected $act_table = "app_activity"; //Activity Table
    protected $u_table = "app_users";  //Users Table
    protected $p_table = "app_profile";  //Profile Table
    protected $coy_table = "app_coy_info";  //Company Information Table
    protected $cur_table = "app_currency";  //Currency Table
    protected $msg_table = "app_msgreport";  //Message Report Table
    protected $notify_table = "app_notify";  //Notification Table
    protected $sub_table = "app_subscribe";  //Subscribe Table
    protected $v_table = "app_visitors";  //Visitors Table
    protected $api_table = "app_thirdpartyapi";  //Third Party API Table
    //User Preferences
    protected $album_table = "app_user_album";  // Album Table
    protected $wnts_table = "app_user_wants";  // Preferences Table
    protected $lng_table = "app_user_languages";  //Languages Table
    protected $wkedu_table = "app_user_workeducation";  //Work & Education History Table
    protected $int_table = "app_user_interests";  //Interests Table
    protected $uact_table = "app_user_activity";  //Activity For Users Table









    //Record Activity
    public function record_activity($params)
    {
        try {
            
            $query = "INSERT INTO ". $this->act_table ." (uniqueid, username, category, details) VALUES (:uniqueid, :username, :category, :details)";
            $result = $this->insert($params, $query); 

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }




    //Company Record
    public function coy_info()
    {
        try {
            $data = array('status' => "Publish");
            $query = "SELECT * FROM ". $this->coy_table ." WHERE status = :status LIMIT 1";
            $coy = $this->fetch_row($data, $query);
            return $coy;

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