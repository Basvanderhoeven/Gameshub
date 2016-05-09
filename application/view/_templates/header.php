    <a href="<?php echo URL; ?>">
    <img id="logo" src="<?php echo URL; ?>img/logo.png">
    </a>
    <div class='header_background'></div>
    <img id='header_left' src='<?php echo URL; ?>img/header_left.png'>
    <img id='header_right' src='<?php echo URL; ?>img/header_right.png'>
    <!-- navigation -->
    <div class="navigation">
        <a href="<?php echo URL; ?>pages/pc">PC-Games</a>
        <a href="<?php echo URL; ?>pages/wiiu">Wii U-Games</a>
        <a href="<?php echo URL; ?>pages/ps4">PS4-Games</a>
        <a href="<?php echo URL; ?>pages/xbox">XBOX-Games</a>
        <a href="<?php echo URL; ?>pages/contact">Contact</a>
        <?php if(isset($_SESSION['customer_login'])){
            if($_SESSION['customer_login']){?>
        <a href="<?php echo URL; ?>pages/mijnbestellingen">Mijn bestellingen</a>        
        <?php
        }}
        ?>
    </div>
    <div class="container shadow">
        
    
