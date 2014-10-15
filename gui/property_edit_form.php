<?php
use Entity\Property;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create']) && $_POST['create'] == "update"){
    $err = 0;
    if(!isset($_POST['name'])){
        $err += 1;
        echo "Fill client";
    }else{
        $name = stripslashes($_POST['name']);
    }
    if(!isset($_POST['type'])){
        $err += 1;
        echo "Category ";
    }else{
        $type = stripslashes($_POST['type']);
    }
    if(!isset($_POST['owner'])){
        $err += 1;
        echo "title";
    }else{
        $owner = stripslashes($_POST['owner']);
    }
    if(!isset($_POST['address'])){
        $err += 1;
        echo "issue";
    }else{
        $address = stripslashes($_POST['address']);
    }
    if(!isset($_POST['units'])){
        $err += 1;
        echo "issue";
    }else{
        $units = stripslashes($_POST['units']);
    }
    if(!isset($_POST['date'])){
        $err += 1;
        echo "issue";
    }else{
        $date = stripslashes($_POST['date']);
    }
    if(!isset($_POST['sale'])){
        $err += 1;
        echo "issue";
    }else{
        $rent = stripslashes($_POST['rent']);
    }
    if(!isset($_POST['sale'])){
        $err += 1;
        echo "issue";
    }else{
        $sale = stripslashes($_POST['sale']);
    }
    if(!isset($_POST['sold'])){
        $err += 1;
        echo "issue";
    }else{
        $sold = stripslashes($_POST['sold']);
    }
    if(!isset($_POST['desc'])){
        $err += 1;
        echo "issue";
    }else{
        $desc = stripslashes($_POST['desc']);
    }
    if(!isset($_POST['area'])){
        $err += 1;
        echo "issue";
    }else{
        $area = stripslashes($_POST['area']);
    }
    if(!isset($_POST['agent'])){
        $err += 1;
    }else{
        $agent = stripslashes($_POST['agent']);
    }

    if($err == 0){
        $prop = new Property();
        $prop->setId($id);
        $prop->setAddressId($address);
        $prop->setOwnerId($owner);
        $prop->setTypeId($type);
        $prop->setPropDateSold($sold);
        $prop->setPropDateSubmitted($date);
        $prop->setPropName($name);
        $prop->setPropRooms($units);
        $prop->setPropDesc($desc);
        $prop->setPropAgentId($agent);
        $prop->setPropSalePrice($sale);
        $prop->setPropRentPrice($rent);
        $prop->setPropArea($area);

    }else{
        $msgs = $err.": Please fill all fields!";
    }
}
?>
<div id="myModal2" class="span12">
    <form  action="" method="post">
        <fieldset>
            <legend>Edit Property</legend>
            <div class="row">
                <div class="span6">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Name</span>
                                <input type="text"  placeholder="Name of Property" name="name" required=""
                                    value="<?php echo $entity['prop_name'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Property Type</span>
                                <select type="text" name="type" required="">
                                    <?php
                                    while ($typ= $em->fetch($types)){ ?>
                                        <option vaue="<?php echo $typ['id'] ?>"
                                            <?php
                                            if($entity['type_id'] == $typ['id']) echo 'selected= "selected"'
                                            ?>
                                            ><?php echo $typ['type_name'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Owner</span>
                                <select type="text" name="owner" required="">
                                    <?php
                                    while ($own = $em->fetch($owns)){ ?>
                                        <option value="<?php echo $own['id'] ?>"
                                            <?php
                                            if($entity['client_id'] == $own['id']) echo 'selected = "selected"'
                                            ?>
                                            >
                                           <?php echo $own['client_last_name'].', '.$own['client_first_name'] ?>
                                        </option>
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
                                <span class="add-on">Address</span>
                                <select name="address" required="">
                                    <?php while($add = $em->fetch($addresses)) { ?>
                                        <option value="<?php echo $add['id'] ?>"
                                            <?php
                                            if($add['id'] == $entity['address_id']) echo 'selected="selected"'
                                            ?>
                                            >
                                            <?php
                                            echo
                                                $add['building'].", ".$add['street'].", ".$add['area'].", ".$add['town'].", ".$add['county'];

                                            ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Number of Units</span>
                                <input type="text"  placeholder="number of rooms" name="units" required=""
                                    value="<?php echo $entity['prop_rooms'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Square Metres</span>
                                <input type="text"  placeholder="size of property" name="area" required=""
                                       value="<?php echo $entity['prop_area'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Date Submitted</span>
                                <input type="text" id="dp3" data-date-format="yyyy/mm/dd" name="date"
                                       class="span2 datepicker" data-provide="datepicker"
                                       value="<?php echo $entity['date_submitted'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Unit Rent Price (Kshs)</span>
                                <input type="text"  placeholder="Rent amount" name="rent" required=""
                                       value="<?php echo $entity['rent_price'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Sale Price</span>
                                <input type="text"  placeholder="Sale Amount" name="sale" required=""
                                       value="<?php echo $entity['sale_price'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Agent</span>
                                <select name="agent" required="">
                                    <?php
                                    while ($ag = $em->fetch($agents)){ ?>
                                        <option value="<?php echo $ag['id'] ?>"
                                            <?php
                                            if($entity['agent_id'] == $ag['id']) echo 'selected = "selected"'
                                            ?>
                                            >
                                            <?php echo $ag['ag_name']; ?>
                                        </option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Sold</span>
                                <select name="sold">
                                    <option value="0"
                                        <?php
                                        if($entity['prop_status'] == 0) echo 'selected="selected"'
                                        ?>
                                        >NO</option>
                                    <option value="1"
                                        <?php
                                        if($entity['prop_status'] == 1) echo 'selected="selected"'
                                        ?>
                                        >YES</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Description</span>
                                <textarea class="textarea" name="desc" required=""
                                "><?php echo $entity['prop_desc'] ?> </textarea>
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