<div id="myModal2" class="span12 modal message hide fade">
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
                    <input type="hidden" value="<?php echo $_SESSION['nonce'] ?>" name="nonce">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Category</span>
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
                            <button type="submit" class="btn btn-primary" id="register-submit-btn">Save</button>
                        </div>
                    </div>
                </div>
            </div>
</div>
</fieldset>
</form>
</div>