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
            $data = array('profile' => $params['profile'], 'status' => "Trash");
            $query = "SELECT * FROM ". $this->u_table ." WHERE profile = :profile AND status != :status ORDER BY created DESC";
            $coy = $this->fetch_spec($data, $query);
            return $coy;

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
 
 //Transactions Record
 public function get_transactions_info()
 {
     try {
         $data = array('status' => "Trash");
         $query = "SELECT * FROM ". $this->subpayment_table ." WHERE status != :status ORDER BY created DESC";
         $coy = $this->fetch_spec($data, $query);
         return $coy;

     } catch (Exception $e) {

         return "There is some errors: " . $e->getMessage();
     }
 }


 //Create & Update Subscription Plan Information
 public function update_transaction_status($data = array())
 {
     //Admin Model
     $admin_model = new Admin();
     $today = date_create(date("Y-m-d"));
     $a = array('trancid' => $data['trancid'], );
     $b = array('trancid' => $data['trancid'], 'status' => $data['status'], );

     try {
         $query = "SELECT * FROM ". $this->subpayment_table ." WHERE trancid = :trancid LIMIT 1";
         $check = $this->fetch_row($a, $query);

         if ($check) {

             if ($data['status'] === "Paid") {
                 
                 if ($data['status'] != $check['status']) {

                     $a1 = array('amount' => $data['amount'], );
                     $query = "SELECT * FROM ". $this->subplan_table ." WHERE amount = :amount LIMIT 1";
                     $plan = $this->fetch_row($a1, $query);

                     $b1 = array('trancid' => $data['trancid'], 'status' => $data['status'], 'expiry' => date_add($today, date_interval_create_from_date_string($plan['expiry'])), );
                     
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

        End oF file 

        ********

    */



}