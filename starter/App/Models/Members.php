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

























    




    /*

        ******* 

        End oF file 

        ********

    */



}