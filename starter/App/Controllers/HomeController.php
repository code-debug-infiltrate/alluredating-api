<?php 

//Required Files
require_once __DIR__.'/../Models/Home.php';



class HomeController
{


    //Method to Get Company Information
    public function coy_info()
    {
        //Register Model
        $model_connect = new Home();

        //Model Function Call
        $data = $model_connect->coy_info();
        
        return $data; 
    }




    //Method to Register Visitor Information
    public function visitor_info($params)
    {
        //Register Model
        $model_connect = new Home();
        $info = array_map("htmlspecialchars", $params);
        //Model Function Call
        $data = $model_connect->visitor_info($info);
        
        return $data; 
    }




    //Method to Get Published Posts
    public function get_latest_blog_posts($params)
    {
        //Register Model
        $model_connect = new Home();
        $info = array_map("htmlspecialchars", $params);
        //Model Function Call
        $data = $model_connect->get_latest_blog_posts($info);
        
        return $data; 
    }





























































    

/*

    ******* 

    End oF file 

    ********

*/


}