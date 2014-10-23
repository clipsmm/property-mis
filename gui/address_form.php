<?php
use Entity\Address;
require 'gui/head.php';
$em = $system->getDatabaseManager();
$counties = $em->getRawEntity('county');
$towns = $em->getRawEntity('towns');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create']) && $_POST['create'] == "create"){
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
        $add->setAddBuilding($building);
        $add->setAddStreet($street);
        $add->setAddArea($area);
        $add->setAddTown($twn);
        $add->setAddCounty($cty);
        if($msgs = $add->createAddress()){
            $add->redirect('?wizard');
        }

    }else{
        $msgs = $err.": Please fill all fields!";
    }
}
?>
<div id="myModal2" class="span12">
    <form  action="" method="post">
        <fieldset>
            <legend>Add New Address</legend>
            <div class="row">
                <div class="span6">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Building</span>
                                <input type="text"  placeholder="Name of Building" name="building" required="">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Street</span>
                                <input type="text"  placeholder="Street Name" name="street" required="">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Area</span>
                                <input type="text"  placeholder="Area" name="area" required="">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Town</span>
                                <select type="text" name="town" required="">
                                    <?php
                                    while ($town = $em->fetch($towns)){
                                        echo '<option >'.$town['town_name'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="create" name="create">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">County</span>
                                <select type="text" name="county" required="">
                                    <?php
                                    while ($county= $em->fetch($counties)){
                                        echo '<option>'.$county['cty_name'].'</option>';
                                    }
                                    ?>
                                </select>
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
            </div>
        </fieldset>
    </form>
</div>