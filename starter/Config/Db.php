<?php

namespace Config\Db;

require 'vendor/autoload.php';


/**
 * 	API For Oriented Dating Application
 * 	July 2022
 *  Class for database connection
* --------------------------------------------------------------------
     * Database Connection 
* ---------------------------------------------------------------------
*/
class Db
{
//Define connection variables
    private $server = "mysql:host=localhost;dbname=orienteddating";
    private $user = "root";
    private $pass = "";
    private $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    public $con;
    
     /* Function for opening connection */
    public function db_Connect()
    {
        try {
            $this->con = new PDO($this->server, $this->user, $this->pass, $this->options);
            return $this->con;
        } catch (PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }
    }

    /* Function for closing connection */
    public function db_close()
    {
        $this->con = null;
    }


}
