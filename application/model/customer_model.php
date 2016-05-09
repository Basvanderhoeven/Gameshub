<?php

class Customer_model extends Model
{
    /**
     * @param object $db A PDO database connection
     */
    public function checkCustomerId($id){
        $sql = "SELECT * FROM customer WHERE id=".$id;
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
    public function getCustomerById($id){
        $sql = "SELECT * FROM `customer` WHERE id=".$id;
        $query = $this->db->prepare($sql);
        $query->execute();
        $return = $query->fetch();
        return $return; 
    }
    public function checkEmail($mail){
        $sql = "SELECT * FROM customer WHERE email='".$mail."'";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
    public function insertCustomer($firstname, $infix, $surname, $phone, $email, $password){
        $rand_int = str_replace('.', '', microtime(true));
        $sql = "INSERT INTO customer(firstname,infix,surname,phone_number,email,barcode,`password`) VALUES('".$firstname."','".$infix."','".$surname."','".$phone."','".$email."','".$rand_int."','".$password."')";
        $query = $this->db->prepare($sql);
        $query->execute(); 
        return true;
    }
    public function getCustomerByOrderID($id){
        $sql = "SELECT customer.email FROM customer INNER JOIN `order` ON `order`.customer_id = customer.id  WHERE `order`.id=".$id;
        $query = $this->db->prepare($sql);
        $query->execute();
        $return = $query->fetch();
        return $return;
    }
    public function checkLogin($email, $password){
        $sql = "SELECT * FROM customer  WHERE email='".$email."' AND password='".$password."'";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
    public function getCustomerByEmail($email){
        $sql = "SELECT * FROM customer  WHERE email='".$email."'";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
}
