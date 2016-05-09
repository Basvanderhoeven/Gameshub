<?php
class Coworker_model extends Model
{
    public function getCoworker($username, $password){
        $sql = "SELECT * from coworker WHERE name='".$username."' and password='".$password."' AND role=1";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getAdmin($username, $password){
        $sql = "SELECT * from coworker WHERE name='".$username."' and password='".$password."' AND role=2";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
}