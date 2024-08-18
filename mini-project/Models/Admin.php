<?php
/** API Model For Admins
 *  Version 1.0.0
 *  March 2024
 *--------------------------------------------------------------------
 *  Model Configuration
 *---------------------------------------------------------------------
**/

//Required Files
require_once './Config/Db.php';



class Admin
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

    //Database Connection
    private $con;

    //Function to construct pdo interface for connection
    public function __construct($db){
        $this->con = $db;
    }

    //Record Activity
    public function record_activity($params)
    {
        try {
            
            $query = "INSERT INTO ". $this->act_table ." (id, username, category, details) VALUES (:id, :username, :category, :details)";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(':id', $params['id']);
            $stmt->bindParam(':username', $params['username']);
            $stmt->bindParam(':category', $params['category']);
            $stmt->bindParam(':details', $params['details']);
            $stmt->execute(); 

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }






    //Company Record
    public function coy_info()
    {
        try {
            
            $query = "SELECT * FROM ". $this->coy_table ." WHERE status = 'Active' LIMIT 1";
            $stmt = $this->con->prepare($query);
            //$stmt->bindParam(':status', "Active");
            $stmt->execute();
            $coy = $stmt->fetch(PDO::FETCH_ASSOC); 
            
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