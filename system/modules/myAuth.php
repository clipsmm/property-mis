<?php
/**
 * Created by PhpStorm.
 * User: Meshaq
 * Date: 3/10/14
 * Time: 2:54 PM
 */
if ($_SERVER['REQUEST_METHOD'] == "REQUEST"){

}
function register(){
    if(empty($_POST['firstname'])){

    }else{
        $fname = mysql_real_escape_string($_POST['firstname']);
    }
    if(empty($_POST['lastname'])){
        $lname = mysql_real_escape_string($_POST['lastname']);
    }else{

    }
    if(empty($_POST['username'])){

    }else{
        $username = mysql_real_escape_string($_POST['username']);
    }
    if(empty($_POST['phone'])){

    }else{
        $phone = mysql_real_escape_string($_POST['phone']);
    }
    if(empty($_POST['email'])){

    }else{
        $email = mysql_real_escape_string($_POST['email']);
    }



}