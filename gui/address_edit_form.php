<?php
use Entity\Address;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create']) && $_POST['create'] == "update"){
    $err = 0;
    if(!isset($_POST['building'])){
        $err += 1;
        echo "Fill client";
    }else{
        $building = stripslashes($_POST['building']);
    }
    if(!isset($_POST['street'])){
        $err += 1;
        echo "Category ";
    }else{
        $street = stripslashes($_POST['street']);
    }
    if(!isset($_POST['area'])){
        $err += 1;
        echo "title";
    }else{
        $area = stripslashes($_POST['area']);
    }
    if(!isset($_POST['town'])){
        $err += 1;
        echo "issue";
    }else{
        $twn = stripslashes($_POST['town']);
    }
    if(!isset($_POST['county'])){
        $err += 1;
        echo "issue";
    }else{
        $cty = stripslashes($_POST['county']);
    }

    if($err == 0){
        $add = new Address();
        $add->setId($id);
        $add->setAddBuilding($building);
        $add->setAddStreet($street);
        $add->setAddArea($area);
        $add->setAddTown($twn);
        $add->setAddCounty($cty);
        $msgs = $add->updateAddress();
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
            <legend>Edit Address</legend>
            <div class="row">
                <div class="span6">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Building</span>
                                <input type="text"  placeholder="Name of Building" name="building" required=""
                                       value="<?php echo $entity['building'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Street</span>
                                <input type="text"  placeholder="Street Name" name="street" required=""
                                       value="<?php echo $entity['street'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Area</span>
                                <input type="text"  placeholder="Area" name="area" required=""
                                       value="<?php echo $entity['area'] ?>">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="<?php echo $_SESSION['nonce'] ?>" name="nonce">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Town</span>
                                <select type="text" name="town" required="">
                                    <?php
                                    while ($town = $em->fetch($towns)){ ?>
                                        <option <?php
                                        if($entity['town'] ==$town['town_name'] )echo 'selected="selected"'
                                        ?>><?php echo $town['town_name'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">County</span>
                                <select type="text" name="county" required="">
                                    <?php
                                    while ($county = $em->fetch($counties)){ ?>
                                        <option <?php
                                        if($entity['town'] ==$county['cty_name'] )echo 'selected="selected"'
                                        ?>><?php echo $county['cty_name'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="update" name="create">
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