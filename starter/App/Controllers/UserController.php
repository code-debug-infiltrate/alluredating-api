<?php 

//Required Files
require_once __DIR__.'/../Models/Members.php';



    class UserController
    {



        //Method For User Dashboard
        public function user_information($params)
        {
            //User Model
            $model_connect = new Members();
            //User Account Parameters
            $fillable = array('uniqueid' => htmlspecialchars($params['uniqueid']), );

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
            //User Account Parameters
            $fillable = array('uniqueid' => htmlspecialchars($params['uniqueid']), );

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
            //User Account Parameters
            $fillable = array('uniqueid' => htmlspecialchars($params['uniqueid']), );

            //Model Function Call
            $actInfo = $model_connect->user_preference($fillable);

            $data = array(
                    'result_info' => array('code' => "200", 'type' => "success", 'message' => "Successful", ),
                    'preference_info' => $actInfo,
                );

            return $data; 
        }




        //Method For User Album
        public function user_album($params)
        {
            //User Model
            $model_connect = new Members();
            //User Account Parameters
            $fillable = array('uniqueid' => htmlspecialchars($params['uniqueid']), );

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
            //User Account Parameters
            $fillable = array('uniqueid' => htmlspecialchars($params['uniqueid']), );

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
            //User Account Parameters
            $fillable = array('uniqueid' => htmlspecialchars($params['uniqueid']), );

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
            //User Account Parameters
            $fillable = array('uniqueid' => htmlspecialchars($params['uniqueid']), );

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
            //User Account Parameters
            $fillable = array(
                'uniqueid' => htmlspecialchars($params['uniqueid']), 
                'username' => htmlspecialchars($params['username']), 
                'interest' => htmlspecialchars($params['interest']), 
            );

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



        //Method For User Activities
        public function update_password($params)
        {
            //User Model
            $model_connect = new Members();
            //User Account Parameters
            $fillable = array(
                'uniqueid' => htmlspecialchars($params['uniqueid']), 
                'username' => htmlspecialchars($params['username']), 
                'oldpass' => htmlspecialchars($params['oldpass']), 
                'newpass' => htmlspecialchars($params['newpass']), 
            );

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


        

        


        

        





















        

    /*

        ******* 

        End oF file 

        ********

    */


    }