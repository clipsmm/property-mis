<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 8/26/14
 * Time: 9:07 PM
 */

namespace Entity;


class Member extends System{
    /**
     * @var integer
     */
    public $id;

    public $userFirstName;
    public $userLastName;
    public $userEmail;
    public $userPassword;
    public $userActive;
    public $userUsername;
    public $userLevel;



    public function __constructor(){
        echo "User loaded";
    }
    
    
    public function updateMember(){
    	$em = $this->getDatabaseManager();
    	$em->query("
    	UPDATE member SET
    	user_first_name = '$this->userFirstName', user_last_name = '$this->userLastName', user_email = '$this->userEmail',
    	user_username = '$this->userUsername', user_role ='$this->userLevel', user_active = '$this->userActive'
        WHERE id='$this->id'
    	");
    	
    	if($result = $em->persist()){
    		$em->flush();
    	
    		return "Record successfully updated!";
    	};
    	return "Error occured. Try again";
    }
    
    public function deleteMember(){
    	$em = $this->getDatabaseManager();
    	$em->query("
    			DELETE
    			FROM member
    			WHERE id IN ('$this->id')
    			");
    	if($result = $em->persist()){
    		$em->flush();
    
    		return "Record successfully deleted!";
    	};
    	return "Error occured. Try again";
    }
    

} 