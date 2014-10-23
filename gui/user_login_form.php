
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
            <button type="submit" class="btn bg-color-green btn-large">Sign in</button>
        </div>
    </div>
    </div>
</form>