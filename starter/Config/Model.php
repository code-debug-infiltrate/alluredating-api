<?php
namespace Config;
require 'vendor/autoload.php';

use PDO;
use Config\Db;

abstract class Model 

{ 
  
//Database dbconnection
    private $dbcon;


//Function to dbconstruct pdo interface for dbconnection
    public function __construct()
    {
        //open database dbconnection
        $database = new Db();
        $dbcon = $database->db_Connect();
        $this->dbcon = $dbcon;
    }



//Insert Entries Into Database
    public function insert($data, $query)
    {
       try {
            $stmt = $this->dbcon->prepare($query);
            foreach ($data as $key => &$val) {
                $stmt->bindParam($key, $val, PDO::PARAM_STR);
            }
            $o = $stmt->execute($data);
            return $o;
       } catch (Exception $e) {
           return $e;         
       }
       $db_close();
    }



//Check Database Entries If Data Exists
    public function checker($data, $query)
    {
        try {
            $stmt = $this->dbcon->prepare($query);
            foreach ($data as $key => &$val) {
                $stmt->bindParam($key, $val, PDO::PARAM_STR);
            }
            $stmt->execute($data);
            $o = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($o) {
                return $o;
            }else{
                return false;
            }
        } catch (Exception $e) {
            return $e;    
        }
        $db_close();
    }



//Get details of specific row
    public function fetch_row($data, $query)
    {   
        try {
            $stmt = $this->dbcon->prepare($query);
            foreach ($data as $key => &$val) {
                $stmt->bindParam($key, $val, PDO::PARAM_STR);
            }
            $stmt->execute($data);
            $info = $stmt->fetch(PDO::FETCH_ASSOC);
        
            return $info; 

           } catch (Exception $e) {
            
            return $e;  
        }  
        $db_close(); 
    }



//Get details of all entries
    public function fetch_all($query)
    {   
        try {
            $stmt = $this->dbcon->prepare($query);
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($row as $value) {
                return $row;
            } 
            $stmt->execute(); 
        } catch (Exception $e) {
            return $e;  
        }  
        
    }



//Get all entries of specific entries
    public function fetch_spec($data, $query)
    {   
        try {
            $stmt = $this->dbcon->prepare($query);
            foreach ($data as $key => &$val) {
                $stmt->bindParam($key, $val, PDO::PARAM_STR);
            }
            $stmt->execute($data);
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($row as $value) {

                return $row;
            }
        } catch (Exception $e) {
             return $e;       
        }    
        
    }



//Get total sum of all entries
    public function cal_sum($query)
    {
        try {
            $stmt = $this->dbcon->prepare($query);
            $stmt->execute();
            $o = $stmt->fetch(PDO::FETCH_NUM);
            return $o;
        } catch (Exception $e) {
           return $e;                         
        }
        $db_close();
    }



//Get total sum of specific entries
    public function total_sum($data, $query)
    {
        try {
            $stmt = $this->dbcon->prepare($query);
            foreach ($data as $key => &$val) {
                $stmt->bindParam($key, $val, PDO::PARAM_STR);
            }
            $stmt->execute($data);
            $o = $stmt->fetch(PDO::FETCH_NUM);
            return $o;
        } catch (Exception $e) {
            return $e;
        }
        $db_close();
    }


//Update Entries In Database
    public function update($data, $query)
    {
        try {
            $stmt = $this->dbcon->prepare($query);
            foreach ($data as $key => &$val) {
               $stmt->bindParam($key, $val, PDO::PARAM_STR);
            }
            $stmt->execute($data);
            return $data;
        } catch (Exception $e) {
           return $e; 
        }
        $db_close();
    }
    
    

//Count All Entries
    public function counter($query)
    {
        try {
            $stmt = $this->dbcon->prepare($query);
            $stmt->execute();
            $counted = $stmt->fetchColumn();
            return $counted;
        } catch (Exception $e) {
            return $e;   
        }
        $db_close();
    }



//Count Specific Entries
    public function counter_spec($data, $query)
    {
        try {
            $stmt = $this->dbcon->prepare($query);
            foreach ($data as $key => &$val) {
                $stmt->bindParam($key, $val, PDO::PARAM_STR);
            }
            $stmt->execute($data);
            $counted = $stmt->fetchColumn();
            return $counted;
        } catch (Exception $e) {
            return $e;
        }
        $db_close();
    }



//Delete Entry
    public function delete($data, $query)
    {
        try {
            $stmt = $this->dbcon->prepare($query);
            foreach ($data as $key => &$val) {
                $stmt->bindParam($key, $val, PDO::PARAM_STR);
            }
            $stmt->execute($data);
            //$o = $stmt->fetch(PDO::FETCH_ASSOC);
            return true;
        } catch (Exception $e) {
            return $e;
        }
        $db_close();
    }



//Logout User
    public function logout($data, $query)
    {   
        try {
            $stmt = $this->dbcon->prepare($query);
            foreach ($data as $key => &$val) {
               $stmt->bindParam($key, $val, PDO::PARAM_STR);
            }
            $stmt->execute($data);
            return null;
        } catch (Exception $e) {
            return $e;
        }
        $db_close();
    }








//Perform Some Other Actions
    public function others($query)
    {
        try {
            $stmt = $this->dbcon->prepare($query);
            $stmt->execute();
            //$o = $stmt->fetch(PDO::FETCH_NUM);
            return true;
        } catch (Exception $e) {
           return $e;                         
        }
        $db_close();
    }




    /**
     * End Of File
     */
}