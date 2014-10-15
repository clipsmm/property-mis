<div id="myModal2" class="span12 modal message hide fade">
<form  action="" method="post">
    <fieldset>
        <legend>Add New Staff</legend>
        <div class="row">
            <div class="span6">
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on">First Name</span>
                            <input type="text" id="firstName" placeholder="First Name" name="firstName" required="">
                        </div>
                    </div>
                </div>
                <input type="hidden" value="create" name="create">
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on">Last Name</span>
                            <input type="text" id="lastName" placeholder="Last Name" name="lastName" required="">
                        </div>
                    </div>
                </div>
                <input type="hidden" value="<?php echo $_SESSION['nonce'] ?>" name="nonce">
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on">National ID</span>
                            <input type="text"  placeholder="National ID no." name="idNo" required="">
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on">Date of Birth</span>
                            <input type="text" id="dp3" data-date-format="yyyy/mm/dd" name="dob"
                                   class="span2 datepicker" data-provide="datepicker">
                        </div>
                    </div>
                </div>
            </div>
            <div class="span6">
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on" for="password">Date Hired</span>
                            <input type="text" id="dp2" data-date-format="yyyy/mm/dd" name="doh"
                                   class="span2 datepicker" data-provide="datepicker">
                        </div>
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on" for="passwordc">Gender</span>
                            <select  name="gender"  required="">
                                <option selected="selected">Female</option>
                                <option>Male</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on" for="passwordc">Department</span>
                            <select  name="department"  required="">
                                <?php
                                while($department = $em->fetch($departments)){
                                    echo '<option value="'.$department['id'].'">'.$department['dept_name'].'</option>';
                                }?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on">Phone</span>
                            <input type="text"  placeholder="07XXAAABBB" name="phone" required="">
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="control-group">
                            <button type="submit" class="btn btn-primary" id="register-submit-btn">Add Staff</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
</form>
</div>