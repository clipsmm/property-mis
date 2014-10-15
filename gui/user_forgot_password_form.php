<!-- BEGIN LOGO -->
<?php logo() ?>

<form class="ui inverted form segment" action="" method="post">
    <h3 >Forget Password ?</h3>

    <p>Enter your e-mail address below to reset your password.</p>
    <div class="ui left labeled icon input field">
        <input type="email" id="email" placeholder="Email Address" name="email">
        <i class="mail icon"></i>
        <div class="ui corner label">
            <i class="icon asterisk"></i>
        </div>
    </div>
    <div class="ui buttons">
        <a href="login.php" class="ui button">Login</a>
        <div class="or"></div>
        <button type="submit" class="ui positive button" id="register-submit-btn">Reset</button>
    </div>

</form>
<!-- END FORGOT PASSWORD FORM -->
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<?php copyright(); ?>
