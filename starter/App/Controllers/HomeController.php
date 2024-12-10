<?php 

//Required Files
require_once __DIR__.'/../Models/Home.php';
require_once __DIR__.'/../Models/Admin.php';



class HomeController
{


    //Method to Get Company Information
    public function coy_info()
    {
        //Home Model
        $model_connect = new Home();

        //Model Function Call
        $data = $model_connect->coy_info();
        
        return $data; 
    }




    //Method to Register Visitor Information
    public function visitor_info($params)
    {
        //Home Model
        $model_connect = new Home();
        $info = array_map("htmlspecialchars", $params);
        //Model Function Call
        $data = $model_connect->visitor_info($info);
        
        return $data; 
    }




    //Method to Get Published Posts
    public function get_latest_blog_posts($params)
    {
        //Home Model
        $model_connect = new Home();
        //$info = array_map("htmlspecialchars", $params);
        //Model Function Call
        $data = $model_connect->get_latest_blog_posts();
        
        return $data; 
    }


    //Method to Get Published Posts
    public function get_random_blog_posts($params)
    {
        //Home Model
        $model_connect = new Home();
        $info = array_map("htmlspecialchars", $params);
        //Model Function Call
        $data = $model_connect->get_random_blog_posts($info);
        
        return $data; 
    }



    //Method to Get Published Posts
    public function get_blog_posts_actions($params)
    {
        //Home Model
        $model_connect = new Home();
        //$info = array_map("htmlspecialchars", $params);
        //Model Function Call
        $data = $model_connect->get_blog_posts_actions();
        
        return $data; 
    }



    //Method to Get Published Post Details
    public function get_blog_post_details($params)
    {
        //Home Model
        $model_connect = new Home();
        $info = array_map("htmlspecialchars", $params);

        //Model Function Call
        $data = $model_connect->get_blog_post_details($info);
        
        return $data; 
    }



    //Method to Get Published Post Details
    public function blog_post_views($params)
    {
        //Home Model
        $model_connect = new Home();
        $info = array_map("htmlspecialchars", $params);

        //Model Function Call
        $data = $model_connect->blog_post_views($info);
        
        return $data; 
    }



    //Method to Get Published Post Details
    public function blog_post_action($params)
    {
        //Home Model
        $model_connect = new Home();
        $info = array_map("htmlspecialchars", $params);

        //Model Function Call
        $postAct = $model_connect->blog_post_action($info);

        $data = array(
            'result_info' => 
                array(
                    'code' => "200",
                    'type' => "success",
                    'message' => "Noted... Thank You For Your Feedback!",
                ),
            'result_message' => $postAct,
            );
        
        return $data; 
    }




    //Method to Search Post 
    public function search_blog_post($params)
    {
        //Home Model
        $model_connect = new Admin();
        $info = array_map("htmlspecialchars", $params);

        //Model Function Call
        $postAct = $model_connect->search_blog_post($info);
        
        $data = array(
            'result_info' => 
                array(
                    'code' => "200",
                    'type' => "success",
                    'message' => "Completed...",
                ),
            'result_message' => $postAct,
            ); 
            
        return $data;
    }







































































    

/*

    ******* 

    End oF file 

    ********

*/


}