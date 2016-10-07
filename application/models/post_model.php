<?php

class Post_model extends Model {

    public function create($user_id, $text, $media) {
        $postId = $user_id.'_'.strtotime(date("Y-m-d H:i:s")).microtime(true);

        $this->db->query("INSERT INTO `posts` (`post_id`,`user_id`,`post_text`) VALUES (:id,:user_id,:text)",
            Array("id"=>$postId,"user_id"=>$user_id,"text"=>$text));

        $mediaHash = $media["hash"];
        $mediaExt = $media["ext"];
        $this->db->query("INSERT INTO `medias` (`post_id`,`media_hash`,`media_ext`) VALUES (:postId, :mediaHash, :mediaExt)", Array("postId" => $postId, "mediaHash" => $mediaHash, "mediaExt" => $mediaExt));
    }

    public function getByUserId($id,$num=10) {
        return $this->db->row("SELECT * FROM `posts` WHERE `user_id` = :id",Array("id"=>$id));
    }

    public function getAllPosts($userId) {
        $sql  = "SELECT ud.user_id, ud.firstname, ud.lastname, p.post_id, p.post_text, p.post_images, p.post_metas, p.post_created, ";
        $sql .= "(SELECT `media_hash` FROM `medias` as m WHERE m.post_id = p.post_id) as media_hash, ";
        $sql .= "(SELECT COUNT(hearts_id) FROM `hearts` as h WHERE h.post_id = p.post_id) as hearts, ";
        $sql .= "(SELECT COUNT(hearts_id) FROM `hearts` as h WHERE h.post_id = p.post_id AND h.hearts_rating = 1) as hearts_1, ";
        $sql .= "(SELECT COUNT(hearts_id) FROM `hearts` as h WHERE h.post_id = p.post_id AND h.hearts_rating = 2) as hearts_2, ";
        $sql .= "(SELECT COUNT(hearts_id) FROM `hearts` as h WHERE h.post_id = p.post_id AND h.hearts_rating = 3) as hearts_3, ";
        $sql .= "(SELECT COUNT(hearts_id) FROM `hearts` as h WHERE h.post_id = p.post_id AND h.hearts_rating = 4) as hearts_4, ";
        $sql .= "(SELECT COUNT(hearts_id) FROM `hearts` as h WHERE h.post_id = p.post_id AND h.hearts_rating = 5) as hearts_5, ";
        $sql .= "(SELECT CASE WHEN COUNT(*) > 0 THEN `hearts_rating` ELSE FALSE END FROM `hearts` as h WHERE h.post_id = p.post_id AND h.user_id = :userId) as hearts_given, ";
        $sql .= "CASE WHEN ud.user_id = :uId THEN TRUE ELSE FALSE END as my_post ";
        $sql .= "FROM `posts` as p LEFT JOIN `users` as u ";
        $sql .= "ON p.user_id = u.id ";
        $sql .= "INNER JOIN `user_details` ud ";
        $sql .= "ON ud.user_id = u.id ";
        $sql .= "ORDER BY p.post_created DESC";
//        echo $sql;
        return $this->db->rows($sql, Array("userId" => $userId, "uId" => $userId));
    }

    public function heartPost($postId, $userId, $rating) {
        $sql = "SELECT COUNT(*) FROM `hearts` WHERE `post_id` = :postId AND `user_id` = :userId";
        $isRated = $this->db->single($sql, Array("postId" => $postId, "userId" => $userId));
        if($isRated > 0) {
            $sql = "UPDATE `hearts` SET `hearts_rating` = :rating WHERE `post_id` = :postId AND `user_id` = :userId";
            $heartPost = $this->db->query($sql, Array("postId" => $postId, "userId" => $userId, "rating" => $rating));
        } else {
            $sql = "INSERT INTO `hearts` (`post_id`,`user_id`,`hearts_rating`) VALUES (:postId, :userId, :rating)";
            $heartPost = $this->db->query($sql, Array("postId" => $postId, "userId" => $userId, "rating" => $rating));
        }
        if ($heartPost) {
            $sql = "SELECT p.post_id, ";
            $sql .= "(SELECT COUNT(*) FROM `hearts` WHERE `post_id` = p.post_id AND hearts_rating = 1) as hearts_1, ";
            $sql .= "(SELECT COUNT(*) FROM `hearts` WHERE `post_id` = p.post_id AND hearts_rating = 2) as hearts_2, ";
            $sql .= "(SELECT COUNT(*) FROM `hearts` WHERE `post_id` = p.post_id AND hearts_rating = 3) as hearts_3, ";
            $sql .= "(SELECT COUNT(*) FROM `hearts` WHERE `post_id` = p.post_id AND hearts_rating = 4) as hearts_4, ";
            $sql .= "(SELECT COUNT(*) FROM `hearts` WHERE `post_id` = p.post_id AND hearts_rating = 5) as hearts_5 ";
            $sql .= "FROM posts as p ";
            $sql .= "WHERE p.post_id = :postId";

            return $this->db->row($sql, Array("postId" => $postId));
        }
        return false;
    }
}