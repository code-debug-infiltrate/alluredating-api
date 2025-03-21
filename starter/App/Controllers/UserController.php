<?php 

//Required Files
require_once __DIR__.'/../Models/Members.php';



    class UserController
    {


        //Method To Fetch All Latest Posts
        public function card_payment_info()
        {
            //User Model
            $model_connect = new Members();

            //Model Function Call
            $actInfo = $model_connect->card_payment_info();

            $data = array(
                'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                'post_details' => $actInfo,
            );

            return $data; 
        }




        //Method To Fetch Exchange Rate Details
        public function get_exchange_info($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $actInfo = $model_connect->get_exchange_info($fillable);

            $data = array(
                'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                'post_details' => $actInfo,
            );

            return $data; 
        }




        //Method To Fetch All User Profiles
        public function user_profiles()
        {
            //User Model
            $model_connect = new Members();

            //Model Function Call
            $actInfo = $model_connect->user_profiles();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'user_profiles' => $actInfo,
                );

            return $data; 
        }



        //Method To Fetch All User Profiles
        public function users_online_status()
        {
            //User Model
            $model_connect = new Members();

            //Model Function Call
            $actInfo = $model_connect->users_online_status();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'users_status' => $actInfo,
                );

            return $data; 
        }


        //Method For User Dashboard
        public function user_information($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $userInfo = $model_connect->user_info($fillable);

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful, User Is Active", ),
                    'user_info' => $userInfo,
                );

            return $data; 
        }



        //Method For User Interests
        public function user_interests($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $actInfo = $model_connect->user_interests($fillable);

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'interests_info' => $actInfo,
                );

            return $data; 
        }




        //Method For User Activities
        public function user_preference($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $actInfo = $model_connect->user_preference($fillable);

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'preference_info' => $actInfo,
                );

            return $data; 
        }



        //Method For User Myself Attributes
        public function user_myself($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $actInfo = $model_connect->user_myself($fillable);

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'myself_info' => $actInfo,
                );

            return $data; 
        }




        //Method For User Album
        public function user_album($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $actInfo = $model_connect->user_album($fillable);

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'album_info' => $actInfo,
                );

            return $data; 
        }



        //Method For User Work & Education
        public function user_workeducation($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $actInfo = $model_connect->user_workeducation($fillable);

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'workeducation_info' => $actInfo,
                );

            return $data; 
        }



        //Method For User Language
        public function user_language($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $actInfo = $model_connect->user_language($fillable);

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'language_info' => $actInfo,
                );

            return $data; 
        }


        //Method For User Activities
        public function user_activity($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $actInfo = $model_connect->user_activity($fillable);

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'activity_info' => $actInfo,
                );

            return $data; 
        }



        //Method For Create Interest
        public function create_interest($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $result = $model_connect->create_interest($fillable);

            if ($result == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Successful, Interest Added!",
                        ),
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Max Number Reached Or Retry With New Details",
                        ),
                    );
            }

            return $data; 
        }




        //Method For Create language
        public function create_language($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $result = $model_connect->create_language($fillable);

            if ($result == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Successful, Language Added!",
                        ),
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Max Number Reached Or Retry With New Details",
                        ),
                    );
            }

            return $data; 
        }





        //Method For User Activities
        public function update_password($params)
        {
            //User Model
            $model_connect = new Members();
            //User Account Parameters
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $result = $model_connect->update_password($fillable);

            if ($result == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Successful, Password Updated!",
                        ),
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Wrong Credentials, Retry With New Information.",
                        ),
                    );
            }

            return $data; 
        }




        //Method For User Activities
        public function update_username($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $result = $model_connect->update_username($fillable);

            if ($result == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Successful, Username Updated!",
                        ),
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Username Taken, Retry With New Information.",
                        ),
                    );
            }

            return $data; 
        }



        //Method For Update Location
        public function update_location($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $result = $model_connect->update_location($fillable);

            if ($result == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Successful, Location Updated!",
                        ),
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Retry With New Details",
                        ),
                    );
            }

            return $data; 
        }



    
        //Method For Update Work N Education
        public function update_workneducation($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $result = $model_connect->update_workneducation($fillable);

            if ($result == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Successful, Work & Education Updated!",
                        ),
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Retry With New Details",
                        ),
                    );
            }

            return $data; 
        }




        //Method For Update Bio Details
        public function update_bio($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $result = $model_connect->update_bio($fillable);

            if ($result == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Successful, Bio Details Updated!",
                        ),
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Retry With New Details",
                        ),
                    );
            }

            return $data; 
        }




        //Method For Update Notification Status
        public function update_notification_status($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $result = $model_connect->update_notification_status($fillable);

            if ($result == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Successful, Notification Status Updated!",
                        ),
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Retry With New Details",
                        ),
                    );
            }

            return $data; 
        }



        //Method For Update Activity Status
        public function update_activity_status($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $result = $model_connect->update_activity_status($fillable);

            if ($result == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Successful, Activity Status Updated!",
                        ),
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Retry With New Details",
                        ),
                    );
            }

            return $data; 
        }



        //Method For Update Profile Photo
        public function update_profile_photo($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $result = $model_connect->update_profile_photo($fillable);

            if ($result == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Successful, Profile Photo Updated!",
                        ),
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Retry With New Details",
                        ),
                    );
            }

            return $data; 
        }



        //Method For Update Cover Photo
        public function update_cover_photo($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $result = $model_connect->update_cover_photo($fillable);

            if ($result == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Successful, Profile Photo Updated!",
                        ),
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Retry With New Details",
                        ),
                    );
            }

            return $data; 
        }



        //Method For Update Myself Attributes
        public function update_myself($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $result = $model_connect->update_myself($fillable);

            if ($result == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Successful, Personal Attributes Updated!",
                        ),
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Retry With New Details",
                        ),
                    );
            }

            return $data; 
        }



        //Method For Update Preference Attributes
        public function update_preference($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $result = $model_connect->update_preference($fillable);

            if ($result == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Successful, Ideal Date Attributes Updated!",
                        ),
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Retry With New Details",
                        ),
                    );
            }

            return $data; 
        }



        //Method For User To Find Matches
        public function user_find_people($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $actInfo = $model_connect->user_find_people($fillable);

            if ($actInfo != false) {

                $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'people_info' => $actInfo,
                );
                return $data;
                
             } else {

                $data = array(
                    'result_info' => array('code' => "401", 'type' => "error", 'message' => "No Record Found", ),
                    'people_info' => false,
                );
 
                 return $data; 
            }
        }


         //Method For User To Random Matches
         public function user_random_people($params)
         {
             //User Model
             $model_connect = new Members();
             $fillable = array_map("htmlspecialchars", $params);
             //Model Function Call
             $actInfo = $model_connect->user_random_people($fillable);
 
             if ($actInfo) {

                $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'buddy_info' => $actInfo,
                );
                return $data;

             } else {

                $data = array(
                    'result_info' => array('code' => "401", 'type' => "error", 'message' => "No Record Found", ),
                    'buddy_info' => false,
                );
 
                 return $data; 
            }
         }



        //Method For Online User Count
        public function online_now_count()
        {
            //User Model
            $model_connect = new Members();
            //Model Function Call
            $actInfo = $model_connect->online_now_count();

            return $actInfo;
        }


        //Method For Online User Count
        public function count_user_activity($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $actInfo = $model_connect->count_user_activity($fillable);

            return $actInfo;
        }


        //Method For User Views Count
        public function count_user_views($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $actInfo = $model_connect->count_user_views($fillable);

            return $actInfo;
        }


        //Method For User Likes Count
        public function count_user_likes($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $actInfo = $model_connect->count_user_likes($fillable);

            return $actInfo;
        }


        //Method For Buddy Activity Records
        public function buddy_activities($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $actInfo = $model_connect->buddy_activities($fillable);

            return $actInfo;
        }




        //Method For Buddy Activity Records
        public function user_transaction_status($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $actInfo = $model_connect->update_transaction_status($fillable);

            return $actInfo;
        }
        
        

        //Method For All New User Activities Info
        public function new_user_activity($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $actInfo = $model_connect->new_user_activity($fillable);

            if ($actInfo) {

                $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'notification_info' => $actInfo,
                );

                return $data;

            } else {

                $data = array(
                    'result_info' => array('code' => "401", 'type' => "error", 'message' => "An Error Occured", ),
                    'notification_info' => $actInfo,
                );

                return $data;
            } 
        }

        
        //Method For User Actions On Buddy Profile
        public function user_actions($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $actInfo = $model_connect->user_actions($fillable);

            if ($actInfo) {

                $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'myself_info' => $actInfo,
                );

                return $data;

            } else {

                $data = array(
                    'result_info' => array('code' => "401", 'type' => "error", 'message' => "An Error Occured", ),
                    'myself_info' => $actInfo,
                );

                return $data;
            } 
        }


        //Method For User Views On Buddy Profile
        public function user_views($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $actInfo = $model_connect->user_views($fillable);

            if ($actInfo) {

                $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'myself_info' => $actInfo,
                );

                return $data;

            } else {

                $data = array(
                    'result_info' => array('code' => "401", 'type' => "error", 'message' => "An Error Occured", ),
                    'myself_info' => $actInfo,
                );

                return $data;
            }
        }


        //Method For User To Add Buddy
        public function user_add_buddy($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $actInfo = $model_connect->user_add_buddy($fillable);

            if ($actInfo) {

                $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'myself_info' => $actInfo,
                );

                return $data;

            } else {

                $data = array(
                    'result_info' => array('code' => "401", 'type' => "error", 'message' => "An Error Occured", ),
                    'myself_info' => $actInfo,
                );

                return $data;
            }
        }



        //Method For User To Accept Buddy
        public function user_accept_buddy($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $actInfo = $model_connect->user_accept_buddy($fillable);

            if ($actInfo) {

                $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'myself_info' => $actInfo,
                );

                return $data;

            } else {

                $data = array(
                    'result_info' => array('code' => "401", 'type' => "error", 'message' => "An Error Occured", ),
                    'myself_info' => $actInfo,
                );

                return $data;
            } 
        }

        

        //Method For User To Count Buddy
        public function user_buddies_count($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $actInfo = $model_connect->user_buddies_count($fillable);

            if ($actInfo) {

                $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'buddiesCount_info' => $actInfo,
                );

                return $data;

            } else {

                $data = array(
                    'result_info' => array('code' => "401", 'type' => "error", 'message' => "An Error Occured", ),
                    'buddiesCount_info' => $actInfo,
                );

                return $data;
            }
        }
        


        //Method For User To List All Buddies
        public function user_buddies_list($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $actInfo = $model_connect->user_buddies_list($fillable);

            if ($actInfo) {

                $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'buddiesList_info' => $actInfo,
                );

                return $data;

            } else {

                $data = array(
                    'result_info' => array('code' => "401", 'type' => "error", 'message' => "An Error Occured", ),
                    'buddiesList_info' => $actInfo,
                );

                return $data;
            }
        }
        


        //Method to Create New Post 
        public function user_create_post($params, $images)
        {
            //Member Model
            $model_connect = new Members();
            // Generate the postid
            $length = 5;
            $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
            $code = preg_replace('/\s+/', '', substr(str_shuffle(trim($chars)), 0, $length));
            $postid = preg_replace('/\s+/', '', trim('ads').trim($code));
            $url = htmlspecialchars(str_replace(' ', '', trim($params['url']).trim($postid)."/"));
            //User Account Parameters
            $fillable = array(
                'postid' => $postid,
                'uniqueid' => htmlspecialchars($params['uniqueid']),
                'username' => htmlspecialchars($params['username']),
                'details' => htmlspecialchars($params['details']),
                'file' => htmlspecialchars($params['file']),
                'url' => $url,
            );

            //Model Function Call
            $member = $model_connect->user_create_post($fillable, $images);

            if ($member == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Successfully Posted."
                        ),
                    'post_info' => $member,
                );
            
                return $data; 

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Sorry, This Post Already Exists In Our Records, Be More Creative."
                        ),
                        'post_info' => $member,
                );
            
                return $data; 
            }
        }




        //Method To Fetch All Latest Posts
        public function get_latest_posts()
        {
            //User Model
            $model_connect = new Members();

            //Model Function Call
            $actInfo = $model_connect->get_latest_posts();

            $data = array(
                'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                'post_details' => $actInfo,
            );

            return $data; 
        }




        //Method To Fetch All Latest Posts
        public function get_post_details($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $actInfo = $model_connect->get_post_details($fillable);

            $data = array(
                'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                'post_details' => $actInfo,
            );

            return $data; 
        }





        //Method To Fetch All Latest Posts
        public function my_post_action($params)
        {
             //User Model
             $model_connect = new Members();
             $fillable = array_map("htmlspecialchars", $params);
             //Model Function Call
             $actInfo = $model_connect->my_post_action($fillable);
 
             $data = array(
                 'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                 'my_post_actions' => $actInfo,
             );
 
             return $data; 
        }
 




        //Method To Fetch All Latest Posts Files
        public function get_latest_posts_files()
        {
            //User Model
            $model_connect = new Members();

            //Model Function Call
            $actInfo = $model_connect->get_latest_posts_files();

            $data = array(
                'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                'post_files' => $actInfo,
            );

            return $data; 
        }




        //Method to Fetch Post Interaction 
        public function get_post_actions()
        {
             //Member Model
             $model_connect = new Members();
 
             //Model Function Call
             $postAct = $model_connect->get_post_actions();
 
             if ($postAct == true) {
 
                 $data = array(
                     'result_info' => 
                         array(
                             'code' => "200",
                             'type' => "success",
                             'message' => "",
                         ),
                     'post_interactions' => $postAct,
                     );
 
             } else {
 
                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "No Interaction Recorded!",
                        ),
                    'post_interactions' => "",
                );
             }
             
             return $data; 
        }
       
        

        //Method For User To Count New Messages
        public function message_info_count($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $actInfo = $model_connect->message_info_count($fillable);

            if ($actInfo) {

                $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'newmsg_count' => $actInfo,
                );

                return $data;

            } else {

                $data = array(
                    'result_info' => array('code' => "401", 'type' => "error", 'message' => "An Error Occured", ),
                    'newmsg_count' => $actInfo,
                );

                return $data;
            }
        }



        //Method For User To Get New Messages Details
        public function new_message_details($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $actInfo = $model_connect->new_message_details($fillable);

            if ($actInfo) {

                $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'newmsg_details' => $actInfo,
                );

                return $data;

            } else {

                $data = array(
                    'result_info' => array('code' => "401", 'type' => "error", 'message' => "An Error Occured", ),
                    'newmsg_details' => $actInfo,
                );

                return $data;
            }
        }



        //Method to Create New User Post Comment 
        public function all_message_details($params)
        {
             //Member Model
             $model_connect = new Members();
             $fillable = array_map("htmlspecialchars", $params);
 
             //Model Function Call
             $postAct = $model_connect->all_message_details($fillable);
 
             if ($postAct != false) {
 
                 $data = array(
                     'result_info' => 
                         array(
                             'code' => "200",
                             'type' => "success",
                             'message' => "Comment Posted!",
                         ),
                     'all_msgs' => $postAct,
                     );
 
             } else {
 
                 $data = array(
                     'result_info' => 
                         array(
                             'code' => "401",
                             'type' => "error",
                             'message' => "Aborted!",
                         ),
                     'all_msgs' => array('msgList' => '', 'msgDetails' => ''),
                     );
             }
             
             return $data; 
        }




        //Get User Post Comment Chat History
        public function fetch_comment_chats($params)
        {
            //Member Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $postAct = $model_connect->fetch_comment_chats($fillable);

            if ($postAct) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Comment Posted!",
                        ),
                    'comment_chats' => $postAct,
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Aborted!",
                        ),
                    'comment_chats' => "",
                    );
            }
            
            return $data; 
        }





        //Method For User To Count New Chats
        public function chat_info_count($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $actInfo = $model_connect->chat_info_count($fillable);

            if ($actInfo) {

                $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'newchat_count' => $actInfo,
                );

                return $data;

            } else {

                $data = array(
                    'result_info' => array('code' => "401", 'type' => "error", 'message' => "An Error Occured", ),
                    'newchat_count' => $actInfo,
                );

                return $data;
            }
        }




        //Method For User To Get New Chat Details
        public function new_chat_details($params)
        {
            //User Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $actInfo = $model_connect->new_chat_details($fillable);

            if ($actInfo) {

                $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'newchat_details' => $actInfo,
                );

                return $data;

            } else {

                $data = array(
                    'result_info' => array('code' => "401", 'type' => "error", 'message' => "An Error Occured", ),
                    'newchat_details' => $actInfo,
                );

                return $data;
            }
        }


        //Method to Create New User Post Interaction 
        public function user_post_interaction($params)
        {
             //Member Model
             $model_connect = new Members();
             $fillable = array_map("htmlspecialchars", $params);
 
             //Model Function Call
             $postAct = $model_connect->user_post_interaction($fillable);
 
             if ($postAct == true) {
 
                 $data = array(
                     'result_info' => 
                         array(
                             'code' => "200",
                             'type' => "success",
                             'message' => "",
                         ),
                     'user_post_interaction' => $postAct,
                     );
 
             } else {
 
                 $data = array(
                     'result_info' => 
                         array(
                             'code' => "401",
                             'type' => "error",
                             'message' => "No Interaction Recorded!",
                         ),
                     'user_post_interaction' => "",
                     );
             }
             
             return $data; 
        }





        //Method to Create New User Post Interaction 
        public function user_post_actions($params)
        {
              //Member Model
              $model_connect = new Members();
              $fillable = array_map("htmlspecialchars", $params);
              //Model Function Call
              $postAct = $model_connect->user_post_actions($fillable);
  
              if ($postAct == true) {
  
                  $data = array(
                      'result_info' => 
                          array(
                              'code' => "200",
                              'type' => "success",
                              'message' => "Successful",
                          ),
                      'user_post_interaction' => $postAct,
                      );
  
              } else {
  
                  $data = array(
                      'result_info' => 
                          array(
                              'code' => "401",
                              'type' => "error",
                              'message' => "Not Recorded!",
                          ),
                      'user_post_interaction' => "",
                      );
              }
              
              return $data; 
        }




        //Method to Create New User Post Reports 
        public function user_post_reports($params)
        {
             //Member Model
             $model_connect = new Members();
             $fillable = array_map("htmlspecialchars", $params);
 
             //Model Function Call
             $postAct = $model_connect->user_post_reports($fillable);
 
             if ($postAct == true) {
 
                 $data = array(
                     'result_info' => 
                         array(
                             'code' => "200",
                             'type' => "success",
                             'message' => "Reported!",
                         ),
                     'result_message' => $postAct,
                     );
 
             } else {
 
                 $data = array(
                     'result_info' => 
                         array(
                             'code' => "401",
                             'type' => "error",
                             'message' => "Not Reported!",
                         ),
                     'result_message' => "",
                     );
             }
             
             return $data; 
        }

        

        //Method to Create New User Post Comment 
        public function user_post_comment($params)
        {
             //Member Model
             $model_connect = new Members();

             $length = 5;
             $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
             $code = preg_replace('/\s+/', '', substr(str_shuffle(trim($chars)), 0, $length));
             $commentid = preg_replace('/\s+/', '', trim('pcmt').trim($code));
             
            //User Account Parameters
            if ($params['commentid'] == NULL) {
                $fillable = array(
                    'uniqueid' => htmlspecialchars($params['uniqueid']),
                    'username' => htmlspecialchars($params['username']),
                    'commentid' => $commentid,
                    'postid' => htmlspecialchars($params['postid']),
                    'details' => htmlspecialchars($params['details']),
                );

                //Model Function Call
                $postAct = $model_connect->user_post_new_comment($fillable);

            } else {

                $fillable = array_map("htmlspecialchars", $params);

                //Model Function Call
                $postAct = $model_connect->user_post_comment($fillable);
            }
 
            
 
             if ($postAct == true) {
 
                 $data = array(
                     'result_info' => 
                         array(
                             'code' => "200",
                             'type' => "success",
                             'message' => "Comment Posted!",
                         ),
                     'result_message' => $postAct,
                     );
 
             } else {
 
                 $data = array(
                     'result_info' => 
                         array(
                             'code' => "401",
                             'type' => "error",
                             'message' => "Aborted!",
                         ),
                     'result_message' => "",
                     );
             }
             
             return $data; 
        }



        //Method to Create New User Post Reports 
        public function user_post_status($params)
        {
             //Member Model
             $model_connect = new Members();
             $fillable = array_map("htmlspecialchars", $params);
 
             //Model Function Call
             $postAct = $model_connect->user_post_status($fillable);
 
             if ($postAct == true) {
 
                 $data = array(
                     'result_info' => 
                         array(
                             'code' => "200",
                             'type' => "success",
                             'message' => "Deleted!",
                         ),
                     'result_message' => $postAct,
                     );
 
             } else {
 
                 $data = array(
                     'result_info' => 
                         array(
                             'code' => "401",
                             'type' => "error",
                             'message' => "Not Deleted!",
                         ),
                     'result_message' => "",
                     );
             }
             
             return $data; 
        }

        



        //Method to Create New Chat 
        public function create_user_chat($params)
        {
            //Member Model
            $model_connect = new Members();
            $length = 5;
            $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
            $code = preg_replace('/\s+/', '', substr(str_shuffle(trim($chars)), 0, $length));
            $chatid = preg_replace('/\s+/', '', trim('chat').trim($code));
            
            //User Account Parameters
            if ($params['chatid'] != NULL) {

                $fillable = array_map("htmlspecialchars", $params);
    
                //Model Function Call
                $chatInfo = $model_connect->create_user_chat($fillable);

            } else {
                $fillable = array(
                    'chatid' => $chatid,
                    'uniqueid' => htmlspecialchars($params['uniqueid']),
                    'receiver' => htmlspecialchars($params['receiver']),
                    'username' => htmlspecialchars($params['username']),
                    'sender' => htmlspecialchars($params['sender']),
                    'file' => htmlspecialchars($params['file']),
                    'details' => htmlspecialchars($params['details']),
                );
    
                //Model Function Call
                $chatInfo = $model_connect->create_new_user_chat($fillable);
            }

            if ($chatInfo == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Message Sent Successfully",
                        ),
                    'user_chat_info' => $chatInfo,
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "Continue Your Conversation In Chats",
                        ),
                    'user_chat_info' => $chatInfo,
                );
            }
            
            return $data; 
        }



        //Method to Get User Chats 
        public function user_chat_messages($params)
        {
            //Member Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $chatInfo = $model_connect->user_chat_messages($fillable);

            if ($chatInfo) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "",
                        ),
                    'user_chat_info' => $chatInfo,
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "No Chat Record Found. Start a Conversation",
                        ),
                    'user_chat_info' => "",
                    );
            }
            
            return $data; 
        }







        //Method to Get User Chats 
        public function user_chat_connect($params)
        {
            //Member Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $chatInfo = $model_connect->user_chat_connect($fillable);

            if ($chatInfo != false) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "",
                        ),
                    'user_chat_connect' => $chatInfo,
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "No Chat Record Found. Start a Conversation",
                        ),
                    'user_chat_connect' => "",
                    );
            }
            
            return $data; 
        }





        //Method to Get User Chats 
        public function send_buddy_poke($params)
        {
            //Member Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $chatInfo = $model_connect->send_buddy_poke($fillable);

            if ($chatInfo == true) {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "200",
                            'type' => "success",
                            'message' => "Successfully Poked Buddy!",
                        ),
                    'poke_info' => $chatInfo,
                    );

            } else {

                $data = array(
                    'result_info' => 
                        array(
                            'code' => "401",
                            'type' => "error",
                            'message' => "You Poked Earlier. Start a Conversation Instead",
                        ),
                    'poke_info' => $chatInfo,
                    );
            }
            
            return $data; 
        }


        //Method to Fetch User Subscription Plan
        public function user_subscription_plan($params)
        {
            //Member Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $postAct = $model_connect->user_subscription_plan($fillable);
            
 
             if ($postAct != false) {
 
                 $data = array(
                     'result_info' => 
                         array(
                             'code' => "200",
                             'type' => "success",
                             'message' => "Found User Result!",
                         ),
                     'result_message' => $postAct,
                     );
 
             } else {
 
                 $data = array(
                     'result_info' => 
                         array(
                             'code' => "401",
                             'type' => "error",
                             'message' => "No Result Found",
                         ),
                     'result_message' => $postAct,
                     );
             }
             
             return $data; 
        }


        
        //Method to Create Subscription Payment Plan
        public function user_subscription_payment($params)
        {
            //Member Model
            $model_connect = new Members();
            $length = 5;
            $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
            $code = preg_replace('/\s+/', '', substr(str_shuffle(trim($chars)), 0, $length));
            $trancid = preg_replace('/\s+/', '', trim('tranc').trim($code));
             
            //User Account Parameters
            $fillable = array(
                'trancid' => $trancid,
                'uniqueid' => htmlspecialchars($params['uniqueid']),
                'username' => htmlspecialchars($params['username']),
                'planid' => htmlspecialchars($params['planid']),
            );

            //Model Function Call
            $postAct = $model_connect->user_subscription_payment($fillable);
            
 
             if ($postAct == true) {
 
                 $data = array(
                     'result_info' => 
                         array(
                             'code' => "200",
                             'type' => "success",
                             'message' => "Processing... Awaiting Confirmation!",
                         ),
                     'result_message' => $postAct,
                     );
 
             } else {
 
                 $data = array(
                     'result_info' => 
                         array(
                             'code' => "401",
                             'type' => "error",
                             'message' => "Aborted Prematuredly... Try Again",
                         ),
                     'result_message' => "",
                     );
             }
             
             return $data; 
        }


        


        //Method to Fetch All Payment Transactions
        public function user_transactions_info($params)
        {
            //Member Model
            $model_connect = new Members();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $postAct = $model_connect->user_transactions_info($fillable);
            
             if ($postAct != NULL) {
 
                 $data = array(
                     'result_info' => 
                         array(
                             'code' => "200",
                             'type' => "success",
                             'message' => "Processing... Awaiting Confirmation!",
                         ),
                     'result_message' => $postAct,
                     );
 
             } else {
 
                 $data = array(
                     'result_info' => 
                         array(
                             'code' => "401",
                             'type' => "error",
                             'message' => "No Records Found... Create a Payment!",
                         ),
                     'result_message' => "",
                     );
             }
             
             return $data; 
        }


        


















//Method For Create language
public function deactivate_account($params)
{
    //User Model
    $model_connect = new Members();
    $fillable = array_map("htmlspecialchars", $params);
    //Model Function Call
    $result = $model_connect->deactivate_account($fillable);

    if ($result == true) {

        $data = array(
            'result_info' => 
                array(
                    'code' => "200",
                    'type' => "success",
                    'message' => "Successful, Account Has Been Deactivated & Trashed After 180 Days!",
                ),
            );

    } else {

        $data = array(
            'result_info' => 
                array(
                    'code' => "401",
                    'type' => "error",
                    'message' => "Error, Something Came Up.",
                ),
            );
    }

    return $data; 
}









        

    /*

        ******* 

        End oF file 

        ********

    */


    }