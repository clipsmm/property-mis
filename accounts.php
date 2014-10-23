<?php
session_start();
session_regenerate_id();
if (!isset($_SESSION['username']) ){
    header('location: login.php');
}

require $_SERVER['DOCUMENT_ROOT']. "/remis/config.php";
use Entity\Member;
if (!$system->hasRole('ADMIN')) {$system->redirect('index');}
$page = 'users';
require 'gui/head.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create']) && $_POST['create'] == "create"){
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
		$entityname = mysql_real_escape_string($_POST['username']);
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
		$msgs = 'Your form is  invalid';
	} elseif($err == 0 && $_SESSION['nonce'] == $_POST['nonce']){

		$msgs = $system->register($entityname,$fname,$lname,$password1,$email);


	}
}elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete']) && $_POST['delete'] == "delete"){
    if(!isset($_POST['data'])){
        $err +=1;
    }else{
        $data = $_POST['data'];
        $data = join(',',$data);
        $mem= new Member();
        $mem->id = $data;
        $msgs = $mem->deleteMember();
    }
}
$_SESSION['nonce'] = $nonce = md5('salt'.microtime());
?>

    <div class="container">
<?php require 'gui/toolbar.php' ?>
        <div class="row" id="box">
            <div id="alerts-container">
                <?php if(!empty($msgs)){ ?>
                    <div class="alert">
                        <button type="button" class="close" data-dismiss="alert"></button>
                        <strong>Alert!</strong> <?php echo $msgs ?>
                    </div>
                <?php } ?>
            </div>
        <?php include 'gui/user_registration_form.php' ?>
            <div class="span12">

                <p>Acounts</p>

                <div class="row">
                    <div class="span12">
                    <form action=""  method="post" id="frmTable">
                        <input type="hidden" name="delete" value="delete">
                        <input type="hidden" name="nonce" value="<?php echo $_SESSION['nonce'] ?>">
                        <table class="table table-condensed table-hover">
                            <thead>
                            <tr>
                                <th class="span1"></th>
                                <th class="span2">First Name</th>
                                <th class="span2">Last Name</th>
                                <th class="span2">Email</th>
                                <th class="span2">Username</th>
                                <th class="span2">Role</th>
                                <th class="span2">Active</th>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $em = $system->getDatabaseManager();
                            $entities= $em->getRawEntity('member');
                            if (isset($_GET['term']) && !empty($_GET['term'])){
                                $term = $_GET['term'];
                                $entities = $em->searchEntity('member',$term);
                            }

                            if (!$entities || $entities == false){
                                echo '
                                    <tr>
                                    <td colspan="4"><b>No records found</b></td>
                                    </tr>
                                ';
                            }else{
                            while($entity = $em->fetch($entities)){ ?>
                                <tr>
                                    <td class="align-center">
                                        <label class="checkbox">
                                            <input name="data[]" value="<?php echo $entity['id'] ?>" type="checkbox"><span class="metro-checkbox"></span>
                                        </label>
                                    </td>
                                    <td class="span2"><?php echo $entity['user_first_name']?></td>
                                    <td class="span2"><?php echo $entity['user_last_name']?></td>
                                    <td class="span2 align-left"><?php echo $entity['user_email']?></td>
                                    <td class="span2 align-left"><?php echo $entity['user_username']?></td>
                                    <td class="span2 align-left"><?php echo $entity['user_role']?></td>
                                    <td><?php echo $entity['user_active']?></td>
                                     <td class="span2"><a class="btn btn-primary"
                                                             href="edit.php?table=member&id=<?php echo $entity['id'] ?>">
                                                <i class="icon icon-pencil"></i></a> </td>
                                </tr>
                           <?php }
                       }
                            ?>


                            </tbody>
                        </table>
                      </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require 'gui/taskbar.php' ?>


    <?php include 'gui/charms.php' ?>

<?php
include  'gui/footer.php';
