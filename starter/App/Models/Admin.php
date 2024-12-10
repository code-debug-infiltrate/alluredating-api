<?php

//Required Files
require_once __DIR__.'/../../Config/Model.php';



class Admin extends Model
{

    //Tables In Use
    protected $act_table = "app_activity"; //Activity Table
    protected $vis_table = "app_visitors"; //Visitors Table
    protected $msg_table = "app_msgreport"; //Message report Table
    protected $u_table = "app_users";  //Users Table
    protected $p_table = "app_profile";  //Profile Table
    protected $coy_table = "app_coy_info";  //Users Table
    protected $bank_table = "app_bank_details";  //Bank Transfer Table
    protected $exchange_table = "app_currency_exchange";  //Exchange Rate Table
    protected $cur_table = "app_currency";  //Currency Table
    protected $notify_table = "app_notify";  //Notification Table
    protected $api_table = "app_thirdPartyApi";  //Third Party API Table
    protected $newsletter_table = "app_subscribe";  //Newsletter Subscribers API Table
    protected $sub_table = "app_subscription";  //Subscription Priviledge Table
    protected $subplan_table = "app_subscription_plan";  //Subscription Plan API Table
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
    //Blog Posts
    protected $blog_table = "app_blogposts"; //Blog Posts Table
    protected $blog_action_table = "app_blogposts_actions"; //Blog Posts Table




    //Create & Update Subscription Plan Information
    public function auto_update_transaction_status()
    {
        $today = date('Y-m-d');

        try {
            $query = "SELECT * FROM ". $this->subpayment_table ." ORDER BY created DESC";
            $check = $this->fetch_all($query);

            if ($check) {
                    
                foreach ($check as $key => $data) {

                    if ($data['expiry'] <= $today) {
                        $b1 = array('trancid' => $data['trancid'], 'status' => "Expired", );
                    
                        $query = "UPDATE ". $this->subpayment_table ." SET `status` = :status WHERE `trancid` = :trancid";
                        $this->update($b1, $query); 

                        return true;
                    }
                }
            }

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 

            return $data;  
        }
    }


    

    //User Self Records
    public function user_myself_info()
    {
        try {
            //$data = array('status' => $params['status'], );

            $query = "SELECT * FROM ". $this->self_table ."";
            $use = $this->fetch_all($query);

            return $use;

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }




    //User Preferences Records
    public function user_preferences()
    {
        try {
            //$data = array('status' => $params['status'], );

            $query = "SELECT * FROM ". $this->pref_table ."";
            $api = $this->fetch_all($query);

            return $api;

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }


    

    //Transaction Records
    public function all_payment_transactions($params)
    {
        try {
            $data = array('status' => $params['status'], );

            $query = "SELECT * FROM ". $this->subpayment_table ." WHERE status = :status ORDER BY created DESC";
            $api = $this->fetch_spec($data, $query);

            return $api;

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }
     


    //Users Posts Records
    public function users_posts($params)
    {
        try {
            if ($params['status'] == "All") {

                $data = array('status' => "Trash", );
                $query = "SELECT * FROM ". $this->post_table ." WHERE status != :status ORDER BY created DESC";
                $api = $this->fetch_spec($data, $query);

                return $api;

            } else {

                $data = array('status' => $params['status'], );
                $query = "SELECT * FROM ". $this->post_table ." WHERE status = :status ORDER BY created DESC";
                $api = $this->fetch_spec($data, $query);

                return $api;

            }

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }
     
     


    //Activities Records
    public function recent_activities()
    {
        try {
            $data = array('status' => "Unread", );

            $query = "SELECT * FROM ". $this->act_table ." WHERE status = :status ORDER BY created DESC";
            $api = $this->fetch_spec($data, $query);

            return $api;

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }
     



    //Visitors Records
    public function recent_visitors()
    {
        try {
            $data = array('status' => "Unread", );

            $query = "SELECT * FROM ". $this->vis_table ." WHERE status = :status ORDER BY created DESC";
            $api = $this->fetch_spec($data, $query);

            return $api;

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }
     

 

    //Card Payment Record
    public function card_payment_information($params)
    {
        try {
            $data = array('name' => $params['name'], 'status' => "Active");

            $query = "SELECT * FROM ". $this->api_table ." WHERE name = :name AND status = :status LIMIT 1";
            $api = $this->fetch_row($data, $query);

            return $api;

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }
    
    

    //Create & Update Bank Transfer Information
    public function create_coy_information($data = array())
    {
        //Admin Model
        $admin_model = new Admin();

        $a = array('id' => "1", );
        $c = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], );

        try {
            $query = "SELECT * FROM ". $this->coy_table ." WHERE id = :id LIMIT 1";
            $check = $this->fetch_row($a, $query);

            if ($check) {

                $b = array('id' => "1", 'coyname' => $data['coyname'], 'slogan' => $data['slogan'], 'email' => $data['email'], 'email1' => $data['email1'], 'phone' => $data['phone'], 'phone1' => $data['phone1'], 'channel' => $data['channel'], 'facebook' => $data['facebook'], 'instagram' => $data['instagram'], 'linkedin' => $data['linkedin'], 'twitter' => $data['twitter'], 'address' => $data['address'], 'status' => $data['status'], );
        
                $query = "UPDATE ". $this->coy_table ." SET `coyname` = :coyname, `slogan` = :slogan, `status` = :status, `email` = :email, `email1` = :email1, `phone` = :phone, `phone1` = :phone1, `channel` = :channel, `facebook` = :facebook, `instagram` = :instagram, `linkedin` = :linkedin, `twitter` = :twitter, `address` = :address WHERE `id` = :id LIMIT 1";
                $this->update($b, $query); 

                //Record Activity
                $info = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], 'category' => "Settings", 'details' => $data['username']." Updated Company Contact Details", ); 
                $admin_model->record_activity($info);

                return true;

            } else {

                $b = array('coyname' => $data['coyname'], 'slogan' => $data['slogan'], 'email' => $data['email'], 'email1' => $data['email1'], 'phone' => $data['phone'], 'phone1' => $data['phone1'], 'channel' => $data['channel'], 'facebook' => $data['facebook'], 'instagram' => $data['instagram'], 'linkedin' => $data['linkedin'], 'twitter' => $data['twitter'], 'address' => $data['address'], 'status' => $data['status'], );
        
                $query = "INSERT INTO ". $this->coy_table ."(coyname, slogan, email, email1, phone, phone1, channel, facebook, instagram, linkedin, twitter, address, status) VALUES (:coyname, :slogan, :email, :email1, :phone, :phone1, :channel, :facebook, :instagram, :linkedin, :twitter, :address, :status)";
                $this->insert($b, $query); 

                //Record Activity
                $info = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], 'category' => "Settings", 'details' => $data['username']." Created Company Contact Details.", ); 
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




    //Create & Update Bank Transfer Information
    public function create_bank_information($data = array())
    {
        //Admin Model
        $admin_model = new Admin();

        $a = array('id' => "1", );
        $c = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], );

        try {
            $query = "SELECT * FROM ". $this->bank_table ." WHERE id = :id LIMIT 1";
            $check = $this->fetch_row($a, $query);

            if ($check) {
                $b = array('id' => "1", 'bankname' => $data['bankname'], 'swiftcode' => $data['swiftcode'], 'acctname' => $data['acctname'], 'acctnum' => $data['acctnum'], 'status' => $data['status'], );
        
                $query = "UPDATE ". $this->bank_table ." SET `swiftcode` = :swiftcode, `status` = :status, `acctnum` = :acctnum, `acctname` = :acctname, `bankname` = :bankname WHERE `id` = :id LIMIT 1";
                $this->update($b, $query); 

                //Record Activity
                $info = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], 'category' => "Settings", 'details' => $data['username']." Updated Bank Transfer Details", ); 
                $admin_model->record_activity($info);

                return true;

            } else {
                $b = array('bankname' => $data['bankname'], 'swiftcode' => $data['swiftcode'], 'acctname' => $data['acctname'], 'acctnum' => $data['acctnum'], 'status' => $data['status'], );
        
                $query = "INSERT INTO ". $this->bank_table ."(swiftcode, bankname, acctname, acctnum, status) VALUES (:swiftcode, :bankname, :acctname, :acctnum, :status)";
                $this->insert($b, $query); 

                //Record Activity
                $info = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], 'category' => "Settings", 'details' => $data['username']." Created Bank Transfer Details.", ); 
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




    //Bank Transfer Record
    public function get_bank_info()
    {
        try {
            $data = array('id' => "1");
            $query = "SELECT * FROM ". $this->bank_table ." WHERE id = :id LIMIT 1";
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

        $a = array('id' => "1", );
        $b = array('id' => "1", 'currency' => $data['currency'], 'name' => $data['name'], );
        $c = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], );

        try {
            $query = "SELECT * FROM ". $this->cur_table ." WHERE id = :id LIMIT 1";
            $check = $this->fetch_row($a, $query);

            if ($check) {

                $query = "UPDATE ". $this->cur_table ." SET `name` = :name, `currency` = :currency WHERE `id` = :id LIMIT 1";
                $this->update($b, $query); 

                //Record Activity
                $info = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], 'category' => "Settings", 'details' => $data['username']." Updated Currency ".$data['currency']." To ".$data['name'], ); 
                $admin_model->record_activity($info);

                return true;

            } else {

                $query = "INSERT INTO ". $this->cur_table ."(id, name, currency) VALUES (:id, :name, :currency)";
                $this->insert($b, $query); 

                //Record Activity
                $info = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], 'category' => "Settings", 'details' => $data['username']." Created Currency ".$data['currency']." To ".$data['name'], ); 
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
        $b = array('currency' => $data['currency'], 'rate' => $data['rate'], 'status' => $data['status'], );

        try {
            $query = "SELECT * FROM ". $this->exchange_table ." WHERE currency = :currency LIMIT 1";
            $check = $this->fetch_row($a, $query);

            if ($check != NULL) {

                $query = "UPDATE ". $this->exchange_table ." SET `rate` = :rate, `status` = :status WHERE `currency` = :currency LIMIT 1";
                $this->update($b, $query); 

                //Record Activity
                $info = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], 'category' => "Settings", 'details' => $data['username']." Updated Exchange Rate ".$data['currency']." To ".$data['rate'], ); 
                $admin_model->record_activity($info);

                return true;

            } else {

                $query = "INSERT INTO ". $this->exchange_table ." (rate, currency, status) VALUES (:rate, :currency, :status)";
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



    //Create & Update Subscription Priviledge Information
    public function create_subscription_info($data = array())
    {
        //Admin Model
        $admin_model = new Admin();

        $a = array('id' => "1", );
        $b = array('id' => "1", 'status' => $data['status'], );

        try {
            $query = "SELECT * FROM ". $this->sub_table ." WHERE id = :id LIMIT 1";
            $check = $this->fetch_row($a, $query);

            if ($check) {

                if ($check['status'] != $data['status']) {

                    $query = "UPDATE ". $this->sub_table ." SET `status` = :status WHERE `id` = :id LIMIT 1";
                    $this->update($b, $query); 

                    //Record Activity
                    $info = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], 'category' => "Settings", 'details' => $data['username']." Updated Dating App Subscription ".$data['status'], ); 
                    $admin_model->record_activity($info);

                    return true;

                } else {

                    return false;
                }

            } else {

                $query = "INSERT INTO ". $this->sub_table ."(id, status) VALUES (:id, :status)";
                $this->insert($b, $query); 

                //Record Activity
                $info = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], 'category' => "Settings", 'details' => $data['username']." Created Dating App Subscription ".$data['status'], ); 
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


    //Subscription Priviledge Record
    public function get_subscription_info()
    {
        try {
            $data = array('id' => "1");
            $query = "SELECT * FROM ". $this->sub_table ." WHERE id = :id LIMIT 1";
            $coy = $this->fetch_row($data, $query);
            return $coy;

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }



    //Create & Update Subscription Plan Information
    public function create_subscription_plan($data = array())
    {
        //Admin Model
        $admin_model = new Admin();

        $a = array('type' => $data['type'], );
        $b = array('type' => $data['type'], 'expiry' => $data['expiry'], 'amount' => $data['amount'], 'details' => $data['details'], 'details1' => $data['details1'], 'details2' => $data['details2'], 'status' => $data['status'], );

        try {
            $query = "SELECT * FROM ". $this->subplan_table ." WHERE type = :type LIMIT 1";
            $check = $this->fetch_row($a, $query);

            if ($check != NULL) {

                $query = "UPDATE ". $this->subplan_table ." SET `amount` = :amount, `expiry` = :expiry, `details` = :details, `details1` = :details1, `details2` = :details2, `status` = :status WHERE `type` = :type LIMIT 1";
                $this->update($b, $query); 

                //Record Activity
                $info = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], 'category' => "Settings", 'details' => $data['username']." Updated Dating App Subscription Plan ".$data['type'], ); 
                $admin_model->record_activity($info);

                return true;

            } else {

                $c = array('planid' => $data['planid'], 'type' => $data['type'], 'expiry' => $data['expiry'], 'amount' => $data['amount'], 'details' => $data['details'], 'details1' => $data['details1'], 'details2' => $data['details2'], 'status' => $data['status'], );

                $query = "INSERT INTO ". $this->subplan_table ."(planid, type, amount, expiry, details, details1, details2, status) VALUES (:planid, :type, :amount, :expiry, :details, :details1, :details2, :status)";
                $this->insert($c, $query); 

                //Record Activity
                $info = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], 'category' => "Settings", 'details' => $data['username']." Created Dating App Subscription Plan ".$data['type'], ); 
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



    //Subscription Plan Record
    public function get_subscription_plan()
    {
        try {
            $data = array('status' => "Trash");
            $query = "SELECT * FROM ". $this->subplan_table ." WHERE status != :status";
            $coy = $this->fetch_spec($data, $query);
            return $coy;

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }



    //Create & Update Subscription Plan Information
    public function create_api_connect($data = array())
    {
        //Admin Model
        $admin_model = new Admin();

        $a = array('name' => $data['name'], );
        $b = array('name' => $data['name'], 'url' => $data['url'], 'code' => $data['code'], 'wallet' => $data['wallet'], 'private' => $data['private'], 'public' => $data['public'], 'status' => $data['status'], );

        try {
            $query = "SELECT * FROM ". $this->api_table ." WHERE name = :name LIMIT 1";
            $check = $this->fetch_row($a, $query);

            if ($check != NULL) {

                $query = "UPDATE ". $this->api_table ." SET `url` = :url, `code` = :code, `wallet` = :wallet, `private` = :private, `public` = :public, `status` = :status WHERE `name` = :name LIMIT 1";
                $this->update($b, $query); 

                //Record Activity
                $info = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], 'category' => "Settings", 'details' => $data['username']." Updated API Endpoint Details For ".$data['name'], ); 
                $admin_model->record_activity($info);

                return true;

            } else {

                $query = "INSERT INTO ". $this->api_table ."(name, url, code, wallet, private, public, status) VALUES (:name, :url, :code, :wallet, :private, :public, :status)";
                $w = $this->insert($b, $query); 

                //Record Activity
                $info = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], 'category' => "Settings", 'details' => $data['username']." Created API Endpoint Details For ".$data['name'], ); 
                $admin_model->record_activity($info);

                return $w;
            }

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 

            return $data;  
        }
    }



    //Subscription Plan Record
    public function get_api_connect()
    {
        try {
            $data = array('status' => "Trash");
            $query = "SELECT * FROM ". $this->api_table ." WHERE status != :status ORDER BY created DESC";
            $coy = $this->fetch_spec($data, $query);
            return $coy;

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }



    //All Users Record
    public function get_users_info($params)
    {
        try {
            $a = array('status' => "Trash");
            $b = array('profile' => $params['profile'], 'status' => "Trash");
            
            if ($params['profile'] == "All") {

                $query = "SELECT * FROM ". $this->u_table ." WHERE status != :status ORDER BY created DESC";
                $coy = $this->fetch_spec($a, $query);
                return $coy;

            } elseif ($params['profile'] == "User" || ($params['profile'] == "Moderator") || ($params['profile'] == "Admin")) {

                $query = "SELECT * FROM ". $this->u_table ." WHERE profile = :profile AND status != :status ORDER BY created DESC";
                $coy = $this->fetch_spec($b, $query);
                return $coy;

            }  else {

                $c = array('status' => $params['profile']);
                $query = "SELECT * FROM ". $this->u_table ." WHERE status = :status ORDER BY created DESC";
                $coy = $this->fetch_spec($c, $query);
                return $coy;
            }

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }



    
    //Method to Update Bio
    public function update_personal_info($params)
    {
        //Admin Model
        $admin_model = new Admin();
        $a = array('uniqueid' => $params['uniqueid'], );
        $pars = array('uniqueid' => $params['uniqueid'], 'email' => $params['email'], 'status' => $params['status'], );
        $newParams = array('uniqueid' => $params['uniqueid'], 'fname' => $params['fname'], 'lname' => $params['lname'], 'number' => $params['number'], 'occupation' => $params['occupation'], 'gender' => $params['gender'], 'dob' => $params['dob'], 'address' => $params['address'], 'city' => $params['city'], 'country' => $params['country'], 'details' => $params['details'], );
        
        try {
            $query = "SELECT * FROM " . $this->p_table ." WHERE uniqueid = :uniqueid LIMIT 1";
            $bio = $this->fetch_row($a, $query); 
            // Checking all User credentials...
            if ($bio) {
                
                $query0 = "UPDATE ". $this->u_table ." SET email = :email, status = :status WHERE uniqueid = :uniqueid LIMIT 1";
                $this->update($pars, $query0);

                $query = "UPDATE ". $this->p_table ." SET fname = :fname, lname = :lname, number = :number, occupation = :occupation, gender = :gender, dob = :dob, address = :address, city = :city, country = :country, details = :details WHERE uniqueid = :uniqueid LIMIT 1";
                $this->update($newParams, $query);
                
                //Record Activity
                $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Settings", 'details' => $params['username']." Updated Their Bio Details", ); 
                $admin_model->record_activity($info);

                return true;

            } else {

                return false;
        }

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }



    // Update User Status
    public function update_user_status($data = array())
    {
        //Admin Model
        $admin_model = new Admin();
        $today = date_create(date("Y-m-d"));
        $a = array('uniqueid' => $data['uUniqueid'], );
        $b = array('uniqueid' => $data['uUniqueid'], 'status' => $data['status'], );

        try {
            $query = "SELECT * FROM ". $this->u_table ." WHERE uniqueid = :uniqueid LIMIT 1";
            $check = $this->fetch_row($a, $query);

            if ($check) {

                if ($data['status'] != $check['status']) {

                    $query = "UPDATE ". $this->u_table ." SET `status` = :status WHERE `uniqueid` = :uniqueid LIMIT 1";
                    $this->update($b, $query); 

                    //Record Activity
                    $info = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], 'category' => "Settings", 'details' => $data['username']." Updated User: ".$data['uUniqueid']." Status To ".$data['status'], ); 
                    $admin_model->record_activity($info);

                    return true;

                } else {

                    return false;
                }

            } else {

                return false;
            }

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 

            return $data;  
        }
    }
 


    // Update Message Status
    public function update_message_status($data = array())
    {
        //Admin Model
        $admin_model = new Admin();
        $today = date_create(date("Y-m-d"));
        $a = array('id' => $data['id'], );
        $b = array('id' => $data['id'], 'status' => $data['status'], );

        try {
            $query = "SELECT * FROM ". $this->msg_table ." WHERE id = :id LIMIT 1";
            $check = $this->fetch_row($a, $query);

            if ($check) {

                if ($data['status'] != $check['status']) {

                    $query = "UPDATE ". $this->msg_table ." SET `status` = :status WHERE `id` = :id LIMIT 1";
                    $this->update($b, $query); 

                    //Record Activity
                    $info = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], 'category' => "Settings", 'details' => $data['username']." Updated Message: ".$check['subject']." Status To ".$data['status'], ); 
                    $admin_model->record_activity($info);

                    return true;

                } else {

                    return false;
                }

            } else {

                return false;
            }

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 

            return $data;  
        }
    }




    //Transactions Record
    public function get_transactions_info($params)
    {
        try {
            
            if ($params['status'] == "All") {

                $data = array('status' => "Trash", );
                $query = "SELECT * FROM ". $this->subpayment_table ." WHERE status != :status ORDER BY created DESC";
                $coy = $this->fetch_spec($data, $query);
                return $coy;

            } else {

                $data = array('status' => $params['status'], );
                $query = "SELECT * FROM ". $this->subpayment_table ." WHERE status = :status ORDER BY created DESC";
                $coy = $this->fetch_spec($data, $query);
                return $coy;

            }

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }


    //Create & Update Subscription Plan Information
    public function update_transaction_status($data = array())
    {
        //Admin Model
        $admin_model = new Admin();
        $a = array('trancid' => $data['trancid'], );
        $b = array('trancid' => $data['trancid'], 'status' => $data['status'], );

        try {
            $query = "SELECT * FROM ". $this->subpayment_table ." WHERE trancid = :trancid LIMIT 1";
            $check = $this->fetch_row($a, $query);

            if ($check) {

                if ($data['status'] === "Paid") {
                    
                    if ($data['status'] != $check['status']) {

                        $b1 = array('trancid' => $data['trancid'], 'status' => $data['status'], 'expiry' => date('Y-m-d', strtotime("+ ".$check['expiry'])), );
                        
                        $query = "UPDATE ". $this->subpayment_table ." SET `status` = :status, `expiry` = :expiry WHERE `trancid` = :trancid LIMIT 1";
                        $this->update($b1, $query); 

                        //Record Activity
                        $info = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], 'category' => "Settings", 'details' => $data['username']." Updated Transaction Status For ".$data['trancid'], ); 
                        $admin_model->record_activity($info);

                        return true;

                    } else {

                        return false;
                    }

                } else {

                    if ($data['status'] != $check['status']) {

                        $query = "UPDATE ". $this->subpayment_table ." SET `status` = :status WHERE `trancid` = :trancid LIMIT 1";
                        $this->update($b, $query); 

                        //Record Activity
                        $info = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], 'category' => "Settings", 'details' => $data['username']." Updated Transaction Status For ".$data['trancid'], ); 
                        $admin_model->record_activity($info);

                        return true;

                    } else {

                        return false;
                    }
                }

            } else {

                return false;
            }

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 

            return $data;  
        }
    }


    
    //Newsletters Subscribers Record
    public function get_newsletters_info()
    {
        try {
            $data = array('status' => "Trash");
            $query = "SELECT * FROM ". $this->newsletter_table ." WHERE status != :status ORDER BY created DESC";
            $coy = $this->fetch_spec($data, $query);
            return $coy;

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }



    //All Messages Record
    public function get_messages_info($params)
    {
        try {
            $a = array('status' => "Trash");
            $b = array('status' => $params['status'], );
            
            if ($params['status'] == "All") {

                $query = "SELECT * FROM ". $this->msg_table ." WHERE status != :status ORDER BY created DESC";
                $coy = $this->fetch_spec($a, $query);
                return $coy;

            } else {

                $query = "SELECT * FROM ". $this->msg_table ." WHERE status = :status ORDER BY created DESC";
                $coy = $this->fetch_spec($b, $query);
                return $coy;
            }

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }



    //Create Blog Post Information
    public function create_blog_post($data, $postid)
    {
        //Admin Model
        $admin_model = new Admin();
        
        $c = array('title' => $data['title'], 'postid' => $postid, );

        try {
            $query = "SELECT * FROM ". $this->blog_table ." WHERE postid = :postid OR title = :title LIMIT 1";
            $check = $this->fetch_row($c, $query);

            if ($check == NULL) {
                
                $b = array('uniqueid' => $data['uniqueid'], 'postid' => $postid, 'title' => $data['title'], 'subject' => $data['subject'], 'introduction' => $data['introduction'], 'category' => $data['category'], 'tags' => $data['tags'], 'url' => trim('https://').trim($data['url']).$postid."/".str_replace(" ", "-", trim($data['category']))."/".str_replace(" ", "-", trim($data['title']))."/", 'details' => $data['details'], 'conclusion' => $data['conclusion'], 'file' => $data['file'], 'file1' => $data['file1'], 'status' => $data['status'], );
        
                $query = "INSERT INTO ". $this->blog_table ."(uniqueid, postid, subject, title, introduction, category, tags, url, file, file1, details, conclusion, status) VALUES (:uniqueid, :postid, :subject, :title, :introduction, :category, :tags, :url, :file, :file1, :details, :conclusion, :status)";
                $new = $this->insert($b, $query); 

                //Record Activity
                $info = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], 'category' => "Blog", 'details' => $data['username']." Created a New Blog Post:- ".$data['title'], ); 
                $admin_model->record_activity($info);

                return true;
            } else {

                return false;

            }

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 

            return $data;  
        }
    }



    //All Blog Posts Record
    public function blog_posts($params)
    {
        try {
            $a = array('status' => "Trash");
            $b = array('status' => $params['status'], );
            
            if ($params['status'] == "All") {

                $query = "SELECT * FROM ". $this->blog_table ." WHERE status != :status ORDER BY created DESC";
                $coy = $this->fetch_spec($a, $query);
                return $coy;

            } else {

                $query = "SELECT * FROM ". $this->blog_table ." WHERE status = :status ORDER BY created DESC";
                $coy = $this->fetch_spec($b, $query);
                return $coy;
            }

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }



     //Blog Post Details
     public function blog_post_details($params)
     {
        $data = array('postid' => $params['postid'], );
         try {
            
            $query = "SELECT * FROM ". $this->blog_table ." WHERE postid = :postid Limit 1";
            $coy = $this->fetch_row($data, $query);

            if ($coy != NULL) {
                return $coy;
            } else {
                return false;
            }
                 
         } catch (Exception $e) {
 
             return "There is some errors: " . $e->getMessage();
         }
     }
 
 

     //Update Blog Post Information
    public function update_blog_post($data)
    {
        //Admin Model
        $admin_model = new Admin();
        $c = array('postid' => $data['postid'], );

        try {
            $query = "SELECT * FROM ". $this->blog_table ." WHERE postid = :postid LIMIT 1";
            $check = $this->fetch_row($c, $query);

            if ($check != NULL) {
                
                $b = array('postid' => $data['postid'], 'title' => $data['title'], 'subject' => $data['subject'], 'introduction' => $data['introduction'], 'category' => $data['category'], 'tags' => $data['tags'], 'updated' => date('Y-m-d'), 'details' => $data['details'], 'conclusion' => $data['conclusion'], 'file' => $data['file'], 'file1' => $data['file1'], 'status' => $data['status'], );
        
                $query = "UPDATE ". $this->blog_table ." SET `title` = :title, `subject` = :subject, `introduction` = :introduction, `category` = :category,  `tags` = :tags, `updated` = :updated, `file` = :file, `file1` = :file1, `details` = :details, `conclusion` = :conclusion, `status` = :status WHERE postid = :postid LIMIT 1";
                $new = $this->update($b, $query); 

                //Record Activity
                $info = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], 'category' => "Blog", 'details' => $data['username']." Updated Blog Post:- ".$data['title'], ); 
                $admin_model->record_activity($info);

                return $new;
            } else {

                return false;

            }

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 

            return $data;  
        }
    }




    //Create Blog Post Information
    public function search_blog_post($data)
    {
        
        $d = array('title' => "%".$data['title']."%", );
        try {
                $query = "SELECT * FROM ". $this->blog_table ." WHERE title LIKE :title AND status = 'Publish' OR status = 'New' ORDER BY RAND()";

                $receiver = $this->fetch_spec($d, $query);

                return $receiver;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 

            return $data;  
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















    /*
        ******* 

        Count Of Major Database Entries

        ********
    */

   
    //Count Of All New Members
    public function count_new_users()
    {
        $d = array('status' => "New", );
        try {
            $query="SELECT count(*) FROM ". $this->u_table ." WHERE status = :status";

            $count = $this->counter_spec($d, $query);

            return $count;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 
            return $data;  
        }
    }



    //Count Of All All Members
    public function count_all_users()
    {
        $d = array('status' => "Trash", );
        try {
            $query="SELECT count(*) FROM ". $this->u_table ." WHERE status != :status";

            $count = $this->counter_spec($d, $query);

            return $count;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 
            return $data;  
        }
    }



    //Count Of All All Messages
    public function count_all_messages()
    {
        $d = array('status' => "Trash", );
        try {
            $query="SELECT count(*) FROM ". $this->msg_table ." WHERE status != :status";

            $count = $this->counter_spec($d, $query);

            return $count;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 
            return $data;  
        }
    }



    //Count Of New Messages
    public function count_new_messages()
    {
        $d = array('status' => "Unread", );
        try {
            $query="SELECT count(*) FROM ". $this->msg_table ." WHERE status = :status";

            $count = $this->counter_spec($d, $query);

            return $count;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 
            return $data;  
        }
    }



    //Count Of All All Visitors
    public function count_all_visitors()
    {
        $d = array('status' => "Trash", );
        try {
            $query="SELECT count(*) FROM ". $this->vis_table ." WHERE status != :status";

            $count = $this->counter_spec($d, $query);

            return $count;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 
            return $data;  
        }
    }


 
    //Count Of All All Activities
    public function count_all_activities()
    {
        $d = array('status' => "Trash", );
        try {
            $query="SELECT count(*) FROM ". $this->act_table ." WHERE status != :status";

            $count = $this->counter_spec($d, $query);

            return $count;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 
            return $data;  
        }
    }



    //Count Of All All Transactions
    public function all_transactions_count()
    {
        $d = array('status' => "Trash", );
        try {
            $query="SELECT count(*) FROM ". $this->subpayment_table ." WHERE status != :status";

            $count = $this->counter_spec($d, $query);

            return $count;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 
            return $data;  
        }
    }



    //Count Of All New User Transactions
    public function new_transactions_count()
    {
        $d = array('status' => "Processing", );
        try {
            $query="SELECT count(*) FROM ". $this->subpayment_table ." WHERE status = :status";

            $count = $this->counter_spec($d, $query);

            return $count;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 
            return $data;  
        }
    }


    //Count Of All Paid User Transactions
    public function paid_transactions_count()
    {
        $d = array('status' => "Paid", );
        try {
            $query="SELECT count(*) FROM ". $this->subpayment_table ." WHERE status = :status";

            $count = $this->counter_spec($d, $query);

            return $count;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 
            return $data;  
        }
    }


    //Count Of All New User Transactions
    public function expired_transactions_count()
    {
        $d = array('status' => "Expired", );
        try {
            $query="SELECT count(*) FROM ". $this->subpayment_table ." WHERE status = :status";

            $count = $this->counter_spec($d, $query);

            return $count;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 
            return $data;  
        }
    }



    //Count Of All User Preferences
    public function count_user_preference()
    {
        try {
            $query="SELECT count(*) FROM ". $this->pref_table ."";

            $count = $this->counter($query);

            return $count;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 
            return $data;  
        }
    }



    //Count Of All User Myself Settings
    public function count_user_myself()
    {
        try {
            $query="SELECT count(*) FROM ". $this->self_table ."";

            $count = $this->counter($query);

            return $count;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 
            return $data;  
        }
    }



    //Count Of All New User Posts
    public function new_userposts_count()
    {
        $d = array('status' => "New", );
        try {
            $query="SELECT count(*) FROM ". $this->post_table ." WHERE status = :status";

            $count = $this->counter_spec($d, $query);

            return $count;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 
            return $data;  
        }
    }



    //Count Of All User Posts
    public function all_userposts_count()
    {
        $d = array('status' => "Trash", );
        try {
            $query="SELECT count(*) FROM ". $this->post_table ." WHERE status != :status";

            $count = $this->counter_spec($d, $query);

            return $count;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 
            return $data;  
        }
    }


    


    //Count Of All New Blog Posts
    public function new_blogposts_count()
    {
        $d = array('status' => "New", );
        try {
            $query="SELECT count(*) FROM ". $this->blog_table ." WHERE status = :status";

            $count = $this->counter_spec($d, $query);

            return $count;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 
            return $data;  
        }
    }



    //Count Of All Blog Posts
    public function all_blogposts_count()
    {
        $d = array('status' => "Trash", );
        try {
            $query="SELECT count(*) FROM ". $this->blog_table ." WHERE status != :status";

            $count = $this->counter_spec($d, $query);

            return $count;

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