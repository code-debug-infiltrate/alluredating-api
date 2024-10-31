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

            //  $length = 5;
            //  $chars = getenv('COMBINATION');
            //  $code = preg_replace('/\s+/', '', substr(str_shuffle(trim($chars)), 0, $length));
            //  $commentid = preg_replace('/\s+/', '', trim('pcmt').trim($code));
             
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

            //  $length = 5;
            //  $chars = getenv('COMBINATION');
            //  $code = preg_replace('/\s+/', '', substr(str_shuffle(trim($chars)), 0, $length));
            //  $commentid = preg_replace('/\s+/', '', trim('pcmt').trim($code));
             
            //Coy Info Parameters
                $fillable = array(
                    'uniqueid' => htmlspecialchars($params['uniqueid']),
                    'username' => htmlspecialchars($params['username']),
                    'bankname' => htmlspecialchars($params['bankname']),
                    'swiftcode' => htmlspecialchars($params['swiftcode']),
                    'acctname' => htmlspecialchars($params['acctname']),
                    'acctnum' => htmlspecialchars($params['acctnum']),
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
                    'user_profiles' => $actInfo,
                );

            return $data; 
        }
        
        


        //Method to Create Currency Info
        public function create_currency_information($params)
        {
             //Admin Model
             $model_connect = new Admin();

            //  $length = 5;
            //  $chars = getenv('COMBINATION');
            //  $code = preg_replace('/\s+/', '', substr(str_shuffle(trim($chars)), 0, $length));
            //  $commentid = preg_replace('/\s+/', '', trim('pcmt').trim($code));
             
            //Coy Info Parameters
                $fillable = array(
                    'uniqueid' => htmlspecialchars($params['uniqueid']),
                    'username' => htmlspecialchars($params['username']),
                    'name' => htmlspecialchars($params['name']),
                    'currency' => htmlspecialchars($params['currency']),
                );
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
                    'user_profiles' => $actInfo,
                );

            return $data; 
        }
        
        



        //Method to Create Exchange Rate Info
        public function create_exchange_information($params)
        {
             //Admin Model
             $model_connect = new Admin();

            //  $length = 5;
            //  $chars = getenv('COMBINATION');
            //  $code = preg_replace('/\s+/', '', substr(str_shuffle(trim($chars)), 0, $length));
            //  $commentid = preg_replace('/\s+/', '', trim('pcmt').trim($code));
             
            //Coy Info Parameters
                $fillable = array(
                    'uniqueid' => htmlspecialchars($params['uniqueid']),
                    'username' => htmlspecialchars($params['username']),
                    'currency' => htmlspecialchars($params['currency']),
                    'rate' => htmlspecialchars($params['rate']),
                );
                //Model Function Call
                $postAct = $model_connect->create_exchange_information($fillable);

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
        public function get_exchange_info()
        {
            //User Model
            $model_connect = new Admin();

            //Model Function Call
            $actInfo = $model_connect->get_exchange_info();

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'user_profiles' => $actInfo,
                );

            return $data; 
        }
        
        
        





        


        

    /*

        ******* 

        End oF file 

        ********

    */

    }