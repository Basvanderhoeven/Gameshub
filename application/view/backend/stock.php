<div>
    <div class="stock_table">
        <div class="stock_table_title">Voorraad van het magazijn</div>
        <div class="stock_table_headers">
            <div class='stock_table_header_name'>Naam</div>
            <div class='stock_table_header_platform'>Platform</div>
            <div class='stock_table_header_stock'>Voorraad</div>
            <div class='stock_table_header_location'>Locatie</div>
        </div>
        <?php 
        foreach($games as $game){
            $locations = $this->game->getAllLocations($game['gameid'], $game['totaal']);
            
      echo "<div class='stock_table_item'>
                <div class='stock_table_item_name'>".$game['name']."</div>
                <div class='stock_table_item_platform'>".$game['platform']."</div>
                <div class='stock_table_item_fysical'>".$game['totaal']."</div>
                <div class='stock_table_item_location'>".$locations."</div>
                    
            </div><br>";
      
        }
        ?>
        
    </div>
</div>

