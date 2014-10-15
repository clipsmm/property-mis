<form class="span4 modal message hide fade" method="post" action="" id="myModal2">
    <legend>Record Payment</legend>
    <div class="control-group">
        <div class="controls">
            <div class="input-prepend">
                <span class="add-on">Amount Paid</span>
                <input type="text"  placeholder="Amount" name="paid" required="">
            </div>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <div class="input-prepend">
                <span class="add-on">Date paid</span>
                <input type="text" id="dp3" data-date-format="yyyy/mm/dd" name="date"
                       class="span2 datepicker" data-provide="datepicker">
            </div>
        </div>
    </div>
    <input type="hidden" name="create" value="create">
    <input type="hidden" name="nonce" value="<?php echo $_SESSION['nonce'] ?>">
    <div class="control-group">
        <div class="controls">
            <div class="control-group">
                <button type="submit" class="btn btn-primary" id="register-submit-btn">Save</button>
            </div>
        </div>
    </div>
</form>