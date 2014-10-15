<?php
use Entity\Rent;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create']) && $_POST['create'] == "update"){
    $err = 0;
    if(!isset($_POST['property'])){
        $err += 1;
    }else{
        $property = stripslashes($_POST['property']);
    }
    if(!isset($_POST['tenant'])){
        $err += 1;
    }else{
        $tenant = stripslashes($_POST['tenant']);
    }
    if(!isset($_POST['dateI'])){
        $err += 1;
    }else{
        $dateI= stripslashes($_POST['dateI']);
    }
    if(!isset($_POST['dateO'])){
        $err += 1;;
    }else{
        $dateO = stripslashes($_POST['dateO']);
    }

    if($err == 0){
        $ren = new Rent();
        $ren->setId($id);
        $ren->setPropId($property);
        $ren->setTenantId($tenant);
        $ren->setDateIn($dateI);
        $ren->setDateOut($dateO);
        $msgs = $ren->createRent();
    }else{
        $msgs = $err.": Please fill all fields!";
    }
}
?>

<div id="myModal2" class="span12">
    <form  action="" method="post">
        <fieldset>
            <legend>Rent</legend>
            <div class="row">
                <div class="span6">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Property</span>
                                <select name="property" required="">
                                    <?php
                                    while ($prot = $em->fetch($props)){ ?>
                                        <option value="<?php echo $prot['id'] ?>"
                                            <?php if($prot['id'] == $entity['prop_id']) echo 'selected="selected"' ?>
                                            ><?php echo $prot['prop_name'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="update" name="create">
                    <input type="hidden" value="<?php echo $_SESSION['nonce'] ?>" name="nonce">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Tenant</span>
                                <select name="tenant" required="">
                                    <?php
                                    while ($ten = $em->fetch($tenants)){ ?>
                                        <option value="<?php echo $ten['id'] ?>"
                                            <?php if($ten['id'] == $entity['tenant_id']) echo 'selected="selected"' ?>
                                            ><?php echo $ten['ten_name'] ?></option>
                                   <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Date In</span>
                                <input type="text" id="dp3" data-date-format="yyyy/mm/dd" name="dateI"
                                       class="span2 datepicker" data-provide="datepicker"
                                       value="<?php echo $entity['date_in'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Date Out</span>
                                <input type="text" id="dp3" data-date-format="yyyy/mm/dd" name="dateO"
                                       class="span2 datepicker" data-provide="datepicker"
                                    value="<?php echo $entity['date_out'] ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                    <div class="control-group">
                        <button type="submit" class="btn btn-primary" id="register-submit-btn">Insert</button>
                    </div>
                </div>
            </div>
</div>
</fieldset>
</form>
</div>