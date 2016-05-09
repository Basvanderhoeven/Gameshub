<?php if(isset($customer_validation)){ 
    if($customer_validation == false){
        $customer_validation = true;?>
<div class="customer_validation">
        <form method="post" action="Step2">
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
    <?php }} ?>
    <div class="paymethod_message">
        <p><?php if(isset($message)){ echo $message; } ?></p>
    </div>

<script type="text/javascript">
    $('#popup_yes').click(function(){
        $('.display_popup').css("display", "none");
    });
    $('#popup_no').click(function(){
        $('.display_popup').css("display", "none");
        window.location.replace("<?php echo URL ?>order/Step1");
    });
</script>
