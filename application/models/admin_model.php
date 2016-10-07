<?php

class Admin_model extends Model {

    public function getUsers() {

        $sql =  "SELECT ";
        $sql .= "ud.user_id, ";
        $sql .= "ud.firstname, ";
        $sql .= "ud.middlename, ";
        $sql .= "ud.lastname, ";
        $sql .= "ud.address, ";
        $sql .= "ud.birthdate, ";
        $sql .= "ud.gender, ";
        $sql .= "ud.bio, ";
        $sql .= "u.username, ";
        $sql .= "u.email, ";
        $sql .= "u.active ";
        $sql .= "FROM ";
        $sql .= "`user_details` as ud ";
        $sql .= "INNER JOIN ";
        $sql .= "`users` as u ";
        $sql .= "ON ";
        $sql .= "u.id = ud.user_id";
        $return = $this->db->rows($sql);

        return $return;
    }

    public function getUserById($id) {

        $sql =  "SELECT ";
        $sql .= "ud.user_id, ";
        $sql .= "ud.firstname, ";
        $sql .= "ud.middlename, ";
        $sql .= "ud.lastname, ";
        $sql .= "ud.address, ";
        $sql .= "ud.birthdate, ";
        $sql .= "ud.gender, ";
        $sql .= "ud.bio, ";
        $sql .= "u.username, ";
        $sql .= "u.email, ";
        $sql .= "u.active ";
        $sql .= "FROM ";
        $sql .= "`user_details` as ud ";
        $sql .= "INNER JOIN ";
        $sql .= "`users` as u ";
        $sql .= "ON ";
        $sql .= "u.id = ud.user_id ";
        $sql .= "WHERE u.id = :id";
        $return = $this->db->row($sql, Array("id" => $id));

        return $return;
    }

    public function updateUserInfo($info) {
        $sql =  "UPDATE ";
        $sql .= "`user_details` ";
        $sql .= "SET ";
        $sql .= "`firstname` = :firstname, ";
        $sql .= "`lastname` = :lastname, ";
        $sql .= "`middlename` = :middlename, ";
        $sql .= "`birthdate` = :birthdate, ";
        $sql .= "`address` = :address, ";
        $sql .= "`gender` = :gender, ";
        $sql .= "`bio` = :bio ";
        $sql .= "WHERE ";
        $sql .= "`user_id` = :user_id";
        return $this->db->query($sql, $info);
    }

    public function updateUserCredentials($info) {
        $sql =  "UPDATE ";
        $sql .= "`users` ";
        $sql .= "SET ";
        $sql .= "`username` = :username, ";
        $sql .= "`email` = :email, ";
        if(isset($info["password"])) {
            $sql .= "`password` = :password, ";
        }
        $sql .= "`active` = :active ";
        $sql .= "WHERE ";
        $sql .= "`id` = :id";
        return $this->db->query($sql, $info);
    }

    public function deleteUser($id) {
        $sql1 =  "DELETE ";
        $sql1 .= "FROM ";
        $sql1 .= "`users` ";
        $sql1 .= "WHERE ";
        $sql1 .= "`id` = :id";

        $sql2 =  "DELETE ";
        $sql2 .= "FROM ";
        $sql2 .= "`user_details` ";
        $sql2 .= "WHERE ";
        $sql2 .= "`user_id` = :id";
        try {
            $this->db->beginTransaction();
            $this->db->query($sql1, Array("id" => $id));
            $this->db->query($sql2, Array("id" => $id));
            $this->db->executeTransaction();

            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

}