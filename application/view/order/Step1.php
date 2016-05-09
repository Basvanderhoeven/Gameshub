<div class="paymethod_uppercontent">
    <form method="post">
        <div class="paymethod_item shadow">
            <input type="radio" name="paymethod" id="ideal_option" value="IDEAL" required>
            <label for="ideal_option"><img src="<?php echo URL;?>img/paymethod/ideal.png"></label>
        </div>
        <div class="paymethod_item shadow">
            <input type="radio" name="paymethod" id="paypal_option" value="PAYPAL" required>
            <label for="paypal_option"><img src="<?php echo URL;?>img/paymethod/paypal.png"></label>
        </div>
        <div class="paymethod_item shadow">
            <input type="radio" name="paymethod" id="visa_option" value="VISA" required>
            <label for="visa_option"><img src="<?php echo URL;?>img/paymethod/visa.png"></label>
        </div>
        <div class="paymethod_item shadow">
            <input type="radio" name="paymethod" id="creditcard_option" value="CREDITCARD" required>
            <label for="creditcard_option"><img src="<?php echo URL;?>img/paymethod/creditcard.png"></label>
        </div>
        <div class="paymethod_customerselection">
            <a>Klantnummer</a>
            <input type="text" name="customerid" required>
            <input class="shadow" name="paymethod_submit" type="submit" value="Betalen">
        </div>
        <div class="paymethod_message">
        <p><?php if(isset($message)){ echo $message; } ?></p>
    </div>
    </form>
</div>
<script type="text/javascript">
$('.paymethod_item').click(function () {
        $('input[type=radio]:not(:checked)').parent().removeClass("selected_paymethod");
        $('input[type=radio]:checked').parent().addClass("selected_paymethod");
    });

    $('input[type=submit]').click(function(){
       if ($("input[name='paymethod']:checked").length > 0){
          }
          else{
           alert('Selecteer een betaalmethode.');
          }
    });
</script>
