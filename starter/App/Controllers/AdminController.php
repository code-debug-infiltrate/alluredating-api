<?php 

//Required Files
require_once __DIR__.'/../Models/Admin.php';



    class AdminController
    {




        //Method to Create Company Information
        public function create_coy_information($params)
        {
             //Admin Model
             $model_connect = new Admin();
             
            //Coy Info Parameters
                $fillable = array(
                    'uniqueid' => htmlspecialchars($params['uniqueid']),
                    'username' => htmlspecialchars($params['username']),
                    'coyname' => htmlspecialchars($params['coyname']),
                    'slogan' => htmlspecialchars($params['slogan']),
                    'email' => htmlspecialchars($params['email']),
                    'email1' => htmlspecialchars($params['email1']),
                    'phone' => htmlspecialchars($params['phone']),
                    'phone1' => htmlspecialchars($params['phone1']),
                    'channel' => htmlspecialchars($params['channel']),
                    'instagram' => htmlspecialchars($params['instagram']),
                    'facebook' => htmlspecialchars($params['facebook']),
                    'linkedin' => htmlspecialchars($params['linkedin']),
                    'twitter' => htmlspecialchars($params['twitter']),
                    'status' => htmlspecialchars($params['status']),
                    'address' => htmlspecialchars($params['address']),
                );
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
             
            //Coy Info Parameters
                $fillable = array(
                    'uniqueid' => htmlspecialchars($params['uniqueid']),
                    'username' => htmlspecialchars($params['username']),
                    'bankname' => htmlspecialchars($params['bankname']),
                    'swiftcode' => htmlspecialchars($params['swiftcode']),
                    'acctname' => htmlspecialchars($params['acctname']),
                    'acctnum' => htmlspecialchars($params['acctnum']),
                    'status' => htmlspecialchars($params['status']),
                );
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
             
            //Coy Info Parameters
                $fillable = array(
                    'uniqueid' => htmlspecialchars($params['uniqueid']),
                    'username' => htmlspecialchars($params['username']),
                    'currency' => htmlspecialchars($params['currency']),
                    'rate' => htmlspecialchars($params['rate']),
                    'status' => htmlspecialchars($params['status']),
                );
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
             
            //Coy Info Parameters
                $fillable = array(
                    'uniqueid' => htmlspecialchars($params['uniqueid']),
                    'username' => htmlspecialchars($params['username']),
                    'status' => htmlspecialchars($params['status']),
                );
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
             
            //Coy Info Parameters
                $fillable = array(
                    'uniqueid' => htmlspecialchars($params['uniqueid']),
                    'username' => htmlspecialchars($params['username']),
                    'name' => htmlspecialchars($params['name']),
                    'url' => htmlspecialchars($params['url']),
                    'code' => htmlspecialchars($params['code']),
                    'wallet' => htmlspecialchars($params['wallet']),
                    'private' => htmlspecialchars($params['private']),
                    'public' => htmlspecialchars($params['public']),
                    'status' => htmlspecialchars($params['status']),
                );
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
        public function get_transactions_info()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->get_transactions_info();

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
             
            //Coy Info Parameters
                $fillable = array(
                    'uniqueid' => htmlspecialchars($params['uniqueid']),
                    'username' => htmlspecialchars($params['username']),
                    'trancid' => htmlspecialchars($params['trancid']),
                    'status' => htmlspecialchars($params['status']),
                );
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

            $fillable = array('profile' => htmlspecialchars($params['profile']), );

            //Model Function Call
            $actInfo = $model_connect->get_users_info($fillable);

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'result_message' => $actInfo,
                );

            return $data; 
        }
        


        //Method to Update User STatus Info
        public function update_user_status($params)
        {
             //Admin Model
             $model_connect = new Admin();
             
            //Coy Info Parameters
            $fillable = array(
                'uniqueid' => htmlspecialchars($params['uniqueid']),
                'username' => htmlspecialchars($params['username']),
                'uUniqueid' => htmlspecialchars($params['uUniqueid']),
                'status' => htmlspecialchars($params['status']),
            );
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
        



        //Method to Update User STatus Info
        public function card_payment_information($params)
        {
             //Admin Model
             $model_connect = new Admin();
             
            //Coy Info Parameters
            $fillable = array(
                'name' => htmlspecialchars($params['name']),
            );
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


        
     
        
        





        


        

    /*

        ******* 

        End oF file 

        ********

    */

    }