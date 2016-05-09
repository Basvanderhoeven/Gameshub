<?php if(!$_SESSION['customer_login']){?>
<div>
    <div class="customerloginform">
        <form method="post">
        <div class="login_email"><input type="email" name="email" placeholder="Email" required></div>
        <div class="login_password"><input type="text" name="password" placeholder="Wachtwoord" required></div>
        <div class="login_submit"><input type="submit" name="login_submit" value="Login"></div>
        </form>
            <div>
        <p><?php if(isset($message)){ echo $message;} ?></p>
    </div>
    </div>

</div>
<?php } else{ ?>
<div>
    <div class="customerloginform">
        <p>U bent al ingelogd.</p>
    </div>
</div>
<?php } ?>

