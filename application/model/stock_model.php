<?php

class Stock_model extends Model
{
    /**
     * @param object $db A PDO database connection
     */
    public function getStockByGameId($id){
        $sql = "SELECT * from stock WHERE game_id=".$id;
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function lowerFysical($location, $amount, $gameid){
        $sql = "UPDATE stock SET fysical=fysical -".$amount." WHERE location =".$location;
        $sql2 = "UPDATE `order_row` SET delivered=1 WHERE game_id=".$gameid;
        $query = $this->db->prepare($sql);
        $query2 = $this->db->prepare($sql2);
        $query->execute();
        $query2->execute();
    }
    public function setFysical($gameid, $sellable){
        $sql = "UPDATE stock SET fysical=".$sellable." WHERE game_id=".$gameid;
        $query = $this->db->prepare($sql);
        $query->execute();
    }
    public function getTotalStockByGameId($id){
        $sql = "SELECT sum(stock.fysical) as totaal
                FROM game 
                INNER JOIN stock on stock.game_id = game.id 
                WHERE game.id=".$id. "
                GROUP BY game.name, game.platform 
                ORDER BY game.name";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
}
