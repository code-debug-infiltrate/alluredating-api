<?php



class User

{
    
    //Define variables
    private $uniqueid;
    private $fname;
    private $lname;
    private $username;
    private $email;
    private $password;
    private $gender;
    private $dob;
    private $isLoggedIn = false;


    //
    public $fillable = array();
    

    //Construct User
    public function __construct($fillable)
    {
        $this->uniqueid = $fillable['uniqueid'];
        $this->fname = $fillable['fname'];
        $this->lname = $fillable['lname'];
        $this->username = $fillable['username'];
        $this->email = $fillable['email'];
        $this->password = $fillable['password'];
        $this->gender = $fillable['gender'];
        $this->dob = $fillable['dob'];
    }




    //Deconstruct User
    public function __destruct()
    {
       $this->fillable = null; 
    }



    //Set User
    public function set_user($uniqueid) 
    {
        $this->uniqueid = $uniqueid;

        return $uniqueid;
    }


    //Get User
    public function get_user($uniqueid) 
    {
        $this->uniqueid = $uniqueid;

        $user = array(
            'uniqueid' => $this->uniqueid,
            'uniqueid' => $this->fname,
            'lname' => $this->lname,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'gender' => $this->gender,
            'dob' => $this->dob,
        );

        return $user;
    }



    //above 18 years
    public function is_above_18($dob)
    {
        if(time() < strtotime('+18 years', strtotime($dob))){
            return false;
        }
    }




    //Authenticate User
    public function authenticate_user($fillable)
    {
        $_SESSION['userInfo'] = array();
        $result = false;


    }



    //LoggedIn
    public function is_logged_in()
    {
        if (isset($_SESSION['userInfo']) && !empty($_SESSION['userInfo'])) {
            $this->uniqueid = $_SESSION['userInfo']['uniqueid'];
            $this->username = $_SESSION['userInfo']['username'];
            $this->isLoggedIn = true;
        }
        
        return $this->isLoggedIn;
    }










    /**
     * End Of File
     */
}
