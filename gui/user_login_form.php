
<form class="form-login" method="post" action="">
    <div class="my-controls">
        <div class="login-logo">
        <img src="<?php asset('met/img/logo.png') ?>">
    </div>
    <div class="control-group">
        <label class="control-label" for="inputEmail">Username</label>
        <div class="controls">
            <input type="text" id="inputEmail" placeholder="Username" name="username">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">Password</label>
        <div class="controls">
            <input type="password" id="inputPassword" placeholder="Password" name="password">
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <label class="checkbox">
                <input type="checkbox"><span class="metro-checkbox">Remember me</span>
            </label>
            <button type="submit" class="btn">Sign in</button>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <a class="btn btn-link" href="register">Create Account</a>
            or
            <a class="btn btn-link" href="register">Retrieve password</a>
        </div>
    </div>
    </div>
</form>