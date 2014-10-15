<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 8/26/14
 * Time: 9:07 PM
 */

namespace Entity;


class Member {
    /**
     * @var integer
     */
    protected $id;

    protected $userFirstName;
    protected $userLastName;
    protected $userEmail;
    protected $userPassword;
    protected $userActive;
    protected $userUsername;
    protected $userLevel;



    public function __constructor(){
        echo "User loaded";
    }

} 