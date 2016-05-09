<!DOCTYPE html>
<?php 
$amount_of_games_in_cart = 0;
if(!empty($_SESSION['games'])){
    foreach($_SESSION['games'] as $val){
        $amount_of_games_in_cart += $val;
    }
}
if(isset($amount_of_games_in_cart)){
    $cart_string = "(".$amount_of_games_in_cart.")";
} else{
    $cart_string = "";
}
?>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <title>MINI</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="<?php echo URL; ?>js/slick/slick/slick.min.js"></script>
    
    
    <!-- CSS -->
    <link href="<?php echo URL;?>css/slick.css" rel="stylesheet"/>
    <link href="<?php echo URL; ?>css/style.css" rel="stylesheet"/>
    <link href="<?php echo URL; ?>css/slick-theme.css" rel="stylesheet"/>
</head>
<body>
    <div class="shoppingcart_background">
        <div class="shoppingcart_wrapper">
    <div class="shoppingcart_left">
        <a href="<?php echo URL; ?>"><div  class="shoppingcart1"><img src="<?php echo URL; ?>img/home.png"></div></a>
    </div>
        <div class="shoppingcart_center">
            <div class="shoppingcart_center_left">
                
            </div>
            <div class="shoppingcart_center_right">
                <a>Winkelmand <?php echo " ".$cart_string?></a>
            </div>
        </div>
        <div class="shoppingcart_right">
                <a href="<?php echo URL; ?>order/shoppingcart"><div  class="shoppingcart1"><img src="<?php echo URL; ?>img/shoppingcart.png"></div></a>
                
        </div>
            <?php 
            if(isset($_SESSION['customer_login'])){
                if(!$_SESSION['customer_login']){ ?>
        <div class="shoppingcart_right2">
                <a href="<?php echo URL ?>pages/login"><div class="login_button">Inloggen</div></a>
        </div>
            <?php } else { ?>
            <div class="shoppingcart_right2">
                <a href="<?php echo URL ?>pages/logout"><div class="logout_button">Log uit</div></a>
        </div>
            <?php }} ?>
            
        </div>
        </div>
    <div class="wrapper">
        
