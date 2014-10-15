<?php
use Entity\Staff;
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
    if($err == 0){
        $staff = new Staff();
        $staff->setId($id);
        $staff->setStaffDeptId($dept);
        $staff->setStaffDob($dob);
        $staff->setStaffDoh($doh);
        $staff->setStaffFirstName($firstName);
        $staff->setStaffLastName($lastName);
        $staff->setStaffIdNo($idNo);
        $staff->setStaffGender($gender);
        $staff->setStaffPhone($phone);

        $msgs = $staff->updateStaff();
    }else{
        $msgs = $err.": Please fill all fields!";
    }
}
?>
<div id="myModal2" class="span12">
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
            <legend>Add New Staff</legend>
            <div class="row">
                <div class="span6">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">First Name</span>
                                <input type="text" id="firstName" placeholder="First Name" name="firstName" required=""
                                       value="<?php echo $entity['staff_first_name'] ?>">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="update" name="create">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Last Name</span>
                                <input type="text" id="lastName" placeholder="Last Name" name="lastName" required=""
                                       value="<?php echo $entity['staff_last_name'] ?>">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="<?php echo $_SESSION['nonce'] ?>" name="nonce">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">National ID</span>
                                <input type="text"  placeholder="National ID no." name="idNo" required=""
                                       value="<?php echo $entity['staff_id_no'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Date of Birth</span>
                                <input type="text" id="dp3" data-date-format="yyyy/mm/dd" name="dob"
                                       class="span2 datepicker" data-provide="datepicker"
                                       value="<?php echo $entity['staff_dob'] ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on" for="password">Date Hired</span>
                                <input type="text" id="dp2" data-date-format="yyyy/mm/dd" name="doh"
                                       class="span2 datepicker" data-provide="datepicker"
                                       value="<?php echo $entity['staff_doh'] ?>">
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
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on" for="passwordc">Department</span>
                                <select  name="department"  required="">
                                    <?php
                                    while($department = $em->fetch($departments)){
                                        echo '<option value="'.$department['id'].'">'.$department['dept_name'].'</option>';
                                    }?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Phone</span>
                                <input type="text"  placeholder="07XXAAABBB" name="phone" required=""
                                       value="<?php echo $entity['staff_phone'] ?>">
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