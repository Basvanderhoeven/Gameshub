<?php
$table = "<table>"
        . "<tr>"
        . "<th>Order</th>"
        . "<th>Naam</th>"
        . "<th>Platform</th>"
        . "<th>Prijs</th>"
        . "<th>Aantal</th>"
        . "</tr>";
$game_array = array();
foreach($orders as $order){
    $orderrows = $this->order->getOrderrowsbyID($order['id']);
    foreach($orderrows as $orderrow){
        $game_array[$orderrow['game_id']] = $orderrow['amount'];
        
        $games = $this->game->getGamesById($game_array);
        foreach($games as $game){
        $table .= "<tr>"
                    . "<td>".$order['id']."</td>"
                    . "<td>".$game['name']."</td>"
                    . "<td>".$game['platform']."</td>"
                    . "<td>".$game['price']."</td>"
                    . "<td>".$orderrow['amount']."</td>"
                    . "</tr>";
    }
    }
}
echo $table;


?>