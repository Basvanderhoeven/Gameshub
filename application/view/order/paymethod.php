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
    </form>

        </div>
<?php if(isset($customer) && $customer_validation == false){ ?>
<div class="display_popup">
<div class="cover"></div>
<div class="popup">
    <div>
        <form method="post">
            <div class="popup_message">
                <a><?php if(isset($customer)){echo "Bent u ".ucfirst($customer['firstname'])." ".$customer['infix']." ".ucfirst($customer['surname'])."?";}?></a>
            </div>
            <div class="popup_yes">
                <a id="popup_yes"><input type="submit" name="popup_submit" id="popup_yes" value="Ja"></a>
            </div>
            <div class="popup_no">
                <a id="popup_no">Nee</a>
            </div>
        </form>
    </div>
</div>
</div>
<?php } ?>
    <div class="paymethod_message">
        <p><?php if(isset($message)){ echo $message; } ?></p>
    </div>

<script type="text/javascript">
$('.paymethod_item').click(function () {
        $('input[type=radio]:not(:checked)').parent().removeClass("selected_paymethod");
        $('input[type=radio]:checked').parent().addClass("selected_paymethod");
    });

    $('input[type=submit]').click(function(){
       if ($("input[name='paymethod']:checked").length > 0){
           $('.display_popup').css("display", "block");
          }
          else{
           alert('Selecteer een betaalmethode.');
          }
    });
    $('#popup_yes').click(function(){
        $('.display_popup').css("display", "none");
    });
    $('#popup_no').click(function(){
        $('.display_popup').css("display", "none");
        $('.paymethod_message p').html('Vul een ander klantnummer in.');
    });
</script>
