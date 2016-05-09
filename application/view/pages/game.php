<?php
$videolink = str_replace('watch?v=','embed/', $game['video']);
if (strpos($game['price'],'.') !== false) {
            $split = explode('.', $game['price']);
            if(strlen($split[1]) == 1){
                $game['price'] .= '0';
            }
    } else{
        $game['price'] .= '.00';
    }
?>
<div class="game_detail_upper_content">
<div class="game_detail_image">
    <img src="<?php echo URL."img/games/".$game['image']; ?>">
</div>
<div class="game_detail_shortdescription shadow">
<div class="game_detail_title shadow"><a><?php echo $game['name']; ?></a></div>
<div class="game_detail_genre"><a><?php echo $game['genre']; ?></a></div>
<div class="game_detail_centerfield"><a><?php echo $game['description']; ?></a></div>
<div class="game_detail_right_menu">
<div class="game_detail_price"><a>&euro;<?php echo $game['price']; ?></a></div>
<div class="game_detail_platform"><a><?php echo $game['platform']; ?></a></div>
<?php if($game['sellable'] > 0){ ?>
<div class="game_detail_availability"><a><?php echo $game['sellable']." "; ?></a><a>Beschikbaar</a></div>
<?php } else{?>
<div class="game_detail_availability"><a>Niet beschikbaar</a></div>
<?php } ?>
<div class="game_detail_release"><a>Verschijnings datum:<br> <?php echo $game['release_date']; ?></a></div>
</div>
</div>
    
</div>
<?php if($game['sellable'] > 0){?>
<div class="game_detail_buy_button">
    <a href="<?php echo URL; ?>order/shoppingcart?id=<?php echo $game['id']; ?>">Voeg toe aan winkelwagen</a>
    <img src="<?php echo URL; ?>img/header_right.png">
</div>
<?php }?>
<div class="game_detail_lower_content">
    <div class="game_detail_youtube_video">
        <iframe width="560" height="315" src="<?php echo $videolink;?>" frameborder="0" allowfullscreen></iframe>
    </div>
</div>
