<?php

//Required Files
require_once __DIR__.'/../../Config/Model.php';



class Home extends Model
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





    


    //Capture Visitors
    public function visitor_info($data)
    {
        $d = array('vdate' => $data['date'], 'details' => $data['user_agent'], ); 

        try {

            $query = "SELECT * FROM ". $this->v_table ." WHERE details = :details AND vdate = :vdate LIMIT 1";

            $check = $this->fetch_row($d, $query);

            if ($check) {
            
                $e = array('vdate' => $data['date'], 'count' => $check['count'] + 1, 'details' => $check['details'], );

                $query = "UPDATE ". $this->v_table ." SET `count` = :count WHERE `details` = :details AND vdate = :vdate LIMIT 1";

                $this->update($e, $query);

                return true;

            } else {

                $fill = array('ip' => $data['ip'], 'vdate' => $data['date'], 'vtime' => $data['time'], 'count' => "1", 'details' => $data['user_agent'], ); 

                $query1 = "INSERT INTO ". $this->v_table ." (ip, vdate, vtime, count, details) VALUES (:ip, :vdate, :vtime, :count, :details)";

                $this->insert($fill, $query1);

                return true;
            }

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
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