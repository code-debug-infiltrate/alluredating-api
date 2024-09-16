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
    protected $cur_table = "app_currency";  //Currency Table
    protected $notify_table = "app_notify";  //Notification Table
    protected $api_table = "app_thirdpartyapi";  //Third Party API Table
    protected $delAcc_table = "app_delete_account";  //Delete Account  Table
    //User Preferences
    protected $album_table = "app_user_album";  // Album Table
    protected $self_table = "app_user_self";  //User Self Table
    protected $actions_table = "app_user_actions";  //User Actions Table
    protected $buddy_table = "app_user_buddy";  //User Buddy Table
    protected $views_table = "app_user_views";  //User Views Table
    protected $pref_table = "app_user_preferences";  //User Preferences Table
    protected $lng_table = "app_user_languages";  //Languages Table
    protected $workedu_table = "app_user_workeducation";  //Work & Education History Table
    protected $int_table = "app_user_interests";  //Interests Table
    protected $uact_table = "app_user_activity";  //Activity For Users Table




    //Fetch All User Profiles
    public function user_profiles()
    {
        try {
            $query = "SELECT uniqueid, fname, lname, dob, gender, address, city, country, number, occupation, profileimage, coverimage, details FROM ". $this->p_table ." ORDER BY created DESC";
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
            $query1 = "SELECT * FROM ". $this->act_table ." WHERE uniqueid = :uniqueid ORDER BY created DESC LIMIT 50";
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
        $newParams = array('uniqueid' => $params['uniqueid'], 'gender' => $params['gender'], 'orientation' => $params['orientation'], 'height' => $params['height'], 'weight' => $params['weight'], 'bodytype' => $params['bodytype'], 'seeking' => $params['seeking'], 'ethnicity' => $params['ethnicity'], 'religion' => $params['religion'], 'pets' => $params['pets'], 'dates' => $params['dates'], 'dress' => $params['dress'], 'eating' => $params['eating'], 'smoking' => $params['smoking'], 'drinking' => $params['drinking'], 'color' => $params['color'], 'employment' => $params['employment'], 'details' => $params['details'],
        );
        
        try {
            $query = "SELECT * FROM " . $this->pref_table ." WHERE uniqueid = :uniqueid LIMIT 1";
            $bio = $this->fetch_row($a, $query); 
            // Checking all User credentials...
            if ($bio) {

                $query0 = "UPDATE ". $this->pref_table ." SET gender = :gender, orientation = :orientation, height = :height, weight = :weight, bodytype = :bodytype, seeking = :seeking, ethnicity = :ethnicity, religion = :religion, pets = :pets, dates = :dates, dress = :dress, eating = :eating, smoking = :smoking, drinking = :drinking, color = :color, employment = :employment, details = :details WHERE uniqueid = :uniqueid LIMIT 1";
                $this->update($newParams, $query0); 
                
                //Record Activity
                $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Dating", 'details' => $params['username']." Updated Preferred Attributes Details", ); 
                $admin_model->record_activity($info);

                return true;

            } else {

                $query = "INSERT INTO ". $this->pref_table ." (uniqueid, gender, orientation, height, weight, bodytype, seeking, ethnicity, religion, pets, dates, dress, eating, smoking, drinking, color, employment, details) VALUES (:uniqueid, :gender, :orientation, :height, :weight, :bodytype, :seeking, :ethnicity, :religion, :pets, :dates, :dress, :eating, :smoking, :drinking, :color, :employment, :details)";
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
        $newParams = array('uniqueid' => $params['uniqueid'], 'orientation' => $params['orientation'], 'height' => $params['height'], 'weight' => $params['weight'], 'bodytype' => $params['bodytype'], 'seeking' => $params['seeking'], 'ethnicity' => $params['ethnicity'], 'religion' => $params['religion'], 'pets' => $params['pets'], 'dates' => $params['dates'], 'dress' => $params['dress'], 'eating' => $params['eating'], 'smoking' => $params['smoking'], 'drinking' => $params['drinking'], 'color' => $params['color'], 'employment' => $params['employment'], 'details' => $params['details'],
        );
        
        try {
            $query = "SELECT * FROM " . $this->self_table ." WHERE uniqueid = :uniqueid LIMIT 1";
            $bio = $this->fetch_row($a, $query); 
            // Checking all User credentials...
            if ($bio) {

                $query0 = "UPDATE ". $this->self_table ." SET orientation = :orientation, height = :height, weight = :weight, bodytype = :bodytype, seeking = :seeking, ethnicity = :ethnicity, religion = :religion, pets = :pets, dates = :dates, dress = :dress, eating = :eating, smoking = :smoking, drinking = :drinking, color = :color, employment = :employment, details = :details WHERE uniqueid = :uniqueid LIMIT 1";
                $this->update($newParams, $query0); 
                
                //Record Activity
                $info = array('uniqueid' => $params['uniqueid'], 'username' => $params['username'], 'category' => "Dating", 'details' => $params['username']." Updated Personal Attributes Details", ); 
                $admin_model->record_activity($info);

                return true;

            } else {

                $query = "INSERT INTO ". $this->self_table ." (uniqueid, orientation, height, weight, bodytype, seeking, ethnicity, religion, pets, dates, dress, eating, smoking, drinking, color, employment, details) VALUES (:uniqueid, :orientation, :height, :weight, :bodytype, :seeking, :ethnicity, :religion, :pets, :dates, :dress, :eating, :smoking, :drinking, :color, :employment, :details)";
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

                $prefMatch = array('uniqueid' => $param['uniqueid'], 'orientation' => $myselfInfo['orientation'], 'ethnicity' => $myselfInfo['ethnicity'], 'religion' => $myselfInfo['religion'], 'color' => $myselfInfo['color'], 'employment' => $myselfInfo['employment'], 'seeking' => $myselfInfo['seeking'], 'smoking' => $myselfInfo['smoking'], 'drinking' => $myselfInfo['drinking'], );

                $query0 = "SELECT * FROM ". $this->self_table ." WHERE orientation = :orientation AND ethnicity = :ethnicity AND religion = :religion AND color = :color AND employment = :employment AND seeking = :seeking AND smoking = :smoking AND drinking = :drinking AND uniqueid != :uniqueid OR orientation = 'Any' OR ethnicity = 'Any' OR religion = 'Any' OR color = 'Any' OR employment = 'Any' OR seeking = 'Any' OR smoking = 'Any' OR drinking = 'Any' ORDER BY created DESC";
                $matchInfo = $this->fetch_spec($prefMatch, $query0); 

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

                $prefMatch = array('uniqueid' => $param['uniqueid'], 'orientation' => $myselfInfo['orientation'], 'seeking' => $myselfInfo['seeking'], );

                $query0 = "SELECT * FROM ". $this->self_table ." WHERE orientation = :orientation AND seeking = :seeking AND uniqueid != :uniqueid OR orientation = 'Any' AND seeking = :seeking AND uniqueid != :uniqueid OR orientation = :orientation AND seeking = 'Any' AND uniqueid != :uniqueid ORDER BY RAND() DESC LIMIT 50";
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
                    $info = array('uniqueid' => $params['buddyid'], 'user_uniqueid' => $params['uniqueid'], 'details' => $params['buddyname']." Accepted Your Buddy Request.", ); 
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







    //Unread Messages Count
    public function messageInfoCount($params)
    {
        $d = array('receiver' => $params['uniqueid'], );
        try {
            $query="SELECT count(*) FROM ". $this->tck_table ." WHERE receiver = :receiver AND status = 'Unread'";

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














    //Login method For All Users
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



    //Method to Fetch All Buddy Activities
    public function buddy_activities($params)
    {
        //Admin Model
        $admin_model = new Admin();
        $newParams = array('uniqueid' => $params['uniqueid'], );
        
        try {
            $query = "SELECT * FROM " . $this->uact_table ." WHERE uniqueid = :uniqueid ORDER BY created DESC";
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