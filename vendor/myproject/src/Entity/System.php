<?php

namespace Entity;

use Entity\Database as DB;
class System {
    /**
     * @var object The database connection
     */
    private $db_connection = null;
    /**
     * @var array Collection of error messages
     */
    public $errors = array();
    /**
     * @var array Collection of success / neutral messages
     */
    public $messages = array();



    public function getDatabaseManager(){
        return new DB();
    }

    public function getUser($var){
        $db = $this->getDatabaseManager();
        $id = $_SESSION['user_id'];
        $entity = $db->getEntityById('member',$id);
            $res = $entity[$var];
        echo $res;

    }

    public function register($username,$firstName,$lastName,$password1,$email){
        $em = $this->getDatabaseManager();
        $role = DEFAULT_ROLE;
        $active = ACTIVE;


        if (!isset($this->errors['reg'])){
            $salt = $this->createSalt();
            $hash = hash('sha256',$password1);
            $password = hash('sha256',$salt.$hash);
            $em->query("
            INSERT INTO member (user_first_name, user_last_name,user_username, user_email,user_role,user_active,user_password,
            user_salt)
            VALUES
            ('$firstName','$lastName','$username','$email','$role','$active','$password','$salt')
            ");

             $res = $em->persist();
            $em->flush();

            return 'account created successfully!';

        }else{
            return $this->errors['reg'];
        }
    }



    function createSalt()
    {
        $text = md5(uniqid(rand(), true));
        return substr($text, 0, 3);
    }
    function verify($password, $hashedPassword) {
        return crypt($password, $hashedPassword) == $hashedPassword;
    }

    public function logout()
    {
        // delete the session of the user
        $_SESSION = array();
        session_destroy();
        $this->redirect('login');

    }


    public function isLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }
        return false;
    }

    public function redirect($url){
         header('Location:'.$url);
    }


    function login($username, $password) {
        $em  = $this->getDatabaseManager();
        $em->query("SELECT *
        FROM member
       WHERE user_username = '$username'
        LIMIT 1");
        // Using prepared statements means that SQL injection is not possible.
        $user = $em->persist();
        if ($user) {
                while($entity = $em->fetch($user)){
                    $salt = $entity['user_salt'];
                    $db_password = $entity['user_password'];
                    $active = $entity['user_active'];
                    $role = $entity['user_role'];
                    $id = $entity['id'];
                }
            $hash = hash('sha256',$password);
            // hash the password with the unique salt.
            $password = hash('sha256', $salt.$hash);
            if (count($user) == 1 && $active == true) {
                    if ($db_password == $password) {
                        $user_browser = $_SERVER['HTTP_USER_AGENT'];
                        $user_id = $id;
                        session_start();
                        session_regenerate_id();
                        $_SESSION['user_id'] = $user_id;
                        $username = $username;
                        $_SESSION['username'] = $username;
                        $_SESSION['user_role'] = $role;
                        $_SESSION['login_string'] = hash('sha256',
                            $password . $user_browser);
                        // Login successful.
                        $this->redirect('index');
                    }

            }else {
                // No user exists.
               # $this->redirect('login?msg=false');
            }
        }else{
            $this->redirect('login',array('level'=>$level,'department'=>$department));
        }
    }

    public function hasRole($role){
        if ($_SESSION['user_role'] == $role){
            return true;
        }

        return false;
    }
} 