<?php
session_start();
session_regenerate_id();
if (!isset($_SESSION['username'])){
    header('location: login.php');
}

require $_SERVER['DOCUMENT_ROOT']. "/remis/config.php";
$page = 'staff';
use Entity\Staff as Staff;
require 'gui/head.php';
$em = $system->getDatabaseManager();
$departments = $em->getRawEntity('department');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create']) && $_POST['create'] == "create"){
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
    if(!isset($_POST['department'])){
        $err += 1;
        echo "dept";
    }else{
        $dept = stripslashes($_POST['department']);
    }
    if(!isset($_POST['dob'])){
        $err += 1;
        echo "dob";
    }else{
        $dob = stripslashes($_POST['dob']);
    }
    if(!isset($_POST['doh'])){
        $err += 1;
        echo "doh";
    }else{
        $doh = stripslashes($_POST['doh']);
    }
    if($err == 0 && $_SESSION['nonce'] == $_POST['nonce']){
        $staff = new Staff();
        $staff->setStaffDeptId($dept);
        $staff->setStaffDob($dob);
        $staff->setStaffDoh($doh);
        $staff->setStaffFirstName($firstName);
        $staff->setStaffLastName($lastName);
        $staff->setStaffIdNo($idNo);
        $staff->setStaffGender($gender);
        $staff->setStaffPhone($phone);

        $msgs = $staff->createStaff();
    }else{
        $msgs = $err.": Please fill all fields!";
    }
}
$_SESSION['nonce'] = $nonce = md5('salt'.microtime());
?>

    <div class="container">
        <?php require 'gui/toolbar.php' ?>
        <div id="alerts-container">
            <?php if(!empty($msgs)){ ?>
                <div class="alert">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    <strong>Alert!</strong> <?php echo $msgs ?>
                </div>
            <?php } ?>
        </div>
        <div class="row" id="box">
            <?php include 'gui/staff_new_form.php' ?>

            <div class="span12">

                
                <div class="row">
                    <div class="span12">

                        <table class="table table-condensed table-hover">
                            <thead>
                            <tr>
                                <th class="span1"></th>
                                <th class="span2">First Name</th>
                                <th class="span2">Last Name</th>
                                <th class="span2">Gender</th>
                                <th class="span2">Date of Birth</th>
                                <th class="span2">Date of Hire</th>
                                <th class="span2">ID No</th>
                                <th class="span2">Phone</th>
                                <th class="span2">Department</th>
                                <th class="span2"></th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $em = $system->getDatabaseManager();
                            $entities = $em->getRawEntity('staff');
                            if (isset($_GET['term']) && !empty($_GET['term'])){
                                $term = $_GET['term'];
                                $entities = $em->searchEntity($page,$term);
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
                                            <input type="checkbox"><span class="metro-checkbox"></span>
                                        </label>
                                    </td>
                                    <td class="span2"><?php echo $entity['staff_first_name']?></td>
                                    <td class="span2"><?php echo $entity['staff_last_name']?></td>
                                    <td class="span2"><?php echo $entity['staff_gender']?></td>
                                    <td class="span2"><?php echo $entity['staff_dob']?></td>
                                    <td class="span2"><?php echo $entity['staff_doh']?></td>
                                    <td class="span2"><?php echo $entity['staff_id_no']?></td>
                                    <td class="span2"><?php echo $entity['staff_phone']?></td>
                                    <td class="span2"><?php echo $em->getEntityDetail('department',$entity['staff_dept_id'],'dept_code')?></td>
                                    <td class="span2"><a class="btn btn-primary"
                                                         href="edit.php?table=staff&id=<?php echo $entity['id'] ?>">
                                            <i class="icon icon-pencil"></i></a> </td>
                                </tr>
                            <?php }
                            }
                            ?>


                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require 'gui/taskbar.php' ?>


<?php include 'gui/charms.php' ?>

<?php
include  'gui/footer.php';
