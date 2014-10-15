<div id="myModal2" class="span12 modal message hide fade">
    <form  action="" method="post">
        <fieldset>
            <legend>Inspection Report</legend>
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
                    <input type="hidden" value="<?php echo $_SESSION['nonce'] ?>" name="nonce">
                    <input type="hidden" value="create" name="create">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Staff</span>
                                <select name="staff" required="">
                                    <?php
                                    while ($staff = $em->fetch($staffs)){
                                        echo '<option value="'.$staff['id'].'">'.$staff['staff_last_name'].' ,'.$staff['staff_first_name'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Issue</span>
                                <textarea class="" name="issue" required="" style="resize: none; hieght:100px; width:200px;"></textarea>
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