<?php
require $_SERVER['DOCUMENT_ROOT']. "/remis/config.php";
require 'gui/head.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create']) && $_POST['create'] == true){
    $err = 0;
    $msgs = array();
    if(empty($_POST['firstName'])){
        $err +=1;
        $msgs = "Enter First Name";
    }else{
        $fname = mysql_real_escape_string($_POST['firstName']);
    }
    if(empty($_POST['lastName'])){
        $err +=1;
        $msgs = "Enter Last Name";
    }else{
        $lname = mysql_real_escape_string($_POST['lastName']);
    }
    if(empty($_POST['username'])){
        $err +=1;
        $msgs = "Enter Username";
    }else{
        $username = mysql_real_escape_string($_POST['username']);
    }
    if(empty($_POST['email'])){
        $err +=1;
        $msgs = "Enter Email address";
    }else{
        $email = mysql_real_escape_string($_POST['email']);
    }
    if(empty($_POST['password1'])){
        $err +=1;
        $msgs = "Enter your password";
    }else{
        $password1 = mysql_real_escape_string($_POST['password1']);
    }
    if(empty($_POST['password2'])){
        $err +=1;
        $msgs = "Please Confirm password";
    }else{
        $password2 = mysql_real_escape_string($_POST['password2']);
    }
    if ($password1 != $password2){
        $err +=1;
        $msgs = "Passwords do not match";
    }
    if ($err>0){
        $_SESSION['error_log']['reg'] = $msgs;
        $system->redirect('register?err=1');
    } else {

        $system->register($username,$fname,$lname,$password1,$email);


    }







}
?>

<body>
<div id="wrap">
    <?php if(!empty($_GET['err']) && $_GET['err'] == 1){ ?>
        <div class="alert alert-block">
            <button type="button" class="close" data-dismiss="alert"></button>
            <h4>Warning!</h4>
            <?php
            print_r($_SESSION['error_log']['reg']);
            /*
                foreach($msgs as $msg){
                    echo $msg;
                } */
            ?>
        </div>
    <?php } ?>

    <?php
    form_reg();
    ?>
</div>


<?php
include 'gui/footer.php';