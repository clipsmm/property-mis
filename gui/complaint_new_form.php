<div id="myModal2" class="span12 modal message hide fade">
    <form  action="" method="post">
        <fieldset>
            <legend>Add New Complaint</legend>
            <div class="row">
                <div class="span6">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Client</span>
                                <select type="text" name="client" required="">
                                    <?php
                                    while ($client = $em->fetch($clients)){
                                        echo '<option value="'.$client['id'].'">'.$client['client_last_name'].
                                            ', '.$client['client_first_name'].'</option>';
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
                                <span class="add-on">Category</span>
                                <select type="text" name="category" required="">
                                    <?php
                                    while ($cat = $em->fetch($cats)){
                                        echo '<option value="'.$cat['cat_name'].'">'.$cat['cat_name'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Title</span>
                                <input type="text"  placeholder="e.g. Poor sanitation" name="title" required="">
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
                    <input type="hidden" value="<?php echo $_SESSION['nonce'] ?>" name="nonce">
                </div>

                    <div class="control-group">
                        <div class="controls">
                            <div class="control-group">
                                <button type="submit" class="btn btn-primary" id="register-submit-btn">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
        </fieldset>
    </form>
</div>