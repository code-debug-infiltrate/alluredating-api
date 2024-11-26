<?php 

//Required Files
require_once __DIR__.'/../Models/Admin.php';



    class AdminController
    {



        //Method To Fetch All Exchange Rates
        public function auto_update_transaction_status()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->auto_update_transaction_status();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }



        //Method To Fetch All Exchange Rates
        public function user_myself_info()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $myInfo = $model_connect->user_myself_info();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'myself_info' => $myInfo,
                );
                
            return $data; 
        }




        //Method To Fetch All Exchange Rates
        public function user_preferences()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->user_preferences();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'preference_info' => $actInfo,
                );

            return $data; 
        }




        //Method to Create Company Information
        public function create_coy_information($params)
        {
             //Admin Model
             $model_connect = new Admin();
             
             $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $postAct = $model_connect->create_coy_information($fillable);

             if ($postAct == true) {
 
                 $data = array(
                     'result_info' => 
                         array(
                             'code' => "200",
                             'type' => "success",
                             'message' => "Company Detail Updated",
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



        //Method to Create Bank Transfer Info
        public function create_bank_information($params)
        {
             //Admin Model
             $model_connect = new Admin();
             $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $postAct = $model_connect->create_bank_information($fillable);

             if ($postAct == true) {
 
                 $data = array(
                     'result_info' => 
                         array(
                             'code' => "200",
                             'type' => "success",
                             'message' => "Bank Transfer Detail Updated",
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



        //Method To Fetch All Exchange Rates
        public function get_bank_info()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->get_bank_info();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }
        
        


        //Method to Create Currency Info
        public function create_currency_information($params)
        {
             //Admin Model
             $model_connect = new Admin();
             
            if ($params['currency'] == "AED") {
                $fillable = array('currency' => "₳", 'name' => "AED", 'uniqueid' => htmlspecialchars($params['uniqueid']), 'username' => htmlspecialchars($params['username']), );
            }
            if ($params['currency'] == "EUR") {
                $fillable = array('currency' => "€", 'name' => "Euro", 'uniqueid' => htmlspecialchars($params['uniqueid']), 'username' => htmlspecialchars($params['username']), );
            }
            if ($params['currency'] == "USD") {
                $fillable = array('currency' => "$", 'name' => "USD", 'uniqueid' => htmlspecialchars($params['uniqueid']), 'username' => htmlspecialchars($params['username']), );
            }
            if ($params['currency'] == "CAD") {
                $fillable = array('currency' => "$", 'name' => "CAD", 'uniqueid' => htmlspecialchars($params['uniqueid']), 'username' => htmlspecialchars($params['username']), );
            }
            if ($params['currency'] == "NGN") {
                $fillable = array('currency' => "#", 'name' => "NGN", 'uniqueid' => htmlspecialchars($params['uniqueid']), 'username' => htmlspecialchars($params['username']),);
            }
            if ($params['currency'] == "YEN") {
                $fillable = array('currency' => "¥", 'name' => "YEN", 'uniqueid' => htmlspecialchars($params['uniqueid']), 'username' => htmlspecialchars($params['username']), );
            }
            if ($params['currency'] == "GBP") {
                $fillable = array('currency' => "£", 'name' => "GBP", 'uniqueid' => htmlspecialchars($params['uniqueid']), 'username' => htmlspecialchars($params['username']), );
            }
            if ($params['currency'] == "EGP") {
                $fillable = array('currency' => "E£", 'name' => "EGP", 'uniqueid' => htmlspecialchars($params['uniqueid']), 'username' => htmlspecialchars($params['username']), );
            }

                //Model Function Call
                $postAct = $model_connect->create_currency_information($fillable);

             if ($postAct == true) {
 
                 $data = array(
                     'result_info' => 
                         array(
                             'code' => "200",
                             'type' => "success",
                             'message' => "App Currency Detail Updated",
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




        //Method To Fetch Currency Rates
        public function get_currency_info()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->get_currency_info();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }
        
        

        //Method to Create Exchange Rate Info
        public function create_exchange_information($params)
        {
             //Admin Model
             $model_connect = new Admin();
             
             $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $postAct = $model_connect->create_exchange_information($fillable);

             if ($postAct == true) {
 
                 $data = array(
                     'result_info' => 
                         array(
                             'code' => "200",
                             'type' => "success",
                             'message' => "Exchange Rate Detail Updated",
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


        //Method To Fetch All Exchange Rates
        public function get_exchange_info()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->get_exchange_info();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }
        


        //Method to Create Subscription Plan Info
        public function create_subscription_plan($params)
        {
             //Admin Model
             $model_connect = new Admin();

             $length = 5;
             $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
             $code = preg_replace('/\s+/', '', substr(str_shuffle(trim($chars)), 0, $length));
             $planid = preg_replace('/\s+/', '', trim('subplan').trim($code));
             
            //Coy Info Parameters
                $fillable = array(
                    'planid' => $planid,
                    'uniqueid' => htmlspecialchars($params['uniqueid']),
                    'username' => htmlspecialchars($params['username']),
                    'type' => htmlspecialchars($params['type']),
                    'amount' => htmlspecialchars($params['amount']),
                    'expiry' => htmlspecialchars($params['expiry']),
                    'details' => htmlspecialchars($params['details']),
                    'details1' => htmlspecialchars($params['details1']),
                    'details2' => htmlspecialchars($params['details2']),
                    'status' => htmlspecialchars($params['status']),
                );
                //Model Function Call
                $postAct = $model_connect->create_subscription_plan($fillable);

             if ($postAct == true) {
 
                 $data = array(
                     'result_info' => 
                         array(
                             'code' => "200",
                             'type' => "success",
                             'message' => "Subscription Plan Detail Updated",
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


        //Method To Fetch All Subscription Plan
        public function get_subscription_plan()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->get_subscription_plan();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }
        
        

        //Method to Create Subscription Priviledge Info
        public function create_subscription_info($params)
        {
             //Admin Model
             $model_connect = new Admin();
             $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $postAct = $model_connect->create_subscription_info($fillable);

             if ($postAct == true) {
 
                 $data = array(
                     'result_info' => 
                         array(
                             'code' => "200",
                             'type' => "success",
                             'message' => "App Priviledge Detail Updated",
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


        //Method To Fetch All Subscription Priviledge
        public function get_subscription_info()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->get_subscription_info();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }
        
        
        //Method to Create Subscription Priviledge Info
        public function create_api_connect($params)
        {
             //Admin Model
             $model_connect = new Admin();
             $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $postAct = $model_connect->create_api_connect($fillable);

             if ($postAct == true) {
 
                 $data = array(
                     'result_info' => 
                         array(
                             'code' => "200",
                             'type' => "success",
                             'message' => "ThirdParty API Added Info Added",
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


        //Method To Fetch All Subscription Priviledge
        public function get_api_connect()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->get_api_connect();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }
        


        //Method To Fetch All Transactions
        public function get_transactions_info($params)
        {
            //User Model
            $model_connect = new Admin();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $actInfo = $model_connect->get_transactions_info($fillable);

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }
        


        //Method to Update Transaction Status Info
        public function update_transaction_status($params)
        {
             //Admin Model
             $model_connect = new Admin();
             $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $postAct = $model_connect->update_transaction_status($fillable);

             if ($postAct == true) {
 
                 $data = array(
                     'result_info' => 
                         array(
                             'code' => "200",
                             'type' => "success",
                             'message' => "Transaction Detail Updated",
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


        //Method To Fetch All Users
        public function get_users_info($params)
        {
            //User Model
            $model_connect = new Admin();
            $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $actInfo = $model_connect->get_users_info($fillable);

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }
        


        //Method For Update Bio Details
        public function update_personal_info($params)
        {
            //User Model
            $model_connect = new Admin();
            $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $result = $model_connect->update_personal_info($fillable);

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



        //Method to Update User STatus Info
        public function update_user_status($params)
        {
             //Admin Model
             $model_connect = new Admin();
             $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $postAct = $model_connect->update_user_status($fillable);

            if ($postAct == true) {
 
                $data = array(
                    'result_info' => 
                         array(
                             'code' => "200",
                             'type' => "success",
                             'message' => "User Status Updated",
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



        //Method to Update Message STatus Info
        public function update_message_status($params)
        {
             //Admin Model
             $model_connect = new Admin();
             $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $postAct = $model_connect->update_message_status($fillable);

            if ($postAct == true) {
 
                $data = array(
                    'result_info' => 
                         array(
                             'code' => "200",
                             'type' => "success",
                             'message' => "Message Status Updated",
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



        //Method To Fetch All Newsletters Info
        public function get_newsletters_info()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->get_newsletters_info();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }
        


        //Method To Fetch All Users
        public function get_messages_info($params)
        {
            //User Model
            $model_connect = new Admin();
            $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $actInfo = $model_connect->get_messages_info($fillable);

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }



        //Method to Update User STatus Info
        public function card_payment_information($params)
        {
             //Admin Model
             $model_connect = new Admin();
             $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $postAct = $model_connect->card_payment_information($fillable);

            if ($postAct == true) {
 
                $data = array(
                    'result_info' => 
                         array(
                             'code' => "200",
                             'type' => "success",
                             'message' => "User Status Updated",
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



        //Method to Get Payment Transactions
        public function all_payment_transactions($params)
        {
             //Admin Model
             $model_connect = new Admin();
             $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $postAct = $model_connect->all_payment_transactions($fillable);

            if ($postAct == true) {
 
                $data = array(
                    'result_info' => 
                         array(
                             'code' => "200",
                             'type' => "success",
                             'message' => "User Status Updated",
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



        //Method To Fetch Recent Visitors
        public function recent_visitors()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->recent_visitors();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }



        //Method To Fetch Recent Activities
        public function recent_activities()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->recent_activities();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }



        //Method to Get Payment Transactions
        public function users_posts($params)
        {
             //Admin Model
             $model_connect = new Admin();
             $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $postAct = $model_connect->users_posts($fillable);

            if ($postAct == true) {
 
                $data = array(
                    'result_info' => 
                         array(
                             'code' => "200",
                             'type' => "success",
                             'message' => "User Post Status Updated",
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


        //Method to Create New Blog Post Info
        public function create_blog_post($params)
        {
            //Admin Model
            $model_connect = new Admin();

            // Generate the UniqueID, Hash and Code
            $length = 5;
            $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
            $code = preg_replace('/\s+/', '', substr(str_shuffle(trim($chars)), 0, $length));
            $postid = preg_replace('/\s+/', '', trim('blog').trim($code));

             $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $postAct = $model_connect->create_blog_post($fillable, $postid);

             if ($postAct == true) {
 
                 $data = array(
                     'result_info' => 
                         array(
                             'code' => "200",
                             'type' => "success",
                             'message' => "Blog Post Created Successfully!",
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
                    'result_message' => $postAct,
                );
             }
             
             return $data; 
        }
        
        //Method to Get All Blog Posts
        public function blog_posts($params)
        {
             //Admin Model
             $model_connect = new Admin();
             $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $postAct = $model_connect->blog_posts($fillable);

            if ($postAct != false) {
 
                $data = array(
                    'result_info' => 
                         array(
                             'code' => "200",
                             'type' => "success",
                             'message' => "Blog Posts Records",
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



        //Method to Get Blog Post Details
        public function blog_post_details($params)
        {
             //Admin Model
             $model_connect = new Admin();
             $fillable = array_map("htmlspecialchars", $params);

            //Model Function Call
            $postAct = $model_connect->blog_post_details($fillable);

            if ($postAct != false) {
 
                $data = array(
                    'result_info' => 
                         array(
                             'code' => "200",
                             'type' => "success",
                             'message' => "Blog Post Details",
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



        //Method to Update Blog Post Info
        public function update_blog_post($params)
        {
            //Admin Model
            $model_connect = new Admin();

             $fillable = array_map("htmlspecialchars", $params);
            //Model Function Call
            $postAct = $model_connect->update_blog_post($fillable);

             if ($postAct == true) {
 
                 $data = array(
                     'result_info' => 
                         array(
                             'code' => "200",
                             'type' => "success",
                             'message' => "Blog Post Updated Successfully!",
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
                    'result_message' => $postAct,
                );
             }
             
             return $data; 
        }
        

















        // Counts Of Entries




        //Method To Fetch New Users Count
        public function count_new_users()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->count_new_users();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }


    
    
        //Method To Fetch All Users Count
        public function count_all_users()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->count_all_users();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }


        
        
        //Method To Fetch All Messages Count
        public function count_new_messages()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->count_new_messages();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }




        //Method To Fetch All Messages Count
        public function count_all_messages()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->count_all_messages();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }


            

        //Method To Fetch All Visitors Count
        public function count_all_visitors()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->count_all_visitors();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }

            


        //Method To Fetch All Activities Count
        public function count_all_activities()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->count_all_activities();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }



        //Method To Fetch All Transactions Count
        public function all_transactions_count()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->all_transactions_count();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }



        //Method To Fetch New Transactions Count
        public function new_transactions_count()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->new_transactions_count();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }


        //Method To Fetch All Transactions Count
        public function paid_transactions_count()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->paid_transactions_count();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }


        //Method To Fetch All Transactions Count
        public function expired_transactions_count()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->expired_transactions_count();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }



        //Method To Fetch User Preferences Count
        public function count_user_preference()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->count_user_preference();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }

        
     
        //Method To Fetch User Myself Count
        public function count_user_myself()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->count_user_myself();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }

        
        
        //Method To Fetch All User Posts Count
        public function all_userposts_count()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->all_userposts_count();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }



        //Method To Fetch New User Posts Count
        public function new_userposts_count()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->new_userposts_count();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }



        //Method To Fetch All User Posts Count
        public function all_blogposts_count()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->all_blogposts_count();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }



        //Method To Fetch New User Posts Count
        public function new_blogposts_count()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->new_blogposts_count();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }





        
     
        

     
        
        





        


        

    /*

        ******* 

        End oF file 

        ********

    */

    }