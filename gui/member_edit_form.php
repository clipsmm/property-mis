<?php
use Entity\Member as Member;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create']) && $_POST['create'] == "update"){
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
	if(empty($_POST['role'])){
		$err +=1;
		$msgs = "Please fill role";
	}else{
		$role = mysql_real_escape_string($_POST['role']);
	}
    if (@$_POST['status'] ==  'on'){
        $act = 1;
    }else{
        $act = 0;
    }
	if ($err>0){
		$_SESSION['error_log']['reg'] = $msgs;
        $msgs = $err.": Please fill all fields!";
	} elseif($err == 0){
		$mem = new Member();
		$mem->id = $id;
		$mem->userFirstName = $fname;
		$mem->userLastName = $lname;
		$mem->userEmail = $email;
        $mem->userUsername = $username;
        $mem->userLevel =$role;
        $mem->userActive = $act;
        $msgs = $mem->updateMember();
	}
} 
 if ($system->hasRole('ADMIN')) { ?>
<form  action="" method="post">
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
    <fieldset>
        <legend>Edit Account</legend>
        <div class="control-group">
            <div class="controls">
                <div class="input-prepend">
                    <span class="add-on">First Name</span>
                    <input type="text" id="firstName" placeholder="First Name" name="firstName" required=""
                    value="<?php echo $entity['user_first_name']?>">
                </div>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <div class="input-prepend">
                    <span class="add-on">Last Name</span>
                        <input type="text" id="lastName" placeholder="Last Name" name="lastName" required=""
                        value="<?php echo $entity['user_last_name']?>">
                </div>
            </div>
        </div>
        <input type="hidden" value="update" name="create">
		<input type="hidden" value="<?php echo $_SESSION['nonce'] ?>" name="nonce">
        <div class="control-group">
            <div class="controls">
                <div class="input-prepend">
                    <span class="add-on column2-label" for="inputEmail">Email</span>
                        <input type="email" id="inputEmail" placeholder="someone@example.com" name="email" required=""
                        value="<?php echo $entity['user_email']?>">
                </div>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <div class="input-prepend">
                    <span class="add-on column2-label" for="username">Username</span>
                        <input type="text" id="username" placeholder="username" name="username" min="6" max="20" required=""
                        value="<?php echo  $entity['user_username']?>">
                </div>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <div class="input-prepend">
                    <span class="add-on column2-label" for="password">Role</span>
                        <input type="text" placeholder="Password" name="role" required=""
                        value="<?php echo $entity['user_role']?>">
                </div>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <div class="input-prepend">
                    <span class="add-on" for="password">Activated?</span>
                    <input type="checkbox"  name="status" class="checkbox"
                           <?php
                           if ($entity['user_active'] == true){ echo 'checked';}
                           ?>


                    >
                </div>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <div class="control-group">
                    <button type="submit" class="btn btn-primary" id="register-submit-btn">Update Account</button>
                </div>
            </div>
        </div>
    </fieldset>
</form>
<?php } ?>