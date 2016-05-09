<div class="barcode_content">
    <form method="post">
    <div>Voer hier de barcode van de order in.</div>
    <div><input type="text" name="barcode_input" /></div>
    <div><input type="submit" name="barcode_submit"/></div>
    </form>
</div>
<?php 
if(isset($_SESSION['message'])){
        echo $_SESSION['message'];
    }
$tr = '';
if(isset($_POST['barcode_submit'])){  
    $_SESSION['barcode_input'] = $_POST['barcode_input'];
?>
<table style="width:100%; text-align:left;">
    <th>Naam</th>
    <th>Platform</th>
    <th>Prijs</th>
    <th>Voorraad</th>
    <th>Locatie</th>
    <th>Aantal</th>
    <th>Delivered</th>

    <?php
    
        $order = $this->order->getOrderByBarcode($_SESSION['barcode_input']);
        if($order){
        $orderrows = $this->order->getNotDeliveredOrderrowsbyID($order['id']);
        $tr .= '<form method="post">';
        
        foreach($orderrows as $orderrow){
            $games = $this->game->getGameByIdArray($orderrow['game_id']);
            $stocks = $this->stock->getStockByGameId($orderrow['game_id']);
            $totalstock = $this->stock->getTotalStockByGameId($orderrow['game_id']);
            $locations = $this->game->getAllLocations($orderrow['game_id'], $totalstock['totaal']);
            foreach($games as $game){
                $tr .= '<tr>';
                $tr .= "<td><input type='hidden' name='barcode_name' value='".$game['name']."'>".$game['name']."</td>";
                $tr .= "<td><input type='hidden' name='barcode_platform' value='".$game['platform']."'>".$game['platform']."</td>";
                $tr .= "<td><input type='hidden' name='barcode_price' value='".$game['price']."'>&euro;".$game['price']."</td>";
                
            }
            foreach($stocks as $stock){
                $tr .= "<td><input type='hidden' name='barcode_totalstock' value='".$totalstock['totaal']."'>".$totalstock['totaal']."</td>";
                $tr .= "<td><input type='hidden' name='barcode_location' value='".$stock['location']."'>".$stock['location']."</td>";
                $tr .= "<td><input type='hidden' name='barcode_amount' value='".$orderrow['amount']."'>".$orderrow['amount']."</td>";
                $tr .= "<td><input type='checkbox' name='barcode_delivered[]' value='".$orderrow['game_id']."'></td>";
                $tr .= '</tr>';
            }
        }
        $tr .= '<tr><td><input type="submit" name="barcode_stock_submit" value="Werk voorraad bij"></td></tr></form>';
    } else{
    $tr = "<tr><td colspan='3'>Deze barcode bestaat niet</td></tr>";
}
} 
    echo $tr;
    

    ?>
</table>
 