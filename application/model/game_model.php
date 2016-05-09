<?php
class Game_model extends Model
{
    public function getAllGames(){
       $sql = "SELECT game.id as gameid, game.name, game.platform, sum(stock.fysical) as totaal "
               . "FROM game "
               . "INNER JOIN stock on stock.game_id = game.id "
               . "GROUP BY game.name, game.platform "
               . "ORDER BY game.name";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(); 
    }
    public function getAllLocations($gameid, $totaal){
        $sql = "SELECT location, fysical FROM stock WHERE game_id = ".$gameid;
        $query = $this->db->prepare($sql);
        $query->execute();
        $rows = $query->fetchAll(); 
        $result = '';
        foreach($rows as $row){
            $result .= $row['location'];
            if($row['fysical'] < $totaal){
            $result .= "(".$row['fysical'].")";    
            }
            $result .= ",";
        }
        $result = rtrim($result, ',');
        return $result;
    }
    public function getGames(){
        $sql = "SELECT * from game order by release_date LIMIT 5";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getPcGames(){
        $sql = "SELECT * from game WHERE platform='pc'";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getXBOXGames(){
        $sql = "SELECT * from game WHERE platform='xbox'";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getPS4Games(){
        $sql = "SELECT * from game WHERE platform='ps4'";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getWIIUGames(){
        $sql = "SELECT * from game WHERE platform='wii u'";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getGameById($id){
        $sql = "SELECT * from game WHERE id=".$id;
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
    public function getGameByIdArray($id){
        $sql = "SELECT * from game WHERE id=".$id;
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getAvailableGameById($id){
        $sql = "SELECT * from game WHERE id=".$id."  AND release_date <= CURDATE()";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
    public function getGamesById($array){
        $sql = "SELECT * from game ";
        $first = true;
        foreach($array as $id => $amount){
            if($first){
                $sql.= "WHERE id=".$id;
                $first = false;
            } else{
                $sql .= " OR id=".$id;
            }
        }
        $query = $this->db->prepare($sql);
        $query->execute();
        if(count($array) == 1){
            return $query->fetchAll();
        } else{
            return $query->fetchAll();
        }
        
    }
    public function reduceStock($id, $amount){
        $sql = "UPDATE game SET sellable= sellable -".$amount." WHERE id=".$id;
        $query = $this->db->prepare($sql);
        $query->execute();
    }
    public function getSellableStock($id){
        $sql = "SELECT sellable from game WHERE id=".$id;
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
    public function getGameList(){
        $sql = "SELECT * from game";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function addGame($name, $platform, $price,$image,  $video, $descr, $release, $genre){
        $sql = "INSERT INTO "
                . "game(name, platform, price, release_date, image, video, description, genre, sellable) "
                . "VALUES('".$name."','".$platform."','".$price."','".$release."','".$image."','".$video."','".$descr."','".$genre."', 10)";
        $sql2 = "INSERT INTO `stock`(game_id, fysical) values(LAST_INSERT_ID(), 10)";
        $sql3 = "UPDATE `stock` SET location=LAST_INSERT_ID() WHERE id=LAST_INSERT_ID()";
        $query = $this->db->prepare($sql);
        $query2 = $this->db->prepare($sql2);
        $query3 = $this->db->prepare($sql3);
        $query->execute();
        $query2->execute();
        $query3->execute();
    }
    public function updateGame($id, $name, $platform, $price,  $video, $descr, $release, $genre,$image){
        if(!$image){
        $sql = "UPDATE game SET "
                . "name='".$name."', "
                . "platform='".$platform."', "
                . "price='".$price."', "
                . "release_date='".$release."', "
                . "video='".$video."', "
                . "description='".$descr."', "
                . "genre='".$genre."' "
                . "WHERE id=".$id;
        } else{
        $sql = "UPDATE game SET "
                . "name='".$name."', "
                . "platform='".$platform."', "
                . "price='".$price."', "
                . "release_date='".$release."', "
                . "image='".$image."', "
                . "video='".$video."', "
                . "description='".$descr."', "
                . "genre='".$genre."' "
                . "WHERE id=".$id;  
        }
        $query = $this->db->prepare($sql);
        $query->execute();
    }
    public function deleteGame($id){
    $sql = "DELETE FROM game
            WHERE id=".$id;
    $sql2 = "SELECT id FROM stock WHERE game_id=".$id;
    $query = $this->db->prepare($sql);
    $query2 = $this->db->prepare($sql);
    $query->execute();
    $query2->execute();
    $stocks = $query2->fetchAll(); 
    foreach($stocks as $stock){
        $sql3 = "DELETE FROM stock
                    WHERE id=".$stock['id'];
        $query3 = $this->db->prepare($sql);
        $query3->execute();
    }
    }
}

