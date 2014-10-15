<div id="myModal2" class="span12">
    <form  action="" method="post">
        <fieldset>
            <legend>Add New Property</legend>
            <div class="row">
                <div class="span6">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Name</span>
                                <input type="text"  placeholder="Name of Property" name="name" required="">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="<?php echo $_SESSION['nonce'] ?>" name="nonce">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Property Type</span>
                                <select name="type" required="">
                                    <?php
                                    while ($type= $em->fetch($types)){
                                        echo '<option value="'.$type['id'].'">'.$type['type_name'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Owner</span>
                                <select  name="owner" required="">
                                    <?php
                                    while ($own = $em->fetch($owns)){
                                        echo '<option value="'.$own['id'].'">'.$own['client_last_name'].', '.$own['client_first_name'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Address</span>
                                <select name="address" required="">
                                    <?php while($add = $em->fetch($addresses)) { ?>
                                        <option value="<?php echo $add['id'] ?>">
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
                                <input type="text"  placeholder="number of rooms" name="units" required="">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Square Metres</span>
                                <input type="text"  placeholder="size of property" name="area" required="">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Unit Rent Price (Kshs)</span>
                                <input type="text"  placeholder="Rent amount" name="rent" required="">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Sale Price</span>
                                <input type="text"  placeholder="Sale Amount" name="sale" required="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="span6">

                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Date Submitted</span>
                                <input type="text" id="dp3" data-date-format="yyyy/mm/dd" name="date"
                                       class="span2 datepicker" data-provide="datepicker">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="create" name="create">

                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Agent</span>
                                <select name="agent" required="">
                                    <?php while($ag = $em->fetch($agents)) { ?>
                                        <option value="<?php echo $ag['id'] ?>">
                                            <?php
                                            echo $ag['ag_name'];
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
                                <span class="add-on">Sold</span>
                                <select name="sold">
                                    <option value="0">NO</option>
                                    <option value="1">YES</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Description</span>
                                <textarea class="textarea" name="desc" required="" ></textarea>
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