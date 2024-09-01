<?php 

//Required Files
require_once __DIR__.'/../Models/Members.php';



    class MemberDashboard
    {



        //Method For User Dashboard
        public function user_dashboard($params)
        {
            //User Model
            $model_connect = new Members();
            //User Account Parameters
            $fillable = array('uniqueid' => htmlspecialchars($params['uniqueid']), 'email' => htmlspecialchars($params['email']), );

            //Model Function Call
            $userInfo = $model_connect->user_info($fillable);

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful, User Is Active", ),
                    'user_info' => $userInfo,
                );

            return $data; 
        }




        





















        

    /*

        ******* 

        End oF file 

        ********

    */


    }