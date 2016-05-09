        <!-- start Basic Jquery Slider -->
        <div class="slider_background shadow">
        <div class="slider">
          <div>
              <img src="<?php echo URL; ?>img/slider/fallout4.png" title="Automatically generated caption">
              <img src="<?php echo URL; ?>img/slider/needforspeed.png" title="Automatically generated caption">
              <table class="slider_table">
                  <tr>
                      <td>Fallout 4</td>
                  </tr>
                  <tr><td>Need for speed 2015</td></tr>
              </table>
          </div>
          <div>
              <img src="<?php echo URL; ?>img/slider/halo5.png" title="Automatically generated caption">
              <img src="<?php echo URL; ?>img/slider/blackops3.png" title="Automatically generated caption">
              <table class="slider_table">
                  <tr>
                      <td>Halo 5: Guardians</td>
                  </tr>
                  <tr><td>Call of duty: Black ops III</td></tr>
              </table>
          </div>
        </div>
        <div class="nextslider_background"><div class="nextslider"></div></div>
        <div class="prevslider_background"><div class="prevslider"></div></div>
        </div>
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
                <a href='.URL.'pages/game?id='.$game['id'].'><img src="'.URL."img/games/".$game['image'].'"></a>
                    <div class="under_promo_image">
                <div class="promo_price_tag"><a>&euro;'.$game['price'].'</a></div>
            <div class="promo_platform">'.$game['platform'].'</div>
            </div>
            <div></div>
        </div>';
        } ?>
        <div class="lowercontent shadow">
            <div class="lowercontent_left shadow">
                
            </div>
            <div class="lowercontent_right shadow">
                
            </div>
        </div>
        <!-- end Basic jQuery Slider -->
<script type="text/javascript">
    $(document).ready(function(){
      $('.slider').slick({
          arrows:false,
          autoplay: true,
          autoplaySpeed: 2000
      });
      $('.nextslider_background').click(function(){
          $('.slider').slick('slickNext');
          }
      );
      $('.prevslider_background').click(function(){
          $('.slider').slick('slickPrev');
          }
      );
    });
</script>

