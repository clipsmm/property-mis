<div id="myModal2" class="span12 modal message hide fade">
    <form  action="" method="post">
        <fieldset>
            <legend>Add New Agent</legend>
            <div class="row">
                <div class="span6">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">Name</span>
                                <input type="text" id="firstName" placeholder="First Name" name="name" required="">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="create" name="create">
                    <input type="hidden" value="<?php echo $_SESSION['nonce'] ?>" name="nonce">
                    </div>
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
                                <span class="add-on">Address</span>
                                <input type="text"  placeholder="e.g P.O BOX 123" name="address" required="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on" for="password">Email</span>
                                <input type="email"  placeholder="someone@example.com" name="email" required="">
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
                                <button type="submit" class="btn btn-primary" id="register-submit-btn">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
</div>