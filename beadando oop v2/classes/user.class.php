<?php
Class User {
    private $_db;
    private $_data;
    private $_sessionName;
    private $_isLoggedIn;
    private $_cookieName;

    public function __construct($userId = null)
    {
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get('session/session_name');
        $this->_cookieName = Config::get('remember/cookie_name');
        //By default we pick the current users details if it is logged in.
        //Else we pick the details of the user with the provided id.
        if(!$userId)// if $user is null.
        {
            if(Session::exists($this->_sessionName)) // check if user is logged in.
            {
                $userId = Session::get($this->_sessionName); // Gets the logged in user's id.
                if($this->find($userId)) //finds logged in user database then puts its data into $_data so you can use it.
                {
                    $this->_isLoggedIn = true; //if we have set the _sessionName session and we found the user in the database it is logged in.
                }
            }
        }
        else //$user is not null.
        {
            $this->find($userId);
        }
    }

    public function create($fields = array())
    {
        define('REGISTRATION_TABLE','users');
        if(!$this->_db->insert(REGISTRATION_TABLE,$fields))
        {
            throw new Exception('There was a problem creating an account');
        }
        return true;
    }

    public function find($user = null) // Gets either username or id. Finds user based on id or username then puts its data into $_data. Return true if user found.
    {
        if($user)
        {
            $field = ( is_numeric($user)) ? 'id' : 'username';
            $data = $this->_db->get('users',array($field,'=',$user));

            if($data->count())
            {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }

    public function login($username = null,$password = null,$remember = false) // Verifies password and logs in user(Sets session with the id). Returns true or false.
    {
        
        if(!$username && !$password && $this->exists()) //checking if user already exists(users data already in the obj)
        {
            Session::put($this->_sessionName,$this->data()->id);
        }
        else
        {

            $user_found = $this->find($username);

            if($user_found)
            {
                if(password_verify($password,$this->_data->password))
                {
                    Session::put($this->_sessionName,$this->_data->id);
                    // creating cookie and inserting into the db (also checking if it exists in the db cous it shouldn't if we logged out.)
                    if($remember)
                    {
                        //(also checking if it exists in the db cous it shouldn't if we logged out.)
                        $hashCheck = $this->_db->get('users_session',array('user_id','=',$this->data()->id));

                        if(!$hashCheck->count())
                        {
                            $hash = hash("md5",uniqid());
                            $this->_db->insert('users_session',array('user_id'=>$this->data()->id,'hash'=>$hash));
                        }
                        else
                        {
                            $hash = $hashCheck->first()->hash;
                        }
                        Cookie::put($this->_cookieName,$hash,Config::get('remember/cookie_expiry'));
                    }
                    return true;
                }
            }
        }    
        return false;
    }

    public function update($fields = array(),$id = null) // futer functionality if you are an admin you can update a user by its id.
    {
        if(!$id && $this->isLoggedIn())
        {
            $id = $this->data()->id;
        }

        if(!$this->_db->update('users',$fields,array("id","=",$id)))
        {
            throw new Exception("There's been an error!");
            
        }
    }

    public function logout()
    {
        $this->_db->delete('users_session',array('user_id','=',$this->data()->id));
        Session::delete($this->_sessionName);
        Cookie::delete($this->_cookieName);
    }
    public function data()
    {
        return $this->_data;
    }
    public function isLoggedIn()
    {
        return $this->_isLoggedIn;
    }
    
    public function exists()
    {
        return (!empty($this->_data)) ? true : false; 
    }

}