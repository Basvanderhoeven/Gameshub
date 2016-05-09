<div class="shoppingcart_uppercontent">
    <div class="shoppingcart_table_header"><h3>Mijn winkelwagen</h3></div>
    <?php 
    $total_price = 0;
    if(!empty($_SESSION['games'])){
        $total_price = 0;
    foreach($games as $game){
        $game_totaal = $_SESSION['games'][$game['id']] * $game['price'];
        $total_price += $game_totaal;
            if (strpos($game_totaal,'.') !== false) {
            $split = explode('.', $game_totaal);
            if(strlen($split[1]) == 1){
                $game_totaal .= '0';
            }
    } else{
        $game_totaal .= '.00';
    }
        echo '<div class="shoppingcart_table_item shadow">
                    <div class="shoppingcart_table_item_name">'.$game['name'].'</div>
                    <div class="shoppingcart_table_item_amount">
                        <div class="shoppingcart_table_item_add"><a href="'.URL.'order/shoppingcart?add='.$game['id'].'"><img src="'.URL.'img/add_img.png"></a></div>
                            <a>'.$_SESSION['games'][$game['id']].'</a>
                        <div class="shoppingcart_table_item_delete"><a href="'.URL.'order/shoppingcart?lower='.$game['id'].'"><img src="'.URL.'img/del_img.png"></a></div>
                        </div>
                    <div class="shoppingcart_table_item_platform">'.$game['platform'].'</div>
                    <div class="shoppingcart_table_item_price">&euro;'.$game_totaal.'</div>
                    
              </div>';
        } 
        
    
    }
    echo '<div class="shoppingcart_table_totalprice"><a>Totaalprijs</a><a>  &euro;'.$total_price.'</a></div>';
    if(isset($_SESSION['message'])){echo "<div class='shoppingcart_table_message'>".$_SESSION['message']."</div>"; $_SESSION['message'] = '';}
        ?>
    
    </div>

<?php

        if(isset($_SESSION['games'])){
        if(!empty($_SESSION['games'])){?>
    <div class="shoppingcart_table_buttons">
    <div class="shoppingcart_table_emptycard">
        <a href="<?php echo URL; ?>order/shoppingcart?empty=true">Winkelmand legen</a>
        <img src="<?php echo URL; ?>img/header_left.png">
    </div>
        
    <div class="shoppingcart_table_buy">
        <a href="<?php  echo URL;?>order/Step1">Betalen</a><img src="<?php echo URL; ?>img/header_right.png">
    </div>
    </div>
        <?php }}?>





