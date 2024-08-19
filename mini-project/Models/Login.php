<?php
/** API Model For Registration
 *  Version 1.0.0
 *  March 2024
 *--------------------------------------------------------------------
 *  Model Configuration
 *---------------------------------------------------------------------
**/

//Required Files

//Models
require_once 'Admin.php';
//DB
require_once './Config/Db.php';
//Mails
require_once './Mails/LoginAlert.php';




class Login

{

    //Tables In Use
    protected $u_table = "app_users"; //Users Table
    protected $p_table = "app_profile";  //Profile Table

    //Database Connection
    private $con;

    //Function to construct pdo interface for connection
    public function __construct($db){
        $this->con = $db;
    }




    //Method for forgot password
    public function check_member($params)
    {
        //open database connection
        $database = new Db();
        $db = $database->db_Connect();
        //Admin Model
        $admin_model = new Admin($db);
        $send_mail = new LoginAlert();
        //Fetch Company Details For Email
        $coy_info = $admin_model->coy_info();


    }




























































    

    /*

        ******* 

        End oF file 

        ********

    */

}