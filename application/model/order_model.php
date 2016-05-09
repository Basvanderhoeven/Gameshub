<?php
class Order_model extends Model
{
    
    public function insertOrder($klantid, $paymethod){
        $rand_int = str_replace('.', '', microtime(true));
        $sql = "INSERT INTO `order`(barcode,customer_id, paymethod, date) VALUES(".$rand_int.",".$klantid.",'".$paymethod."',CURDATE())";
        $query = $this->db->prepare($sql);
        $query->execute();
        $sql2 = "SELECT id from `order` WHERE barcode=".$rand_int;
        $query2 = $this->db->prepare($sql2);
        $query2->execute();
        return $query2->fetch(); 
    }
    public function insertOrderRow($gameid, $amount, $order_id, $preorder){
        $sql = "INSERT INTO order_row(game_id,amount,order_id, preorder) VALUES(".$gameid.",".$amount.",".$order_id.", ".$preorder.")";
        $query = $this->db->prepare($sql);
        $query->execute();
    }
    public function getOrderrowsbyID($id){
        $sql = "SELECT * FROM order_row WHERE order_id=".$id;
        $query = $this->db->prepare($sql);
        $query->execute();
        $return = $query->fetchAll();
        return $return; 
    }
    public function getNotDeliveredOrderrowsbyID($id){
        $sql = "SELECT * FROM order_row WHERE order_id=".$id." AND delivered=0";
        $query = $this->db->prepare($sql);
        $query->execute();
        $return = $query->fetchAll();
        return $return; 
    }
    public function getAvailableRows($orderid){
        $sql = "SELECT * FROM `order_row` WHERE order_id=".$orderid." AND preorder=0";
        $query = $this->db->prepare($sql);
        $query->execute();
        $return = $query->fetchAll();
        return $return; 
    }
    public function getOrderById($id){
        $sql = "SELECT * FROM `order` WHERE id=".$id;
        $query = $this->db->prepare($sql);
        $query->execute();
        $return = $query->fetch();
        return $return; 
    }
    public function getOrderByBarcode($id){
        $sql = "SELECT * FROM `order` WHERE barcode=".$id." AND state=0";
        $query = $this->db->prepare($sql);
        $query->execute();
        $return = $query->fetch();
        if(!empty($return)){
            return $return;
        } 
    }
    public function getOrdersByCustomerId($id){
        $sql = "SELECT * FROM `order` WHERE customer_id=".$id;
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getAllOpenPreOrders(){
        $sql = "SELECT * FROM `order` "
                . "INNER JOIN order_row ON order_row.order_id = `order`.id "
                . "WHERE order_row.preorder = 1 AND order_row.delivered =0";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function resetPreorder($id){
        $sql = "UPDATE order_row SET preorder=0 WHERE id=".$id;
        $query = $this->db->prepare($sql);
        $query->execute();
    }
    
}
?>