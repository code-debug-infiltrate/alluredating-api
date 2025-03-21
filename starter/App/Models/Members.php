<?php

//Required Files
require_once __DIR__.'/../Models/Admin.php';
require_once __DIR__.'/../../Config/Model.php';



class Members extends Model
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





    //Fetch All User Profiles
    public function user_profiles()
    {
        try {
            $query = "SELECT * FROM ". $this->p_table ." ORDER BY created DESC";
            $check = $this->fetch_all($query);

            return $check;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 

            return $data;  
        }
    }


    //Fetch All Users Online Status
    public function users_online_status()
    {

        try {
            $query = "SELECT uniqueid, login_status FROM ". $this->u_table ." ORDER BY created DESC";
            $check = $this->fetch_all($query);

            return $check;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 

            return $data;  
        }
    }
    
    
    

    //Fetch User Credentials
    public function user_info($param)
    {
        $newParams = array('uniqueid' => $param['uniqueid'], );

        try {
            //Fetch User Credentials For Use!
            $query1 = "SELECT * FROM ". $this->u_table .", ". $this->p_table ." WHERE ". $this->u_table .".uniqueid = :uniqueid AND ". $this->p_table .".uniqueid = :uniqueid LIMIT 1";
            $userInfo = $this->fetch_row($newParams, $query1); 

            return $userInfo;

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }




    //Update Username
    public function update_username($data = array())
    {
        //Admin Model
        $admin_model = new Admin();

        $b = array('username' => $data['newUsername'], );
        $c = array('uniqueid' => $data['uniqueid'], 'username' => $data['newUsername'], );

        try {
            $query = "SELECT * FROM ". $this->u_table ." WHERE username = :username LIMIT 1";
            $check = $this->fetch_row($b, $query);

            if (!$check) {

                $query = "UPDATE ". $this->u_table ." SET `username` = :username WHERE `uniqueid` = :uniqueid LIMIT 1";
                $this->update($c, $query); 

                //Record Activity
                $info = array('uniqueid' => $data['uniqueid'], 'username' => $data['newUsername'], 'category' => "Settings", 'details' => $data['username']." Updated Username To ".$data['newUsername'], ); 
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




    //Update User Password
    public function update_password($data = array())
    {
        //Admin Model
        $admin_model = new Admin();

        $c = array('uniqueid' => $data['uniqueid'], );
        $d = array('uniqueid' => $data['uniqueid'], "password" => password_hash($data['newpass'], PASSWORD_DEFAULT), );

        try {
                $query = "SELECT * FROM ". $this->u_table ." WHERE uniqueid = :uniqueid LIMIT 1";
                $check = $this->fetch_row($c, $query);

                if (password_verify($data['oldpass'], $check['password'])) {
                    // code...
                    $query = "UPDATE ". $this->u_table ." SET `password` = :password WHERE `uniqueid` = :uniqueid LIMIT 1";
                    $this->update($d, $query);
                    //Record Activity
                    $info = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], 'category' => "Settings", 'details' => $data['username']." Updated Password Record", ); 
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




    //Method to Update Location
    public function update_location($params)
    {
        //Admin Model
        $admin_model = new Admin();
        $a = array('uniqueid' => $params['uniqueid'], );
        $newParams = array('uniqueid' => $params['uniqueid'], 'address' => $params['address'], 'city' => $params['city'], 'country' => $params['country'], );
        
        try {
            $query = "SELECT * FROM " . $this->p_table ." WHERE uniqueid = :uniqueid LIMIT 1";
            $loc = $this->fetch_row($a, $query); 
            // Checking all User credentials...
            if ($loc) {

            $query = "UPDATE ". $this->p_table ." SET address = :address, city = :city, country = :country WHERE uniqueid = :uniqueid LIMIT 1";
            $this->update($newParams, $query); 
            
            //Record Activity
            $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Location", 'details' => $params['username']." Updated Their Address", ); 
            $admin_model->record_activity($info);

            return true;

        } else {

            return false;
        }

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }




    //Method to Update Work N Education
    public function update_workneducation($params)
    {
        //Admin Model
        $admin_model = new Admin();
        $a = array('uniqueid' => $params['uniqueid'], 'category' => $params['category'], 'name' => $params['name'],);
        
        try {
            $query = "SELECT * FROM " . $this->workedu_table ." WHERE uniqueid = :uniqueid AND name = :name AND category = :category LIMIT 1";
            $loc = $this->fetch_row($a, $query); 
            // Checking all User credentials...
            if (!$loc) {

            $newParams = array('uniqueid' => $params['uniqueid'], 'name' => $params['name'], 'category' => $params['category'], 'end' => $params['to'], 'start' => $params['from'], 'details' => $params['details'], );
                
            $query = "INSERT INTO ". $this->workedu_table ." (uniqueid, name, start, end, category, details) VALUES (:uniqueid, :name, :start, :end, :category, :details)";
            $this->insert($newParams, $query); 
            
            //Record Activity
            $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Work/Education", 'details' => $params['username']." Added ".$params['name'], ); 
            $admin_model->record_activity($info);

            return true;

        } else {

            return false;
        }

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }



    
    //Method to Update Bio
    public function update_bio($params)
    {
        //Admin Model
        $admin_model = new Admin();
        $a = array('uniqueid' => $params['uniqueid'], );
        $newParams = array('uniqueid' => $params['uniqueid'], 'fname' => $params['fname'], 'lname' => $params['lname'], 'number' => $params['number'], 'occupation' => $params['occupation'], 'gender' => $params['gender'], 'dob' => $params['dob'], 'details' => $params['details'], );
        
        try {
            $query = "SELECT * FROM " . $this->p_table ." WHERE uniqueid = :uniqueid LIMIT 1";
            $bio = $this->fetch_row($a, $query); 
            // Checking all User credentials...
            if ($bio) {

                $query0 = "UPDATE ". $this->p_table ." SET fname = :fname, lname = :lname, number = :number, occupation = :occupation, gender = :gender, dob = :dob, details = :details WHERE uniqueid = :uniqueid LIMIT 1";
                $this->update($newParams, $query0); 
                
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




    //Method to Update Notification Status
    public function update_notification_status($params)
    {
        //Admin Model
        $admin_model = new Admin();
        $a = array('uniqueid' => $params['uniqueid'], 'id' => $params['id'], );
        try {
            $query = "SELECT * FROM " . $this->uact_table ." WHERE uniqueid = :uniqueid AND id = :id LIMIT 1";
            $bio = $this->fetch_row($a, $query); 
            // Checking all User credentials...
            if ($bio) {

                $newParams = array('id' => $params['id'], 'status' => $params['status'], );
                
                $query0 = "UPDATE ". $this->uact_table ." SET status = :status WHERE id = :id LIMIT 1";
                $this->update($newParams, $query0); 

                return true;

            } else {

                return false;
        }

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }





    //Method to Update Notification Status
    public function update_activity_status($params)
    {
        //Admin Model
        $admin_model = new Admin();
        $a = array('uniqueid' => $params['uniqueid'], 'id' => $params['id'], );
        try {
            $query = "SELECT * FROM " . $this->act_table ." WHERE uniqueid = :uniqueid AND id = :id LIMIT 1";
            $bio = $this->fetch_row($a, $query); 
            // Checking all User credentials...
            if ($bio) {

                $newParams = array('id' => $params['id'], 'status' => $params['status'], );
                
                $query0 = "UPDATE ". $this->act_table ." SET status = :status WHERE id = :id LIMIT 1";
                $this->update($newParams, $query0); 

                return true;

            } else {

                return false;
            }
    
        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }
    



    //Method to Update Profile Photo
    public function update_profile_photo($params)
    {
        //Admin Model
        $admin_model = new Admin();
        $a = array('uniqueid' => $params['uniqueid'], );
        $newParams = array('uniqueid' => $params['uniqueid'], 'profileimage' => $params['profileimage'], );
        
        try {
            $query = "SELECT * FROM " . $this->p_table ." WHERE uniqueid = :uniqueid LIMIT 1";
            $bio = $this->fetch_row($a, $query); 
            // Checking all User credentials...
            if ($bio) {

                if ($bio['profileimage'] != $params['profileimage']) {

                    $query0 = "UPDATE ". $this->p_table ." SET profileimage = :profileimage WHERE uniqueid = :uniqueid LIMIT 1";
                    $this->update($newParams, $query0); 
                    
                    //Record Activity
                    $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Settings", 'details' => $params['username']." Updated Profile Photo", ); 
                    $admin_model->record_activity($info);

                    return true;

                } else {

                    return false;
                }

            } else {

                return false;
        }

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }




    //Method to Update Cover Photo
    public function update_cover_photo($params)
    {
        //Admin Model
        $admin_model = new Admin();
        $a = array('uniqueid' => $params['uniqueid'], );
        $newParams = array('uniqueid' => $params['uniqueid'], 'coverimage' => $params['coverimage'], );
        
        try {
            $query = "SELECT * FROM " . $this->p_table ." WHERE uniqueid = :uniqueid LIMIT 1";
            $bio = $this->fetch_row($a, $query); 
            // Checking all User credentials...
            if ($bio) {

                if ($bio['profileimage'] != $params['profileimage']) {

                    $query0 = "UPDATE ". $this->p_table ." SET coverimage = :coverimage WHERE uniqueid = :uniqueid LIMIT 1";
                    $this->update($newParams, $query0); 
                    
                    //Record Activity
                    $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Settings", 'details' => $params['username']." Updated Cover Photo", ); 
                    $admin_model->record_activity($info);

                    return true;

                } else {

                    return false;
                }

            } else {

                return false;
        }

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }



    //Fetch User Activities
    public function user_activity($param)
    {
        $newParams = array('uniqueid' => $param['uniqueid'], );

        try {
            //Fetch User Credentials For Use!
            $query1 = "SELECT * FROM ". $this->act_table ." WHERE uniqueid = :uniqueid AND status != 'Trash' ORDER BY created DESC LIMIT 20";
            $activityInfo = $this->fetch_spec($newParams, $query1); 

            return $activityInfo;

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }




    //Fetch User Album
    public function user_album($param)
    {
        $newParams = array('uniqueid' => $param['uniqueid'], );

        try {
            //Fetch User Credentials For Use!
            $query1 = "SELECT * FROM ". $this->album_table ." WHERE uniqueid = :uniqueid ORDER BY created DESC";
            $albumInfo = $this->fetch_spec($newParams, $query1); 

            return $albumInfo;

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }




    //Fetch User preferences
    public function user_preference($param)
    {
        $newParams = array('uniqueid' => $param['uniqueid'], );

        try {
            //Fetch User Credentials For Use!
            $query1 = "SELECT * FROM ". $this->pref_table ." WHERE uniqueid = :uniqueid LIMIT 1";
            $preferenceInfo = $this->fetch_row($newParams, $query1); 

            return $preferenceInfo;

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }




    //Method to Update Preference
    public function update_preference($params)
    {
        //Admin Model
        $admin_model = new Admin();
        $a = array('uniqueid' => $params['uniqueid'], );
        $newParams = array('uniqueid' => $params['uniqueid'], 'gender' => $params['gender'], 'orientation' => $params['orientation'], 'height' => $params['height'], 'weight' => $params['weight'], 'bodytype' => $params['bodytype'], 'seeking' => $params['seeking'], 'ethnicity' => $params['ethnicity'], 'religion' => $params['religion'], 'pets' => $params['pets'], 'dates' => $params['dates'], 'havekids' => $params['havekids'], 'wantkids' => $params['wantkids'], 'maritalstatus' => $params['maritalstatus'], 'dress' => $params['dress'], 'eating' => $params['eating'], 'smoking' => $params['smoking'], 'drinking' => $params['drinking'], 'color' => $params['color'], 'employment' => $params['employment'], 'details' => $params['details'],
        );
        
        try {
            $query = "SELECT * FROM " . $this->pref_table ." WHERE uniqueid = :uniqueid LIMIT 1";
            $bio = $this->fetch_row($a, $query); 
            // Checking all User credentials...
            if ($bio) {

                $query0 = "UPDATE ". $this->pref_table ." SET gender = :gender, orientation = :orientation, height = :height, weight = :weight, bodytype = :bodytype, seeking = :seeking, ethnicity = :ethnicity, religion = :religion, pets = :pets, dates = :dates, havekids = :havekids, wantkids = :wantkids, maritalstatus = :maritalstatus, dress = :dress, eating = :eating, smoking = :smoking, drinking = :drinking, color = :color, employment = :employment, details = :details WHERE uniqueid = :uniqueid LIMIT 1";
                $this->update($newParams, $query0); 
                
                //Record Activity
                $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Dating", 'details' => $params['username']." Updated Preferred Attributes Details", ); 
                $admin_model->record_activity($info);

                return true;

            } else {

                $query = "INSERT INTO ". $this->pref_table ." (uniqueid, gender, orientation, height, weight, bodytype, seeking, ethnicity, religion, pets, dates, wantkids, havekids, maritalstatus, dress, eating, smoking, drinking, color, employment, details) VALUES (:uniqueid, :gender, :orientation, :height, :weight, :bodytype, :seeking, :ethnicity, :religion, :pets, :dates, :wantkids, :havekids, :maritalstatus, :dress, :eating, :smoking, :drinking, :color, :employment, :details)";
                $this->insert($newParams, $query); 
                
                //Record Activity
                $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Dating", 'details' => $params['username']." Created Preferred Attributes Details", ); 
                $admin_model->record_activity($info);

                return true;
            }

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }
   



    //Fetch User Myself Attributes
    public function user_myself($param)
    {
        $newParams = array('uniqueid' => $param['uniqueid'], );

        try {
            //Fetch User Credentials For Use!
            $query1 = "SELECT * FROM ". $this->self_table ." WHERE uniqueid = :uniqueid LIMIT 1";
            $myselfInfo = $this->fetch_row($newParams, $query1); 

            return $myselfInfo;

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }
    

    
    //Method to Update Myself
    public function update_myself($params)
    {
        //Admin Model
        $admin_model = new Admin();
        $a = array('uniqueid' => $params['uniqueid'], );
        $newParams = array('uniqueid' => $params['uniqueid'], 'orientation' => $params['orientation'], 'height' => $params['height'], 'weight' => $params['weight'], 'bodytype' => $params['bodytype'], 'seeking' => $params['seeking'], 'ethnicity' => $params['ethnicity'], 'religion' => $params['religion'], 'pets' => $params['pets'], 'dates' => $params['dates'], 'havekids' => $params['havekids'], 'wantkids' => $params['wantkids'], 'maritalstatus' => $params['maritalstatus'], 'dress' => $params['dress'], 'eating' => $params['eating'], 'smoking' => $params['smoking'], 'drinking' => $params['drinking'], 'color' => $params['color'], 'employment' => $params['employment'], 'details' => $params['details'],
        );
        
        try {
            $query = "SELECT * FROM " . $this->self_table ." WHERE uniqueid = :uniqueid LIMIT 1";
            $bio = $this->fetch_row($a, $query); 
            // Checking all User credentials...
            if ($bio) {

                $query0 = "UPDATE ". $this->self_table ." SET orientation = :orientation, height = :height, weight = :weight, bodytype = :bodytype, seeking = :seeking, ethnicity = :ethnicity, religion = :religion, pets = :pets, dates = :dates, havekids = :havekids, wantkids = :wantkids, maritalstatus = :maritalstatus, dress = :dress, eating = :eating, smoking = :smoking, drinking = :drinking, color = :color, employment = :employment, details = :details WHERE uniqueid = :uniqueid LIMIT 1";
                $this->update($newParams, $query0); 
                
                //Record Activity
                $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Dating", 'details' => $params['username']." Updated Personal Attributes Details", ); 
                $admin_model->record_activity($info);

                return true;

            } else {

                $query = "INSERT INTO ". $this->self_table ." (uniqueid, orientation, height, weight, bodytype, seeking, ethnicity, religion, pets, dates, wantkids, havekids, maritalstatus, dress, eating, smoking, drinking, color, employment, details) VALUES (:uniqueid, :orientation, :height, :weight, :bodytype, :seeking, :ethnicity, :religion, :pets, :dates, :wantkids, :havekids, :maritalstatus, :dress, :eating, :smoking, :drinking, :color, :employment, :details)";
                $this->insert($newParams, $query); 
                
                //Record Activity
                $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Dating", 'details' => $params['username']." Created Personal Attributes Details", ); 
                $admin_model->record_activity($info);

                return true;
            }

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }



    //Method to Create New Interest
    public function create_interest($params)
    {
        //Admin Model
        $admin_model = new Admin();
        $newParams = array('uniqueid' => $params['uniqueid'], 'details' => $params['interest'], );
        
        try {
        	$query = "SELECT * FROM " . $this->int_table ." WHERE uniqueid = :uniqueid AND details = :details LIMIT 1";
            $inte = $this->fetch_row($newParams, $query); 
            // Checking all User credentials...
            if ($inte == null) {
                $newParam = array('uniqueid' => $params['uniqueid'], );

                $query = "SELECT count(*) FROM " . $this->int_table ." WHERE uniqueid = :uniqueid ";
                $count = $this->counter_spec($newParam, $query); ;

                if ($count < '5') {

                    $query = "INSERT INTO ". $this->int_table ." (uniqueid, details) VALUES (:uniqueid, :details)";
                    $this->insert($newParams, $query); 
                    
                    //Record Activity
                    $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Interests", 'details' => $params['username']." Created ".$params['interest']." Interest.", ); 
                    $admin_model->record_activity($info);

                    return true;

                } else {

                    return false;
                }

            } else {

                return false;
            }

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }



    //Fetch User Interests
    public function user_interests($param)
    {
        $newParams = array('uniqueid' => $param['uniqueid'], );

        try {
            //Fetch User Credentials For Use!
            $query1 = "SELECT * FROM ". $this->int_table ." WHERE uniqueid = :uniqueid ORDER BY created DESC";
            $interestsInfo = $this->fetch_spec($newParams, $query1); 

            return $interestsInfo;

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }




    //Fetch User Work & Education
    public function user_workeducation($param)
    {
        $newParams = array('uniqueid' => $param['uniqueid'], );

        try {
            //Fetch User Credentials For Use!
            $query1 = "SELECT * FROM ". $this->workedu_table ." WHERE uniqueid = :uniqueid ORDER BY created DESC";
            $workeducationInfo = $this->fetch_spec($newParams, $query1); 

            return $workeducationInfo;

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }




    //Method to Create New Interest
    public function create_language($params)
    {
        //Admin Model
        $admin_model = new Admin();
        $a = array('uniqueid' => $params['uniqueid'], );
        $newParams = array('uniqueid' => $params['uniqueid'], 'language' => $params['lang'], );
        
        try {
            $query = "SELECT * FROM " . $this->lng_table ." WHERE uniqueid = :uniqueid AND language = :language LIMIT 1";
            $language = $this->fetch_row($newParams, $query); 
            // Checking all User credentials...
            if ($language == null) {

                $query = "SELECT count(*) FROM " . $this->lng_table ." WHERE uniqueid = :uniqueid ";
                $count = $this->counter_spec($a, $query); ;

                if ($count < '5') {

                    $query = "INSERT INTO ". $this->lng_table ." (uniqueid, language) VALUES (:uniqueid, :language)";
                    $this->insert($newParams, $query); 
                    
                    //Record Activity
                    $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Language", 'details' => $params['username']." Added ".$params['lang']." Language.", ); 
                    $admin_model->record_activity($info);

                    return true;

                } else {

                    return false;
                }

            } else {

                return false;
            }

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }




    //Fetch User Languages
    public function user_language($param)
    {
        $newParams = array('uniqueid' => $param['uniqueid'], );

        try {
            //Fetch User Credentials For Use!
            $query1 = "SELECT * FROM ". $this->lng_table ." WHERE uniqueid = :uniqueid ORDER BY created DESC";
            $languageInfo = $this->fetch_spec($newParams, $query1); 

            return $languageInfo;

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }




    //Fetch User Find People
    public function user_find_people($param)
    {
        $newParams = array('uniqueid' => $param['uniqueid'], );

        try {
            //Fetch User Credentials For Use!
            $query1 = "SELECT * FROM ". $this->pref_table ." WHERE uniqueid = :uniqueid LIMIT 1";
            $myselfInfo = $this->fetch_row($newParams, $query1);
            
            if ($myselfInfo) {

                $prefMatch = array('uniqueid' => $param['uniqueid'], 'orientation' => $myselfInfo['orientation'], 'ethnicity' => $myselfInfo['ethnicity'], 'religion' => $myselfInfo['religion'], 'seeking' => $myselfInfo['seeking'], 'smoking' => $myselfInfo['smoking'], 'drinking' => $myselfInfo['drinking'], );

                $query0 = "SELECT * FROM ". $this->self_table ." WHERE orientation = :orientation AND ethnicity = :ethnicity AND religion = :religion AND seeking = :seeking AND smoking = :smoking AND drinking = :drinking AND uniqueid != :uniqueid ORDER BY created DESC";
                $veryClose = $this->fetch_spec($prefMatch, $query0); 

                $query = "SELECT * FROM ". $this->self_table ." WHERE orientation = :orientation AND ethnicity = :ethnicity AND religion = :religion AND seeking = :seeking AND smoking = :smoking AND drinking = :drinking AND uniqueid != :uniqueid OR orientation = 'Any' AND uniqueid != :uniqueid OR ethnicity = 'Any' AND uniqueid != :uniqueid OR religion = 'Any' AND uniqueid != :uniqueid OR seeking = 'Any' AND uniqueid != :uniqueid OR smoking = 'Any' AND uniqueid != :uniqueid OR drinking = 'Any' AND uniqueid != :uniqueid ORDER BY created DESC";
                $slightlyClose = $this->fetch_spec($prefMatch, $query);

                $matchInfo = array('veryClose' => $veryClose, 'slightlyClose' => $slightlyClose, );

                return $matchInfo;

            } else {

                return false;

            }

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }




    //Fetch User Find People
    public function user_random_people($param)
    {
        $newParams = array('uniqueid' => $param['uniqueid'], );

        try {
            //Fetch User Credentials For Use!
            $query1 = "SELECT * FROM ". $this->pref_table ." WHERE uniqueid = :uniqueid LIMIT 1";
            $myselfInfo = $this->fetch_row($newParams, $query1);
            
            if ($myselfInfo) {

                $prefMatch = array('uniqueid' => $param['uniqueid'],  );

                $query0 = "SELECT * FROM ". $this->self_table ." WHERE uniqueid != :uniqueid ORDER BY RAND() DESC LIMIT 60";
                $matchInfo = $this->fetch_spec($prefMatch, $query0); 

                return $matchInfo;

            } else {

                return false;

            }

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }

    
    

    //Method to Create Or Update Profile Actions And Views
    public function user_actions($params)
    {
    //Admin Model
    $admin_model = new Admin();

    $newParams = array('uniqueid' => $params['uniqueid'], 'viewerid' => $params['viewerid'], );
        
    try {
            $query = "SELECT * FROM " . $this->actions_table ." WHERE uniqueid = :uniqueid AND viewerid = :viewerid LIMIT 1";
            $actview = $this->fetch_row($newParams, $query); 
            // Checking all User credentials...
            if ($actview) {

            $newParams = array('uniqueid' => $params['uniqueid'], 'viewerid' => $params['viewerid'], 'views' => $actview['views'] + 1, 'action' => $params['action'], );

            $query = "UPDATE ". $this->actions_table ." SET views = :views, action = :action WHERE uniqueid = :uniqueid AND viewerid = :viewerid LIMIT 1";
            $this->update($newParams, $query);

            //Record Activity
            $info = array('uniqueid' => $params['uniqueid'], 'user_uniqueid' => $params['viewerid'], 'details' => $params['username']." ".$params['action']." Your Profile.", ); 
            $this->record_user_activity($info);

            //Record Activity
            $info = array('uniqueid' => $params['viewerid'], 'username' => $params['username'], 'category' => "Dating", 'details' => $params['username']." ".$params['action']." a Buddy Profile.", ); 
            $admin_model->record_activity($info);

            return true;

            } else {

            $newParams = array('uniqueid' => $params['uniqueid'], 'viewerid' => $params['viewerid'], 'views' => "1", 'action' => $params['action'], );

            $query = "INSERT INTO ". $this->actions_table ." (uniqueid, viewerid, views, action) VALUES (:uniqueid, :viewerid, :views, :action)";
            $this->insert($newParams, $query); 
            
            //Record Activity
            $info = array('uniqueid' => $params['uniqueid'], 'user_uniqueid' => $params['viewerid'], 'details' => $params['username']." ".$params['action']." Your Profile.", ); 
            $this->record_user_activity($info);

            //Record Activity
            $info = array('uniqueid' => $params['viewerid'], 'username' => $params['username'], 'category' => "Dating", 'details' => $params['username']." ".$params['action']." a Buddy Profile.", ); 
            $admin_model->record_activity($info);

            return true;
            }

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }


    //Method to Create Or Update Profile Views
    public function user_views($params)
    {
        //Admin Model
        $admin_model = new Admin();

        $newParams = array('uniqueid' => $params['uniqueid'], );
        
        try {
            $query = "SELECT * FROM " . $this->views_table ." WHERE uniqueid = :uniqueid LIMIT 1";
            $actview = $this->fetch_row($newParams, $query); 
            // Checking all User credentials...
            if ($actview) {

                $newP = array('uniqueid' => $params['uniqueid'], 'views' => $actview['views']+1, );

                $query = "UPDATE ". $this->views_table ." SET views = :views WHERE uniqueid = :uniqueid LIMIT 1";
                $this->update($newP, $query);

                //Record Activity
                $info = array('uniqueid' => $params['uniqueid'], 'user_uniqueid' => $params['viewerid'], 'details' => $params['username']." Viewed Your Profile.", ); 
                $this->record_user_activity($info);

                //Record Activity
                $info = array('uniqueid' => $params['viewerid'], 'username' => $params['username'], 'category' => "Dating", 'details' => $params['username']." Viewed a Buddy Profile", ); 
                $admin_model->record_activity($info);

            } else {

                $newPar = array('uniqueid' => $params['uniqueid'], 'views' => "1", );

                $query = "INSERT INTO ". $this->views_table ." (uniqueid, views) VALUES (:uniqueid, :views)";
                $this->insert($newPar, $query); 
            
                //Record Activity
                $info = array('uniqueid' => $params['uniqueid'], 'user_uniqueid' => $params['viewerid'], 'details' => $params['username']." Viewed Your Profile.", ); 
                $this->record_user_activity($info);

                //Record Activity
                $info = array('uniqueid' => $params['viewerid'], 'username' => $params['username'], 'category' => "Dating", 'details' => $params['username']." Viewed a Buddy Profile", ); 
                $admin_model->record_activity($info);
            }

            $query = "SELECT * FROM " . $this->views_table ." WHERE uniqueid = :uniqueid LIMIT 1";
            $newview = $this->fetch_row($newParams, $query); 

            return $newview;

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }


    //Method to Create Or Update Profile Views
    public function user_add_buddy($params)
    {
        //Admin Model
        $admin_model = new Admin();
        $newParams = array('uniqueid' => $params['uniqueid'], 'buddyid' => $params['buddyid'], );
        
        try {
            $query = "SELECT * FROM " . $this->buddy_table ." WHERE uniqueid = :uniqueid AND buddyid = :buddyid LIMIT 1";
            $actview = $this->fetch_row($newParams, $query); 
            // Checking all User credentials...
            if ($actview) {

                if ($actview['request'] != $params['request']) { 

                    $newParams = array('uniqueid' => $params['uniqueid'], 'buddyid' => $params['buddyid'], 'request' => $params['request'], );

                    $query = "UPDATE ". $this->buddy_table ." SET request = :request WHERE uniqueid = :uniqueid AND buddyid = :buddyid LIMIT 1";
                    $this->update($newParams, $query);

                    return true;
                }

                return false;

            } else {

                $newParams = array('uniqueid' => $params['uniqueid'], 'buddyid' => $params['buddyid'], );

                $query = "INSERT INTO ". $this->buddy_table ." (uniqueid, buddyid) VALUES (:uniqueid, :buddyid)";
                $this->insert($newParams, $query); 
            
                //Record Activity
                $info = array('uniqueid' => $params['buddyid'], 'user_uniqueid' => $params['uniqueid'], 'details' => $params['username']." Sent You a Buddy Request.", ); 
                $this->record_user_activity($info);

                //Record Activity
                $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Dating", 'details' => $params['username']." Sent ".$params['buddyname']." a Buddy Request.", ); 
                $admin_model->record_activity($info);

                return true;
            }

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }


    //Method to Accept Or Update Buddy Req
    public function user_accept_buddy($params)
    {
        //Admin Model
        $admin_model = new Admin();
        $newParams = array('buddyid' => $params['uniqueid'], 'uniqueid' => $params['buddyid'], );
        
        try {
            $query = "SELECT * FROM " . $this->buddy_table ." WHERE buddyid = :buddyid AND uniqueid = :uniqueid LIMIT 1";
            $actview = $this->fetch_row($newParams, $query); 
            // Checking all User credentials...
            if ($actview) {

                if ($actview['request'] != $params['request']) { 

                    $newP = array('buddyid' => $params['uniqueid'], 'uniqueid' => $params['buddyid'], 'request' => $params['request'], );

                    $query = "UPDATE ". $this->buddy_table ." SET request = :request WHERE buddyid = :buddyid AND uniqueid = :uniqueid LIMIT 1";
                    $this->update($newP, $query);

                    //Record Activity
                   $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Dating", 'details' => $params['username']." Updated Buddy Request", ); 
                   $admin_model->record_activity($info);

                   //Record Activity
                    $info = array('uniqueid' => $params['buddyid'], 'user_uniqueid' => $params['uniqueid'], 'details' => $params['username']." Accepted Your Buddy Request.", ); 
                    $this->record_user_activity($info);

                    return true;
                }

                return false;

            } else {

               return false;
            }

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }


    
   //Buddies Friend List
   public function user_buddies_list($params)
   {
       $d = array('uniqueid' => $params['uniqueid'], 'buddyid' => $params['uniqueid'], );

        try {
            $query="SELECT * FROM ". $this->buddy_table ." WHERE uniqueid = :uniqueid OR buddyid = :buddyid ";

            $list = $this->fetch_spec($d, $query);

            return $list;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 
            return $data;  
        }
   }



   //Method to Create New Post
   public function user_create_post($params, $images)
   {
       //Admin Model
       $admin_model = new Admin();
       
       $newP = array('uniqueid' => $params['uniqueid'], 'details' => $params['details'], );

       $newParams = array('uniqueid' => $params['uniqueid'], 'postid' => $params['postid'], 'details' => $params['details'], 'file' => $params['file'], 'file1' => $images[1], 'file2' => $images[2], 'file3' => $images[3], 'file4' => $images[4], 'url' => $params['url'], );

       try {
           $query = "SELECT * FROM " .$this->post_table." WHERE uniqueid = :uniqueid AND details = :details LIMIT 1";
           $RowCount = $this->fetch_row($newP, $query); 

            // Checking all User credentials...
            if (!$RowCount) {

               $query = "INSERT INTO ".$this->post_table." (postid, uniqueid, details, file, file1, file2, file3, file4, url) VALUES (:postid, :uniqueid, :details, :file, :file1, :file2, :file3, :file4, :url)";
               $this->insert($newParams, $query); 

                // if ($images[1] != null) {

                //     $a = array('uniqueid' => $params['uniqueid'], 'postid' => $params['postid'], 'file1' => $images[1], 'file2' => $images[2], 'file3' => $images[3], 'file4' => $images[4], );

                //     $query = "INSERT INTO ". $this->postimg_table ." (postid, uniqueid, file1, file2, file3, file4) VALUES (:postid, :uniqueid, :file1, :file2, :file3, :file4)";
                //     $this->insert($a, $query);   
                // }
               
               //Record Activity
               $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Posts", 'details' => $params['username']." Just Made a Post", ); 
               $admin_model->record_activity($info);

               return true;

           } else {

               return false;
           }

       } catch (Exception $e) {

           return "There is some errors: " . $e->getMessage();
       }
   }



       
   //All Posts List
   public function get_latest_posts()
   {
        try {
           $query="SELECT * FROM ". $this->post_table ." WHERE reports < '10' AND status = 'New' OR status = 'Published' ORDER BY RAND() DESC LIMIT 300";

           $list = $this->fetch_all($query);

           return $list;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 
            return $data;  
        }
   }



    //All Posts List
    public function get_latest_posts_files()
    {
        try {
            $query="SELECT * FROM ". $this->postimg_table ." ORDER BY created DESC ";

            $list = $this->fetch_all($query);

            return $list;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 
            return $data;  
        }
    }




    //All Posts List
    public function get_post_details($params)
    {
        $a = array('postid' => $params['postid'], );
        try {
            $query="SELECT * FROM ". $this->post_table ." WHERE postid = :postid LIMIT 1";

            $list = $this->fetch_row($a, $query);

            return $list;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 
            return $data;  
        }
    }




   //Method to Create User Post Interaction
   public function user_post_interaction($params)
   {
       //Admin Model
       $admin_model = new Admin();
       
       $newP = array('uniqueid' => $params['uniqueid'], 'postid' => $params['postid'], );
       $newParams = array('uniqueid' => $params['uniqueid'], 'postid' => $params['postid'], 'views' => "1", );

       try {
           $query = "SELECT * FROM " .$this->urpostact_table." WHERE uniqueid = :uniqueid AND postid = :postid LIMIT 1";
           $urPostAct = $this->fetch_row($newP, $query); 

            // Checking all User credentials...
            if (!$urPostAct) {

               $query0 = "INSERT INTO ".$this->urpostact_table." (postid, uniqueid, views) VALUES (:postid, :uniqueid, :views)";
               $new = $this->insert($newParams, $query0); 

                if ($new == true) {

                    $newQ = array('postid' => $params['postid'], );
                    $query1 = "SELECT * FROM " .$this->postact_table." WHERE postid = :postid LIMIT 1";
                    $postAct = $this->fetch_row($newQ, $query1);

                    if (!$postAct) {

                        $a = array('postid' => $params['postid'], 'views' => "1");
                        $query2 = "INSERT INTO ". $this->postact_table ." (postid, views) VALUES (:postid, :views)";
                        $this->insert($a, $query2);

                    } else {

                        $newParams = array('postid' => $params['postid'], 'views' => $postAct['views'] + 1, );
                        $query = "UPDATE ". $this->postact_table ." SET `views` = :views WHERE postid = :postid";
                        $this->update($newParams, $query);
                    }
                }
               
               //Record Activity
               $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Post", 'details' => $params['username']." Viewed a Post With ID:".$params['postid'], ); 
               $admin_model->record_activity($info);

               return true;

           } else {

                $newParams = array('uniqueid' => $params['uniqueid'], 'postid' => $params['postid'], 'views' => $urPostAct['views'] + 1, );
                $query = "UPDATE ". $this->urpostact_table ." SET `views` = :views WHERE uniqueid = :uniqueid AND postid = :postid";
                $this->update($newParams, $query);

                return true;
           }

       } catch (Exception $e) {

           return "There is some errors: " . $e->getMessage();
       }
   }



      
    //Method to Create User Post Action
    public function user_post_actions($params)
    {
       //Admin Model
       $admin_model = new Admin();
       
       $newP = array('uniqueid' => $params['uniqueid'], 'postid' => $params['postid'], );
       $newParams = array('uniqueid' => $params['uniqueid'], 'postid' => $params['postid'], 'action' => $params['action'],);

       try {
           $query = "SELECT * FROM " .$this->urpostact_table." WHERE uniqueid = :uniqueid AND postid = :postid LIMIT 1";
           $urPostAct = $this->fetch_row($newP, $query); 

            // Checking all User credentials...
            if ($urPostAct == NULL) {

               $query0 = "INSERT INTO ".$this->urpostact_table." (postid, uniqueid, action) VALUES (:postid, :uniqueid, :action)";
               $new = $this->insert($newParams, $query0); 

                if ($new == true) {

                    $newQ = array('postid' => $params['postid'], );
                    $query1 = "SELECT * FROM " .$this->postact_table." WHERE postid = :postid LIMIT 1";
                    $postAct = $this->fetch_row($newQ, $query1);

                    if ($postAct == NULL) {
                        if ($params['action'] == "like") { 

                            $a = array('postid' => $params['postid'], 'likes' => "1");
                            $query2 = "INSERT INTO ". $this->postact_table ." (postid, likes) VALUES (:postid, :likes)";
                            $this->insert($a, $query2);

                        } else {

                            $a = array('postid' => $params['postid'], 'dislikes' => "1");
                            $query2 = "INSERT INTO ". $this->postact_table ." (postid, dislikes) VALUES (:postid, :dislikes)";
                            $this->insert($a, $query2);

                        }

                    } else {

                        if ($params['action'] != $urPostAct['action']) {

                            if ($params['action'] == "like") {
                                
                                if ($postAct['dislikes'] > "0") {$new = $postAct['dislikes'] - 1; }else{ $new = "0"; }
                                $newParams = array('postid' => $params['postid'], 'likes' => $postAct['likes'] + 1, 'dislikes' => $new, );
                                $query = "UPDATE ". $this->postact_table ." SET `likes` = :likes, `dislikes` = :dislikes WHERE postid = :postid";
                                $this->update($newParams, $query);
    
                            } else {
                                
                                if ($postAct['likes'] > "0") {$new = $postAct['likes'] - 1; }else{ $new = "0"; }
                                $newParams = array('postid' => $params['postid'], 'dislikes' => $postAct['dislikes'] + 1, 'likes' => $new, );
                                $query = "UPDATE ". $this->postact_table ." SET `likes` = :likes, `dislikes` = :dislikes WHERE postid = :postid";
                                $this->update($newParams, $query);
    
                            }
                        }
                    }
                }
               
               //Record Activity
               $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Post", 'details' => $params['username']." ".$params['action']." a Post With ID:".$params['postid'], ); 
               $admin_model->record_activity($info);

               return true;

            } else {

                if ($params['action'] != $urPostAct['action']) {

                    $newParams = array('uniqueid' => $params['uniqueid'], 'postid' => $params['postid'], 'action' => $params['action'], );
                    $query = "UPDATE ". $this->urpostact_table ." SET `action` = :action WHERE uniqueid = :uniqueid AND postid = :postid";
                    $this->update($newParams, $query);

                    $newQ = array('postid' => $params['postid'], );
                    $query1 = "SELECT * FROM " .$this->postact_table." WHERE postid = :postid LIMIT 1";
                    $postAct = $this->fetch_row($newQ, $query1);

                    if ($params['action'] == "like") {

                        if ($postAct['dislikes'] > "0") {$new = $postAct['dislikes'] - 1; }else{ $new = "0"; }

                        $newParams = array('postid' => $params['postid'], 'dislikes' => $new, 'likes' => $postAct['likes'] + 1, );
                        $query = "UPDATE ". $this->postact_table ." SET `likes` = :likes, `dislikes` = :dislikes WHERE postid = :postid";
                        $this->update($newParams, $query);

                    } else {

                        if ($postAct['likes'] > "0") {$new = $postAct['likes'] - 1; }else{ $new = "0"; }
                        $newParams = array('postid' => $params['postid'], 'likes' => $new, 'dislikes' => $postAct['dislikes'] + 1, );
                        $query = "UPDATE ". $this->postact_table ." SET `likes` = :likes, `dislikes` = :dislikes WHERE postid = :postid";
                        $this->update($newParams, $query);

                    }

                    //Record Activity
                    $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Post", 'details' => $params['username']." ".$params['action']." a Post With ID:".$params['postid'], ); 
                    $admin_model->record_activity($info);

                    return true;
                }
            }

        } catch (Exception $e) {

           return "There is some errors: " . $e->getMessage();
        }
    }



      
    
    //Post Views Count
    public function get_post_actions()
    {
       //$d = array('postid' => $params['postid'], );

        try {
            $query="SELECT * FROM ". $this->postact_table ." ORDER BY created DESC";

            $postDetail = $this->fetch_all($query);

            return $postDetail;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 
            return $data;  
        }
    }



      
    
    //User Post Actions 
    public function my_post_action($params)
    {
       $d = array('uniqueid' => $params['uniqueid'], );

        try {
            $query="SELECT * FROM ". $this->urpostact_table ." WHERE uniqueid = :uniqueid ORDER BY created DESC";

            $postDetail = $this->fetch_spec($d, $query);

            return $postDetail;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 
            return $data;  
        }
    }




    //Method to Create Or Update Post Reports
    public function user_post_reports($params)
    {
        //Admin Model
        $admin_model = new Admin();
        $chek = array('uniqueid' => $params['uniqueid'], 'postid' => $params['postid'], );
        $newParams = array('uniqueid' => $params['uniqueid'], 'postid' => $params['postid'], 'reason' => $params['reason'], );
         
        try {
             $query = "SELECT * FROM " . $this->postreport_table ." WHERE uniqueid = :uniqueid AND postid = :postid LIMIT 1";
             $actview = $this->fetch_row($chek, $query); 
             // Checking all User credentials...
             if ($actview) {
 
                 if ($actview['reason'] != $params['reason']) { 

                     $query = "UPDATE ". $this->postreport_table ." SET reason = :reason WHERE uniqueid = :uniqueid AND postid = :postid LIMIT 1";
                     $this->update($newParams, $query);
 
                     return true;
                 }
 
                 return false;
 
             } else {

                $pos = array('postid' => $params['postid'], );

                $query = "INSERT INTO ". $this->postreport_table ." (uniqueid, postid, reason) VALUES (:uniqueid, :postid, :reason)";
                $this->insert($newParams, $query); 

                $query = "SELECT * FROM " . $this->post_table ." WHERE postid = :postid LIMIT 1";
                $postDetails = $this->fetch_row($pos, $query); 

                $pos2 = array('postid' => $params['postid'], 'reports' => $postDetails['reports'] + 1,);

                $query = "UPDATE ". $this->post_table ." SET reports = :reports WHERE postid = :postid LIMIT 1";
                $this->update($pos2, $query);
 
                //Record Activity
                $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Posts", 'details' => $params['username']." Reported a Post With ID: ".$params['postid'], ); 
                $admin_model->record_activity($info);
 
                return true;
            }
 
        } catch (Exception $e) {
 
            return "There is some errors: " . $e->getMessage();
        }
    }


    //Method to Create Or Update Post Comment
    public function user_post_new_comment($params)
    {
        //Admin Model
        $admin_model = new Admin();
        $pst = array('postid' => $params['postid'], );
        $chek = array('postid' => $params['postid'], 'commentby' => $params['uniqueid'], );

        try {
            $query = "SELECT * FROM " . $this->post_table ." WHERE postid = :postid LIMIT 1";
            $postDetails = $this->fetch_row($pst, $query);

            $query = "SELECT * FROM " . $this->postcomments_table ." WHERE postid = :postid AND commentby = :commentby LIMIT 1";
            $newSend = $this->fetch_row($chek, $query); 

            $newParams = array('postid' => $params['postid'], 'commentid' => $params['commentid'], 'postedby' => $postDetails['uniqueid'], 'commentby' => $params['uniqueid'], 'title' => substr($postDetails['details'], 0, 70), );

            $newParams0 = array('postid' => $params['postid'], 'commentid' => $params['commentid'], 'receiver' => $postDetails['uniqueid'], 'sender' => $params['uniqueid'], 'details' => $params['details'], );

            // Checking all User credentials...
            if (!$newSend) {

                $query = "INSERT INTO ". $this->postcomments_table ." (postid, commentid, postedby, commentby, title) VALUES (:postid, :commentid, :postedby, :commentby, :title)";
                $userComment = $this->insert($newParams, $query); 

                if ($userComment) {
                
                    $this->user_post_comment($newParams0);

                    $query = "SELECT * FROM " . $this->postact_table ." WHERE postid = :postid LIMIT 1";
                    $postActivity = $this->fetch_row($pst, $query); 

                    $pos2 = array('postid' => $params['postid'], 'comments' => $postActivity['comments'] + 1,);

                    $query = "UPDATE ". $this->postact_table ." SET comments = :comments WHERE postid = :postid LIMIT 1";
                    $this->update($pos2, $query);

                    //Record Activity
                    $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Posts", 'details' => $params['username']." Commented On a Post With ID: ".$params['postid'], ); 
                    $admin_model->record_activity($info);
                }

                return true;

            } else {

                return false;
            }
 
        } catch (Exception $e) {
 
            return "There is some errors: " . $e->getMessage();
        }
    }





    //Method to Create Or Update Post Comment
    public function user_post_comment($params)
    {
        //Admin Model
        $admin_model = new Admin();
        $new = array('postid' => $params['postid'], 'sender' => $params['sender'], 'receiver' => $params['receiver'], 'details' => $params['details'], );

        try {

            $query = "SELECT * FROM " . $this->postcommentreply_table ." WHERE postid = :postid AND sender = :sender AND receiver = :receiver AND details = :details LIMIT 1";
            $actview = $this->fetch_row($new, $query); 
            // Checking all User credentials...
            if (!$actview) {

                $newP = array('postid' => $params['postid'], 'commentid' => $params['commentid'], 'sender' => $params['sender'], 'receiver' => $params['receiver'], 'details' => $params['details'], );
         
                $query = "INSERT INTO ". $this->postcommentreply_table ." (postid, commentid, sender, receiver, details) VALUES (:postid, :commentid, :sender, :receiver, :details)";
                $this->insert($newP, $query); 

                return true;
            } else {

                return false;
            }
 
        } catch (Exception $e) {
 
            return "There is some errors: " . $e->getMessage();
        }
    }




    
    //All Posts List
    public function all_message_details($params)
    {
        $a = array('postedby' => $params['uniqueid'], );
        $b = array('receiver' => $params['uniqueid'], 'status' => "Unread", );
        try {
            $query="SELECT * FROM ". $this->postcomments_table ." WHERE postedby = :postedby OR commentby = :postedby ORDER BY created DESC";

            $msgList = $this->fetch_spec($a, $query);

            if ($msgList) {

                $query="SELECT * FROM ". $this->postcommentreply_table ." WHERE receiver = :receiver AND status = :status ORDER BY created DESC";

                $msgDetails = $this->fetch_spec($b, $query);

                $list = array('msgList' => $msgList, 'msgDetails' => $msgDetails, );

                return $list;

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





    //Method to Create Or Update Post Comment
    public function create_new_user_chat($params)
    {
        //Admin Model
        $admin_model = new Admin();
        $chek = array('uniqueid' => $params['sender'], 'buddyid' => $params['receiver'], );

        try {
            $query = "SELECT * FROM " . $this->buddychats_table ." WHERE uniqueid = :uniqueid AND buddyid = :buddyid OR uniqueid = :buddyid AND buddyid = :uniqueid LIMIT 1";
            $chatPals = $this->fetch_row($chek, $query);

            if (!$chatPals) {

                $newP = array('chatid' => $params['chatid'], 'uniqueid' => $params['sender'], 'buddyid' => $params['receiver'], );

                $query = "INSERT INTO ". $this->buddychats_table ." (chatid, uniqueid, buddyid) VALUES (:chatid, :uniqueid, :buddyid)";
                $newChat = $this->insert($newP, $query); 

                if ($newChat) {

                    $chatRecord = array('chatid' => $params['chatid'], 'sender' => $params['sender'], 'receiver' => $params['receiver'], 'file' => $params['file'], 'details' => $params['details'], );

                    $this->create_user_chat($chatRecord);
                }

                //Record Activity
                $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Chats", 'details' => $params['username']." Started a Chat With ID: ".$params['receiver'], ); 
                $admin_model->record_activity($info);

                return true;

            } else {

                return false;
            }
 
        } catch (Exception $e) {
 
            return "There is some errors: " . $e->getMessage();
        }
    }





    //Method to Create Or Update Post Comment
    public function create_user_chat($params)
    {
        //Admin Model
        $admin_model = new Admin();
        $new = array('chatid' => $params['chatid'], 'sender' => $params['sender'], 'receiver' => $params['receiver'], 'details' => $params['details'], );

        try {

            $query = "SELECT * FROM " . $this->buddychatreply_table ." WHERE chatid = :chatid AND sender = :sender AND receiver = :receiver AND details = :details LIMIT 1";
            $actview = $this->fetch_row($new, $query); 
            // Checking all User credentials...
            if (!$actview) {

                $newP = array('chatid' => $params['chatid'], 'sender' => $params['sender'], 'receiver' => $params['receiver'], 'file' => $params['file'], 'details' => $params['details'], );
         
                $query = "INSERT INTO ". $this->buddychatreply_table ." (chatid, sender, receiver, file, details) VALUES (:chatid, :sender, :receiver, :file, :details)";
                $this->insert($newP, $query); 

                return true;

            } else {

                return false;
            }
 
        } catch (Exception $e) {
 
            return "There is some errors: " . $e->getMessage();
        }
    }





    //Get User Post Comment Chat History
    public function fetch_comment_chats($data)
    {   
        $first = array('postedby' => $data['receiver'], 'commentby' => $data['sender'], 'postid' => $data['postid'], );
        
        try {

                $query="SELECT * FROM ". $this->postcomments_table ." WHERE postedby = :postedby AND commentby = :commentby AND postid = :postid OR postedby = :commentby AND commentby = :postedby AND postid = :postid LIMIT 1";
                $chatmates = $this->fetch_row($first, $query);
             
                if ($chatmates) {

                    $a = array('receiver' => $data['receiver'], 'sender' => $data['sender'], 'postid' => $data['postid'], 'commentid' => $chatmates['commentid'], 'status' => "Trash", );

                    $query = "SELECT * FROM ". $this->postcommentreply_table ." WHERE  receiver = :receiver AND sender = :sender AND postid = :postid AND commentid = :commentid AND status != :status OR receiver = :sender AND sender = :receiver AND postid = :postid AND commentid = :commentid AND status != :status ORDER BY id DESC"; 

                    $chat = $this->fetch_spec($a, $query);

                    if ($chat){

                        $a1 = array('postid' => $data['postid'], 'receiver' => $data['uniqueid'], 'commentid' => $data['commentid'], 'status' => "Unread", );
                        $query="SELECT * FROM ". $this->postcommentreply_table ." WHERE  receiver = :receiver AND status = :status AND postid = :postid AND commentid = :commentid";
                        $list = $this->fetch_spec($a1, $query);

                        if ($list) {
                            foreach ($list as $key => $li) {
                                if ($data['uniqueid'] == $li['receiver'] && $li['status'] == "Unread") {
            
                                    $pos = array('receiver' => $li['receiver'], 'commentid' => $li['commentid'], 'postid' => $li['postid'], 'status' => "Read", );
            
                                    $query = "UPDATE ". $this->postcommentreply_table ." SET status = :status WHERE commentid = :commentid AND postid = :postid AND receiver = :receiver";
                                    $this->update($pos, $query);
                                }
                            }
                        }
                    }

                    return $chat;

                } else {

                    return false;
                }

            }catch (Exception $e) {
                $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            );
            return $data;   
        }
    }




    //Method to Create Or Update Post Comment
    public function send_buddy_poke($params)
    {
        //Admin Model
        $admin_model = new Admin();
        $new = array('uniqueid' => $params['buddyid'], 'user_uniqueid' => $params['uniqueid'], 'details' => $params['details'], );
        
        $query = "SELECT * FROM ". $this->uact_table ." WHERE uniqueid = :uniqueid AND user_uniqueid = :user_uniqueid AND details = :details";
        $check = $this->fetch_spec($new, $query);
        try {
            if (count($check) < 3) { 
                $query0 = "INSERT INTO ". $this->uact_table ." (uniqueid, user_uniqueid, details) VALUES (:uniqueid, :user_uniqueid, :details)";
                $this->insert($new, $query0); 

                return true;

            } else {

                return false;
            }
 
        } catch (Exception $e) {
 
            return "There is some errors: " . $e->getMessage();
        }
    }




    //Method to Create Or Update Post Status
    public function user_post_status($params)
    {
        //Admin Model
        $admin_model = new Admin();
        $chek = array('uniqueid' => $params['uniqueid'], 'postid' => $params['postid'], );
        $newParams = array('uniqueid' => $params['uniqueid'], 'postid' => $params['postid'], 'status' => $params['status'], );
         
        try {
             $query = "SELECT * FROM " . $this->post_table ." WHERE uniqueid = :uniqueid AND postid = :postid LIMIT 1";
             $actview = $this->fetch_row($chek, $query); 
             // Checking all User credentials...
             if ($actview) {
 
                 if ($actview['status'] != $params['status']) { 

                     $query = "UPDATE ". $this->post_table ." SET status = :status WHERE uniqueid = :uniqueid AND postid = :postid LIMIT 1";
                     $this->update($newParams, $query);

                     //Record Activity
                    $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Posts", 'details' => $params['username']." Trashed a Post With ID: ".$params['postid'], ); 
                    $admin_model->record_activity($info);
 
                     return true;
                 }
 
                 return false;
 
             } else {
 
                return false;
            }
 
        } catch (Exception $e) {
 
            return "There is some errors: " . $e->getMessage();
        }
    }






    //Unread Messages Count (Post COmments)
    public function message_info_count($params)
    {
        $d = array('receiver' => $params['uniqueid'], );
        try {
            $query="SELECT count(*) FROM ". $this->postcommentreply_table ." WHERE receiver = :receiver AND status = 'Unread'";

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




    //Unread Messages Count (Post COmments)
    public function chat_info_count($params)
    {
        $d = array('receiver' => $params['uniqueid'], );
        try {
                $query="SELECT count(*) FROM ". $this->buddychatreply_table ." WHERE receiver = :receiver AND status = 'Unread'";

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
    



    //Online Now Count
    public function online_now_count()
    {
        $d = array('login_status' => "Logged_in", );
        try {
            $query="SELECT count(*) FROM ". $this->u_table ." WHERE login_status = :login_status";

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


   //Buddies Friend List Count
   public function user_buddies_count($params)
   {
       $d = array('uniqueid' => $params['uniqueid'], 'buddyid' => $params['uniqueid'], 'request' => "Accepted", );
       try {
           $query="SELECT count(*) FROM ". $this->buddy_table ." WHERE uniqueid = :uniqueid AND request = :request OR buddyid = :buddyid AND request = :request ";

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



   //User CHat Connections
   public function user_chat_connect($params)
   {
       
       try {

            $c = array('uniqueid' => $params['uniqueid'], 'buddyid' => $params['uniqueid'], );
            
            $query = "SELECT * FROM ". $this->buddychats_table ." WHERE uniqueid = :uniqueid OR buddyid = :buddyid ORDER BY created DESC";
            $chatUser = $this->fetch_spec($c, $query);

            if ($chatUser) { return $chatUser; } else { return false; }

       } catch (Exception $e) {

           $data = array(
               "type" => "error",
               "message" => $e->getMessage()
           ); 
           return $data;  
       }
  }



    //User CHat Messages
    public function user_chat_messages($params)
    {
        
        try {
            if ($params['buddyid'] != NULL) {

                $c = array('uniqueid' => $params['uniqueid'], 'buddyid' => $params['buddyid'], );
                
                $query = "SELECT * FROM ". $this->buddychats_table ." WHERE uniqueid = :uniqueid AND buddyid = :buddyid OR buddyid = :uniqueid AND uniqueid = :buddyid LIMIT 1";
                $chatUser = $this->fetch_row($c, $query);

                if ($chatUser) {

                    $d = array('sender' => $params['uniqueid'], 'receiver' => $params['buddyid'], 'chatid' => $chatUser['chatid'], 'status' => "Trash");

                    $query = "SELECT * FROM ". $this->buddychatreply_table ." WHERE receiver = :receiver AND sender = :sender AND status != :status OR sender = :receiver AND receiver = :sender AND status != :status";

                    $chatMsgs = $this->fetch_spec($d, $query);
                    
                    if ($chatMsgs) {

                        foreach ($chatMsgs as $key => $li) {
                            if ($params['uniqueid'] == $li['receiver'] && $li['status'] == "Unread") {
        
                                $pos = array('id' => $li['id'], 'sender' => $li['sender'], 'receiver' => $li['receiver'], 'chatid' => $li['chatid'], 'status' => "Read", );
        
                                $query = "UPDATE ". $this->buddychatreply_table ." SET status = :status WHERE chatid = :chatid AND receiver = :receiver AND sender = :sender AND id = :id";
                                $this->update($pos, $query);
                            }
                        }
        
                        return $chatMsgs;

                    } else {
                        return false;
                    }

                } else {

                    return false;
                }

            } else {

                $c = array('receiver' => $params['uniqueid'],  );

                $query = "SELECT * FROM ". $this->buddychatreply_table ." WHERE receiver = :receiver";
                $chatUser = $this->fetch_spec($c, $query);
                
                return $chatUser;
            }

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 
            return $data;  
        }
   }




    //User Subscription Payment
    public function user_subscription_payment($params)
    {
        //Admin Model
        $admin_model = new Admin();
        $today = date('Y-m-d');
        try {   
            $a = array('id' => "1", );
            $b = array('planid' => $params['planid'], );
            
            $query = "SELECT * FROM ". $this->subplan_table ." WHERE planid = :planid LIMIT 1";
            $plan = $this->fetch_row($b, $query);

            $query = "SELECT * FROM ". $this->cur_table ." WHERE id = :id LIMIT 1";
            $cur = $this->fetch_row($a, $query);

            $c = array('uniqueid' => $params['uniqueid'], 'status' => "Paid", );
            
            $query = "SELECT * FROM ". $this->subpayment_table ." WHERE uniqueid = :uniqueid AND status != :status LIMIT 1";
            $userTranc = $this->fetch_row($c, $query);

            if ($userTranc == NULL) {

                $d = array('trancid' => $params['trancid'].$today, 'uniqueid' => $params['uniqueid'], 'type' => $plan['type'], 'currency' => $cur['currency'], 'amount' => $plan['amount'], 'expiry' => $plan['expiry'], 'details' => "Payment Of ".$cur['currency'].$plan['amount']." Was Initialized By ".$params['username']." For ".$plan['type'], );

                $query = "INSERT INTO ". $this->subpayment_table ." (trancid, uniqueid, type, currency, expiry, amount, details) VALUES (:trancid, :uniqueid, :type, :currency, :expiry, :amount, :details)";
                $chatMsgs = $this->insert($d, $query);
                
                if ($chatMsgs) {

                    //Record Activity
                    $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Payment", 'details' => "Payment Of ".$cur['currency'].$plan['amount']." Was Initialized By ".$params['username'] ); 
                    $admin_model->record_activity($info);
                }

                return $chatMsgs;

            } else {

                $pos = array('id' => $userTranc['id'], 'trancid' => $params['trancid'].$today, 'uniqueid' => $params['uniqueid'], 'type' => $plan['type'], 'currency' => $cur['currency'], 'amount' => $plan['amount'], 'expiry' => $plan['expiry'], 'details' => "Payment Of ".$cur['currency'].$plan['amount']." Was Initialized By ".$params['username']." For ".$plan['type'], );

                $query = "UPDATE ". $this->subpayment_table ." SET trancid = :trancid, amount = :amount, currency = :currency, expiry = :expiry, type = :type, details = :details WHERE uniqueid = :uniqueid AND id = :id";
                $chatMsgs = $this->update($pos, $query);

                return $chatMsgs;
            }

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 
            return $data;  
        }
    }



    //Method to Fetch All User Transactions
    public function user_transactions_info($params)
    {
        //Admin Model
        $admin_model = new Admin();
        $new = array('uniqueid' => $params['uniqueid'], 'status' => "Trash", );

        try {

            $query = "SELECT * FROM " . $this->subpayment_table ." WHERE uniqueid = :uniqueid AND status != :status ORDER BY created DESC";
            $actview = $this->fetch_spec($new, $query); 
            // Checking all User credentials...

            return $actview;
    
        } catch (Exception $e) {
    
            return "There is some errors: " . $e->getMessage();
        }
    }
    
    
    
    



















    //Deactivate Account method For All Users
    public function deactivate_account($params)
    {
        $admin_model = new Admin();
        $c = array('uniqueid' => $params['uniqueid'], 'details' => $params['details'], );
        $d = array('uniqueid' => $params['uniqueid'], );
        $e = array('uniqueid' => $params['uniqueid'], 'login_status' => "Logged_out", 'log_session' => "End Session", 'status' => "Deactivated", );

        try {
            $query = "SELECT * FROM ". $this->u_table ." WHERE uniqueid = :uniqueid LIMIT 1";
            $user = $this->fetch_row($d, $query);

            if (password_verify($params['password'], $user['password'])) {

                $query0 = "INSERT INTO ". $this->delAcc_table ." (uniqueid, details) VALUES (:uniqueid, :details)";
                $this->insert($c, $query0); 
                
                $query1 = "UPDATE ". $this->u_table ." SET `login_status` = :login_status, `status` = :status, `log_session` = :log_session WHERE `uniqueid` = :uniqueid LIMIT 1";
                $this->logout($e, $query1);
                //Record Activity
                $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Authentication", 'details' => $params['username']." Deactivated Account", ); 
                $admin_model->record_activity($info);

                unset($params['uniqueid']);
                
                return true;
            } else {

                return false;

            }
        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e,
            );

            return $data;          
        }
    }


      
    
    //Post Views Count
    public function card_payment_info()
    {
       //$d = array('postid' => $params['postid'], );

        try {
            $query="SELECT * FROM ". $this->api_table ." ORDER BY created DESC";

            $postDetail = $this->fetch_all($query);

            return $postDetail;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 
            return $data;  
        }
    }




    //Get Exchange Rate Info When Paying With Card
    public function get_exchange_info($params)
    {
    $d = array('currency' => $params['currency'], 'status' => "Publish", );

        try {
            $query="SELECT * FROM ". $this->exchange_table ." WHERE currency = :currency AND status = :status LIMIT 1";

            $postDetail = $this->fetch_row($d, $query);

            return $postDetail;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 
            return $data;  
        }
    }




    //Create & Update Subscription Plan Information
    public function update_transaction_status($data = array())
    {
        //Admin Model
        $admin_model = new Admin();
        $a = array('id' => $data['id'], );
        $b = array('id' => $data['id'], 'status' => $data['status'], );

        try {
            $query = "SELECT * FROM ". $this->subpayment_table ." WHERE id = :id LIMIT 1";
            $check = $this->fetch_row($a, $query);

            if ($check) {

                if ($data['status'] != $check['status']) {

                    $query = "UPDATE ". $this->subpayment_table ." SET `status` = :status WHERE `id` = :id LIMIT 1";
                    $this->update($b, $query); 

                    //Record Activity
                    $info = array('uniqueid' => $data['uniqueid'], 'username' => $data['username'], 'category' => "Settings", 'details' => $data['username']." Updated Transaction Status For ".$check['trancid'], ); 
                    $admin_model->record_activity($info);

                    $query = "SELECT * FROM ". $this->subpayment_table ." WHERE id = :id LIMIT 1";
                    $fin = $this->fetch_row($a, $query);

                    return $fin;

                } else {

                    return false;
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




    //Fetch Subscription Plan Record
    public function user_subscription_plan($params)
    {
        $a = array('uniqueid' => $params['uniqueid'], 'status' => "Paid");
        try {
            $query = "SELECT * FROM " . $this->subpayment_table ." WHERE uniqueid = :uniqueid AND status = :status LIMIT 1";
            $actview = $this->fetch_row($a, $query); 
            
            if($actview != NULL){
                
                return $actview;

            } else {

                return false;
            }

        } catch (Exception $e) {

            return "There is some errors: " . $e->getMessage();
        }
    }

     

    //Record Activity
    public function record_user_activity($params)
    {
        try {

            $query = "SELECT * FROM " . $this->uact_table ." WHERE uniqueid = :uniqueid AND user_uniqueid = :user_uniqueid AND details = :details LIMIT 1";
            $actview = $this->fetch_row($params, $query); 
            
            if(!$actview){
                $query = "INSERT INTO ". $this->uact_table ." (uniqueid, user_uniqueid, details) VALUES (:uniqueid, :user_uniqueid, :details)";
                $this->insert($params, $query); 

                return true;
            }

        } catch (Exception $e) {

        	return "There is some errors: " . $e->getMessage();
        }
    }


    //Buddy Activity Count
    public function count_user_activity($params)
    {
        $d = array('uniqueid' => $params['uniqueid'], 'status' => "Unread", );
        try {
            $query="SELECT count(*) FROM ". $this->uact_table ." WHERE uniqueid = :uniqueid AND status = :status";

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


    //User Views Count
    public function count_user_views($params)
    {
        $d = array('uniqueid' => $params['uniqueid'], );
        try {
            $query="SELECT sum(views) FROM ". $this->views_table ." WHERE uniqueid = :uniqueid";

            $count = $this->total_sum($d, $query);

            return $count;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
            ); 
            return $data;  
        }
    }



    //User Likes Count
    public function count_user_likes($params)
    {
        $d = array('uniqueid' => $params['uniqueid'], 'action' => "Like", );
        try {
            $query="SELECT count(*) FROM ". $this->actions_table ." WHERE uniqueid = :uniqueid AND action = :action";

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



    
    //Fetch All New Buddy Activity
    public function new_user_activity($params)
    {
        $d = array('uniqueid' => $params['uniqueid'], 'status' => "Unread", );
        try {
            $query="SELECT * FROM ". $this->uact_table ." WHERE uniqueid = :uniqueid AND status = :status";

            $info = $this->fetch_spec($d, $query);

            return $info;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
                ); 
                return $data;  
        }
    }



    //Fetch All New Message Details For Buddy
    public function new_message_details($params)
    {
        $d = array('receiver' => $params['uniqueid'], 'status' => "Unread", );
        try {
            $query="SELECT * FROM ". $this->postcommentreply_table ." WHERE receiver = :receiver AND status = :status";

            $info = $this->fetch_spec($d, $query);

            return $info;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
                ); 
                return $data;  
        }
    }



    //Fetch All New Chat Details For Buddy
    public function new_chat_details($params)
    {
        $d = array('receiver' => $params['uniqueid'], 'status' => "Unread", );
        try {
            $query="SELECT * FROM ". $this->buddychatreply_table ." WHERE receiver = :receiver AND status = :status";

            $info = $this->fetch_spec($d, $query);

            return $info;

        } catch (Exception $e) {

            $data = array(
                "type" => "error",
                "message" => $e->getMessage()
                ); 
                return $data;  
        }
    }




    //Method to Fetch All Buddy Activities
    public function buddy_activities($params)
    {
        //Admin Model
        $admin_model = new Admin();
        $newParams = array('uniqueid' => $params['uniqueid'], );
        
        try {
            $query = "SELECT * FROM " . $this->uact_table ." WHERE uniqueid = :uniqueid AND status != 'Trash' ORDER BY created DESC";
            $actview = $this->fetch_spec($newParams, $query);

            if ($actview) {
                $newP = array('uniqueid' => $params['uniqueid'], 'status' => "Read");

                $query = "UPDATE ". $this->uact_table ." SET status = :status WHERE uniqueid = :uniqueid AND status = 'Unread'";
                $this->update($newP, $query);

                return $actview;
            } else {

                return $actview;
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