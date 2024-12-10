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
    //Blog Posts
    protected $blog_table = "app_blogposts"; //Blog Posts Table
    protected $blog_action_table = "app_blogposts_actions"; //Blog Posts Table





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





    //Blog Posts Records
    public function get_latest_blog_posts()
    {
        try {
            $data = array('status' => "Publish");
            $query = "SELECT * FROM ". $this->blog_table ." WHERE status = :status ORDER BY created DESC LIMIT 60";
            $coy = $this->fetch_spec($data, $query);
            return $coy;

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }



    //Blog Posts Records
    public function get_random_blog_posts($params)
    {
        try {
            
            if ($params['category'] == "all") {

                $data = array('status' => "Publish", );
                $query = "SELECT * FROM ". $this->blog_table ." WHERE status = :status ORDER BY RAND() DESC LIMIT 120";
                $coy = $this->fetch_spec($data, $query);
                return $coy;

            } else {

                $data = array('category' => $params['category'], 'status' => "Publish", );
                $query = "SELECT * FROM ". $this->blog_table ." WHERE status = :status AND category = :category ORDER BY RAND() DESC LIMIT 120";
                $coy = $this->fetch_spec($data, $query);
                return $coy;

            }

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }




    //Blog Posts Records
    public function get_blog_posts_actions()
    {
        try {
            //$data = array('status' => "Publish");
            $query = "SELECT * FROM ". $this->blog_action_table ." ORDER BY created DESC";
            $coy = $this->fetch_all($query);

            return $coy;

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }




    //Get Blog Post Record Details
    public function get_blog_post_details($params)
    {
        try {
            $c = array('postid' => $params['postid'], );
            $query = "SELECT * FROM ". $this->blog_table ." WHERE postid = :postid LIMIT 1";
            $coy = $this->fetch_row($c, $query);

        if ($coy) { return $coy; } else { return false; }

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }
 




    //Get Blog Post Record Details
    public function blog_post_views($params)
    {
        try {
            $c = array('postid' => $params['postid'], );
            $query = "SELECT * FROM ". $this->blog_action_table ." WHERE postid = :postid LIMIT 1";
            $check = $this->fetch_row($c, $query);

            if ($check) {
            
                $e = array('postid' => $params['postid'], 'views' => $check['views'] + 1, );

                $query = "UPDATE ". $this->blog_action_table ." SET `views` = :views WHERE postid = :postid LIMIT 1";

                $this->update($e, $query);

                return true;

            } else {

                $fill = array('postid' => $params['postid'], 'views' => "1",  ); 

                $query1 = "INSERT INTO ". $this->blog_action_table ." (postid, views ) VALUES (:postid, :views )";

                $this->insert($fill, $query1);

                return true;
            }

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }
 




        
    //Get Blog Post Record Details
    public function blog_post_action($params)
    {
        try {
            $c = array('postid' => $params['postid'], );
            $query = "SELECT * FROM ". $this->blog_action_table ." WHERE postid = :postid LIMIT 1";
            $check = $this->fetch_row($c, $query);

            if ($check) {
            
                if ($params['status'] == "likes") {
                    $e = array('postid' => $params['postid'], 'likes' => $check['likes'] + 1, );
                    $query = "UPDATE ". $this->blog_action_table ." SET `likes` = :likes WHERE postid = :postid LIMIT 1";
                } elseif ($params['status'] == "dislikes") {
                    $e = array('postid' => $params['postid'], 'dislikes' => $check['dislikes'] + 1, ); 
                    $query = "UPDATE ". $this->blog_action_table ." SET `dislikes` = :dislikes WHERE postid = :postid LIMIT 1";
                } elseif ($params['status'] == "smile") {
                    $e = array('postid' => $params['postid'], 'smile' => $check['smile'] + 1, ); 
                    $query = "UPDATE ". $this->blog_action_table ." SET `smile` = :smile WHERE postid = :postid LIMIT 1";
                }
                $this->update($e, $query);

                return true;

            } else {
                
                if ($params['status'] == "likes") {
                    $fill = array('postid' => $params['postid'], 'likes' => "1",  );
                    $query1 = "INSERT INTO ". $this->blog_action_table ." (postid, likes ) VALUES (:postid, :likes )";
                } elseif ($params['status'] == "dislikes") {
                    $fill = array('postid' => $params['postid'], 'dislikes' => "1",  );
                    $query1 = "INSERT INTO ". $this->blog_action_table ." (postid, dislikes ) VALUES (:postid, :dislikes )";
                } elseif ($params['status'] == "smile") {
                    $fill = array('postid' => $params['postid'], 'smile' => "1",  );
                    $query1 = "INSERT INTO ". $this->blog_action_table ." (postid, smile ) VALUES (:postid, :smile )";
                }  
                $this->insert($fill, $query1);

                return true;
            }

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