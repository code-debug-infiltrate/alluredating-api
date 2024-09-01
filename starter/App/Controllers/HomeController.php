<?php 

//Required Files
require_once __DIR__.'/../Models/Home.php';



class HomeController
{


    //Method to register new user account
    public function coy_info()
    {
        //Register Model
        $model_connect = new Home();

        //Model Function Call
        $data = $model_connect->coy_info();
        
        return $data; 
    }





























































    

/*

    ******* 

    End oF file 

    ********

*/


}