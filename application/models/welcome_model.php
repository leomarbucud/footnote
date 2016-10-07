<?php

class Welcome_Model extends Model {

    public function index() {
        echo 'i am a model.';
        try {
            $date = date("Y-m-d H:i:s");
            $params = Array("date_added" => $date);
            $this->db->beginTransaction();
            //$this->db->query("Insert Into items (date_added) Values (:date_added)",$params);
            echo "<pre>";
            var_dump($this->db->query("SELECT * FROM items"));
            $this->db->executeTransaction();
            //echo $this->db->lastInsertId("item_id");
        } catch(PDOException $e) {
            $this->db->rollBack();
            echo $e;
        }
    }

}