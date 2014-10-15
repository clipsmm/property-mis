<div id="myModal2" class="span12 modal message hide fade">
<form  action="" method="post">
    <fieldset>
        <legend>Add New Department</legend>
        <div class="control-group">
            <div class="controls">
                <div class="input-prepend">
                    <span class="add-on">Department Code</span>
                    <input type="text"  placeholder="e.g. HR" name="deptCode" required="">
                </div>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <div class="input-prepend">
                    <span class="add-on">Department Name</span>
                    <input type="text" id="lastName" placeholder="e.g. Human Resource" name="deptName" required="">
                </div>
            </div>
        </div>
        <input type="hidden" value="<?php echo $_SESSION['nonce'] ?>" name="nonce">
        <input type="hidden" value="create" name="create">
        <div class="control-group">
            <div class="controls">
                <div class="control-group">
                    <button type="submit" class="btn btn-primary" id="register-submit-btn">Add Department</button>
                </div>
            </div>
        </div>
    </fieldset>
</form>
</div>

