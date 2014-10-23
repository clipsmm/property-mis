<?php
session_start();
session_regenerate_id();
require $_SERVER['DOCUMENT_ROOT']. "/remis/config.php";
require 'gui/head.php';
if (($_SERVER['REQUEST_METHOD'] == 'POST')){
    $err = 0;
    if(empty($_POST['username'])){
        $err +=1;
    }else{
        $username = mysql_real_escape_string($_POST['username']);
    }

    if(empty($_POST['password'])){
        $err +=1;
    }else{
        $password = mysql_real_escape_string($_POST['password']);
    }


        if($err>0){
            echo '
                <div class="alert">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    <strong>Failed!</strong> Authentication Error
                </div>
            ';
        }else{
            $system->login($username,$password);
        }
    }

    ?>
<div id="wrap" >
    <div class="container">
            <?php
                form_login();
            ?>
    </div>

</div>
<?php
include 'gui/footer.php';