<?php 
if(isset($_GET['id'])){
    echo 'Weet u zeker dat u de game met het id:'.$game['id'].' wilt verwijderen?';
    echo '<form method="post"><input type="submit" name="delete_yes" value="Ja">';
    echo '<input type="submit" name="delete_no" value="Nee"></form>';
}
?>
