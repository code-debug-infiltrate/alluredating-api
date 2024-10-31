<?php

//Required Files
require_once __DIR__.'/../../Config/Model.php';



class Admin extends Model
{

    //Tables In Use
    protected $act_table = "app_activity"; //Activity Table
    protected $u_table = "app_users";  //Users Table
    protected $p_table = "app_profile";  //Profile Table
    protected $coy_table = "app_coy_info";  //Users Table
    protected $bank_table = "app_bank_details";  //Bank Transfer Table
    protected $exchange_table = "app_currency_exchange";  //Exchange Rate Table
    protected $cur_table = "app_currency";  //Currency Table
    protected $notify_table = "app_notify";  //Notification Table
    protected $api_table = "app_thirdpartyapi";  //Third Party API Table
    protected $delAcc_table = "app_delete_account";  //Delete Account  Table
    //User Preferences
    protected $album_table = "app_user_album";  // Album Table
    protected $self_table = "app_user_self";  //User Self Table
    protected $actions_table = "app_user_profile_actions";  //User Actions Table
    protected $buddy_table = "app_user_buddy";  //User Buddy Table
    protected $buddychats_table = "app_user_buddy_chats";  //User Buddy Chats
    protected $buddychatreply_table = "app_user_buddy_chat_reply";  //User Buddy Chat Reply
    protected $views_table = "app_user_views";  //User Views Table
    protected $pref_table = "app_user_preferences";  //User Preferences Table
    protected $lng_table = "app_user_languages";  //Languages Table
    protected $workedu_table = "app_user_workeducation";  //Work & Education History Table
    protected $int_table = "app_user_interests";  //Interests Table
    protected $uact_table = "app_user_activity";  //Activity For Users Table
    protected $post_table = "app_users_posts";  //Posts For Users Table
    protected $postimg_table = "app_post_files";  //Posts Images For Users Table
    protected $postcomments_table = "app_post_comments";  //Post Comments/Messages
    protected $postcommentreply_table = "app_post_comment_reply";  //Post Comment Reply
    protected $postact_table = "app_post_actions";  //Post Actions
    protected $urpostact_table = "app_user_post_actions";  //User Post Actions
    protected $postreport_table = "app_post_reports"; //User Post Reports
    protected $subpayment_table = "app_subscription_payment"; //User Subscription Payment











    //Bank Transfer Record
    public function get_bank_info()
    {
        try {
            $data = array('status' => "Publish");
            $query = "SELECT * FROM ". $this->bank_table ." WHERE status = :status LIMIT 1";
            $coy = $this->fetch_row($data, $query);
            return $coy;

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }




    //Create & Update Currency Information
    public function create_currency_information($data = array())
    {
        //Admin Model
        $admin_model = new Admin();

        $a = array('currency' => $data['currency'], );
        $b = array('currency' => $data['currency'], 'rate' => $data['rate'], );
        $c = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], );

        try {
            $query = "SELECT * FROM ". $this->cur_table ." WHERE currency = :currency LIMIT 1";
            $check = $this->fetch_row($a, $query);

            if ($check) {

                $query = "UPDATE ". $this->cur_table ." SET `rate` = :rate WHERE `currency` = :currency LIMIT 1";
                $this->update($b, $query); 

                //Record Activity
                $info = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], 'category' => "Settings", 'details' => $data['username']." Updated Exchange Rate ".$data['currency']." To ".$data['rate'], ); 
                $admin_model->record_activity($info);

                return true;

            } else {

                $query = "INSERT INTO ". $this->cur_table ."(rate, currency) VALUES (:rate, :currency)";
                $this->insert($b, $query); 

                //Record Activity
                $info = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], 'category' => "Settings", 'details' => $data['username']." Created Exchange Rate ".$data['currency']." To ".$data['rate'], ); 
                $admin_model->record_activity($info);

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


    //Currency Record
    public function get_currency_info()
    {
        try {
            $data = array('id' => "1");
            $query = "SELECT * FROM ". $this->cur_table ." WHERE id = :id LIMIT 1";
            $coy = $this->fetch_row($data, $query);
            return $coy;

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }



    //Create & Update Exchange Rate Information
    public function create_exchange_information($data = array())
    {
        //Admin Model
        $admin_model = new Admin();

        $a = array('currency' => $data['currency'], );
        $b = array('currency' => $data['currency'], 'rate' => $data['rate'], );
        $c = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], );

        try {
            $query = "SELECT * FROM ". $this->exchange_table ." WHERE currency = :currency LIMIT 1";
            $check = $this->fetch_row($a, $query);

            if ($check) {

                $query = "UPDATE ". $this->exchange_table ." SET `rate` = :rate WHERE `currency` = :currency LIMIT 1";
                $this->update($b, $query); 

                //Record Activity
                $info = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], 'category' => "Settings", 'details' => $data['username']." Updated Exchange Rate ".$data['currency']." To ".$data['rate'], ); 
                $admin_model->record_activity($info);

                return true;

            } else {

                $query = "INSERT INTO ". $this->exchange_table ."(rate, currency) VALUES (:rate, :currency)";
                $this->insert($b, $query); 

                //Record Activity
                $info = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], 'category' => "Settings", 'details' => $data['username']." Created Exchange Rate ".$data['currency']." To ".$data['rate'], ); 
                $admin_model->record_activity($info);

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



    //Exchange Rate Record
    public function get_exchange_info()
    {
        try {
            $data = array('status' => "Trash");
            $query = "SELECT * FROM ". $this->exchange_table ." WHERE status != :status ORDER BY created DESC";
            $coy = $this->fetch_spec($data, $query);
            return $coy;

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }










    //Record Activity
    public function record_activity($params)
    {
        try {
            $query = "INSERT INTO ". $this->act_table ." (uniqueid, username, category, details) VALUES (:uniqueid, :username, :category, :details)";
            $this->insert($params, $query); 

            return true;

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