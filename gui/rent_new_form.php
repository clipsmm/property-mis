<div id="myModal2" class="span12 modal message hide fade">
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
                                    while ($prty = $em->fetch($props)){
                                        echo '<option value="'.$prty['id'].'">'.$prty['prop_name'].'</option>';
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
                                <span class="add-on">Tenant</span>
                                <select name="tenant" required="">
                                    <?php
                                    while ($ten = $em->fetch($tenants)){
                                        echo '<option value="'.$ten['id'].'">'.$ten['ten_name'].'</option>';
                                    }
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
                                       class="span2 datepicker" data-provide="datepicker">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Date Out</span>
                                <input type="text" id="dp3" data-date-format="yyyy/mm/dd" name="dateO"
                                       class="span2 datepicker" data-provide="datepicker">
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