<?php

class Media_model extends Model {

    public function getImage($hash) {
        $sql  = "SELECT `media_id`, `post_id`, `media_hash`, `media_ext`, `media_created` ";
        $sql .= "FROM `medias` ";
        $sql .= "WHERE `media_hash` = :hash";

        return $this->db->row($sql, Array("hash" => $hash));
    }

}