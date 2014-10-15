<?php
use Entity\Agent;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create']) && $_POST['create'] == "update"){
    $err = 0;
    if(!isset($_POST['name'])){
        $err += 1;
        echo "fname";
    }else{
        $name = stripslashes($_POST['name']);
    }
    if(!isset($_POST['phone'])){
        $err += 1;
        echo "phone";
    }else{
        $phone = stripslashes($_POST['phone']);
    }
    if(!isset($_POST['idNo'])){
        $err += 1;
        echo "idno";
    }else{
        $idNo = stripslashes($_POST['idNo']);
    }
    if(!isset($_POST['email'])){
        $err += 1;
        echo "dept";
    }else{
        $email = stripslashes($_POST['email']);
    }
    if(!isset($_POST['address'])){
        $err += 1;
        echo "dob";
    }else{
        $address = stripslashes($_POST['address']);
    }
    if($err == 0){
        $agent = new Agent();
        $agent->setId($id);
        $agent->setAgName($name);
        $agent->setAgAddress($address);
        $agent->setAgIdNo($idNo);
        $agent->setAgEmail($email);
        $agent->setAgPhone($phone);
        $msgs = $agent->updteAgent();
    }else{
        $msgs = $err.": Please fill all fields!";
    }
}
?>
<div id="myModal2" class="span12 modal message hide fade">
    <form  action="" method="post">
        <fieldset>
            <legend>Edit Agent</legend>
            <div class="row">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Name</span>
                                <input type="text" id="firstName" value="<?php echo $entity['ag_name'] ?>" name="name" required="">
                            </div>
                        </div>
                    </div>
                <input type="hidden" name="create" value="update">
                <input type="hidden" value="<?php echo $_SESSION['nonce'] ?>" name="nonce">
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on">National ID</span>
                            <input type="text"  value="<?php echo $entity['ag_idno'] ?>" name="idNo" required="">
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on">Address</span>
                            <input type="text"  value="<?php echo $entity['ag_address'] ?>" name="address" required="">
                        </div>
                    </div>
                </div>
            <div class="span6">
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on" for="password">Email</span>
                            <input type="email" value="<?php echo $entity['ag_email'] ?>"  name="email" required="">
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on">Phone</span>
                            <input type="text"  value="<?php echo $entity['ag_phone'] ?>"  name="phone" required="">
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="control-group">
                            <button type="submit" class="btn btn-primary" id="register-submit-btn">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</fieldset>
</form>
</div>