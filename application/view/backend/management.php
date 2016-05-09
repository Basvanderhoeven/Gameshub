<a href="<?php echo URL ?>backend/addgame">Game toevoegen</a>
<table>
    <th>Naam</th>
    <th>Platform</th>
    <th>Voorraad</th>
    <th> </th>
    <th> </th>
<?php 
foreach($games as $game){
            
      echo "
                <tr>
                    <td>".$game['name']."</td>
                    <td>".$game['platform']."</td>
                    <td>".$game['totaal']."</td>
                    <td><a href='".URL."backend/updategame?id=".$game['gameid']."'><img src='".URL."img/edit.png' width='25' height='25' class='stock_table_edit'></div></a></td>
                    <td><a href='".URL."backend/deletegame?id=".$game['gameid']."'><img  src='".URL."img/del.png' width='25' height='25' class='stock_table_delete'></div></a></td> 
            ";
      
        }
?>
</table>
<p><?php if(isset($_SESSION['message'])){
    echo $_SESSION['message'];
}
?></p>
