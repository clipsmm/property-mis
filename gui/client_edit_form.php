<?php
use Entity\Client;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create']) && $_POST['create'] == "update"){
    $err = 0;
    if(!isset($_POST['firstName'])){
        $err += 1;
        echo "fname";
    }else{
        $firstName = stripslashes($_POST['firstName']);
    }
    if(!isset($_POST['lastName'])){
        $err += 1;
        echo "lname";
    }else{
        $lastName = stripslashes($_POST['lastName']);
    }
    if(!isset($_POST['gender'])){
        $err += 1;
        echo "gender";
    }else{
        $gender = stripslashes($_POST['gender']);
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
    if(!isset($_POST['town'])){
        $err += 1;
        echo "doh";
    }else{
        $town = stripslashes($_POST['town']);
    }
    if($err == 0){
        $client = new Client();
        $client->setId($id);
        $client->setClientAddress($address);
        $client->setClientFirstName($firstName);
        $client->setClientLastName($lastName);
        $client->setClientGender($gender);
        $client->setClientIdNo($idNo);
        $client->setClientEmail($email);
        $client->setClientTown($town);
        $client->setClientPhone($phone);
        $msgs = $client->updateClient();
    }else{
        $msgs = $err.": Please fill all fields!";
    }
}
?>
<div id="myModal2" class="span12">
    <div id="alerts-container">
        <?php if(!empty($msgs)){ ?>
            <div class="toast toasttext01">
                <button type="button" class="close" data-dismiss="alert"></button>
                <div class="toast-body">
                    <p><?php echo $msgs ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
    <form  action="" method="post">
        <fieldset>
            <legend>Edit Client</legend>
            <div class="row">
                <div class="span6">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">First Name</span>
                                <input type="text" id="firstName" placeholder="First Name" name="firstName" required=""
                                    value="<?php echo $entity['client_first_name'] ?>">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="update" name="create">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Last Name</span>
                                <input type="text" id="lastName" placeholder="Last Name" name="lastName" required=""
                                       value="<?php echo $entity['client_last_name'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on" for="passwordc">Gender</span>
                                <select  name="gender"  required="">
                                    <option selected="selected">Female</option>
                                    <option>Male</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="<?php echo $_SESSION['nonce'] ?>" name="nonce">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">National ID</span>
                                <input type="text"  placeholder="National ID no." name="idNo" required=""
                                       value="<?php echo $entity['client_id_no'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Address</span>
                                <input type="text"  placeholder="e.g P.O BOX 123" name="address" required=""
                                       value="<?php echo $entity['client_address'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on" for="password">Town</span>
                                <input type="text"  placeholder="e.g Langata" name="town" required=""
                                       value="<?php echo $entity['client_town'] ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on" for="password">Email</span>
                                <input type="email"  placeholder="someone@example.com" name="email" required=""
                                       value="<?php echo $entity['client_email'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Phone</span>
                                <input type="text"  placeholder="07XXAAABBB" name="phone" required=""
                                       value="<?php echo $entity['client_phone'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="control-group">
                                <button type="submit" class="btn btn-primary" id="register-submit-btn">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
</div>
