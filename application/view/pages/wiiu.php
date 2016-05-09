<?php foreach($games as $game){
            if (strpos($game['price'],'.') !== false) {
            $split = explode('.', $game['price']);
            if(strlen($split[1]) == 1){
                $game['price'] .= '0';
            }
    } else{
        $game['price'] .= '.00';
    }
        echo '<div class="promo_game_background shadow">
                <a href='.URL.'pages/game&id='.$game['id'].'><img src="'.URL."img/games/".$game['image'].'"></a>
                    <div class="under_promo_image">
                <div class="promo_price_tag"><a>&euro;'.$game['price'].'</a></div>
            <div class="promo_platform">'.$game['platform'].'</div>
            </div>
            <div></div>
        </div>';
        } ?>