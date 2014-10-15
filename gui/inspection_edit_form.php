<?php
use Entity\Inspection;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create']) && $_POST['create'] == "update"){
    $err = 0;
    if(!isset($_POST['property'])){
        $err += 1;
        echo "Empyt property";
    }else{
        $property= stripslashes($_POST['property']);
    }
    if(!isset($_POST['staff'])){
        $err += 1;
        echo "Category ";
    }else{
        $staff = stripslashes($_POST['staff']);
    }
    if(!isset($_POST['issue'])){
        $err += 1;
        echo "issue";
    }else{
        $report = stripslashes($_POST['issue']);
    }
    if(!isset($_POST['date'])){
        $err += 1;
        echo "issue";
    }else{
        $date = stripslashes($_POST['date']);
    }
    if(!isset($_POST['status'])){
        $err += 1;
        echo "issue";
    }else{
        $status = stripslashes($_POST['status']);
    }

    if($err == 0){
        $ins = new Inspection();
        $ins->setId($id);
        $ins->setPropId($property);
        $ins->setStaffId($staff);
        $ins->setInsDate($date);
        $ins->setInsDescription($report);
        $ins->setInsStatus($status);

        $msgs = $ins->updateInspection();
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
            <legend>Edit Inspection</legend>
            <div class="row">
                <div class="span6">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Property</span>
                                <select name="property" required="">
                                    <?php
                                    while ($prt = $em->fetch($props)){ ?>
                                        <option value="<?php echo $prt['id'] ?>"
                                            <?php
                                            if($prt['id'] == $entity['prop_id'])echo 'selected="selected"'
                                            ?>
                                            ><?php echo $prt['prop_name']?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="update" name="create">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Staff</span>
                                <select name="staff" required="">
                                    <?php
                                    while ($en = $em->fetch($staffs)){ ?>
                                        <option <?php
                                        if($en['id'] == $entity['staff_id'])echo 'selected="selected"';
                                        echo 'value="'.$en['id'].'"'
                                        ?>><?php echo $en['staff_last_name']."".$en['staff_first_name'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="<?php echo $_SESSION['nonce'] ?>" name="nonce">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Issue</span>
                                <textarea class="textarea" name="issue" required=""
                                "><?php echo $entity['report'] ?> </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on">Date</span>
                            <input type="text" id="dp3" data-date-format="yyyy/mm/dd" name="date"
                                   class="datepicker" data-provide="datepicker"
                                   value="<?php echo $entity['ins_date'] ?>">
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on">Status</span>
                            <select type="text" name="status"" required="">
                                <option <?php
                                if($entity['ins_status'] == 'New')echo 'selected="selected"'?>>
                                    New</option>
                                <option <?php
                                if($entity['inst_status'] == 'Viewed')echo 'selected="selected"'?>>
                                    Viewed</option>
                            </select>
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