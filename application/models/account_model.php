<?php

class Account_Model extends Model {

    public function login($login, $password) {

    	$return = Array();

		if(EMAIL_LOGIN) {
			$cols = $this->db->row("SELECT * FROM `users` WHERE `username` = :u OR `email` = :e", Array("u" => $login, "e" => $login));
		} else {
			$cols = $this->db->row("SELECT * FROM `users` WHERE `username` = :login", Array("login" => $login));
		}

		if(empty($cols)) {
			$return['login'] = false;
		} else {
			$us_id = $cols['id'];
			$us_pass = $cols['password'];
			//$status = $cols['attempt'];

			if(password_verify($password. HASH_PASSWORD, $us_pass)) {
				$return['login'] = true;
				$return['data'] = $cols;
			} else {
				$return['login'] = false;
			}
		}
    	return $return;
    }

	public function getDetails($user_id) {

		$data= $this->db->row("SELECT u.username, u.password, u.level, ud.user_id, ud.lastname, ud.firstname, ud.middlename, ud.address, ud.birthdate, ud.gender, ud.bio FROM `users` as u INNER JOIN `user_details` as ud ON u.id = ud.user_id WHERE u.id = :id", Array("id" => $user_id));

		return $data;
	}

	public function userExist($identification) {

		return $this->db->single("SELECT COUNT(1) FROM `users` WHERE `username` = :u OR `email` = :e", Array("u"=>$identification, "e" => $identification)) == "0" ? false : true;
	}

	public function create($username,$email,$hash_password,$hash) {

		$created =  $this->db->query("INSERT INTO `users` (`username`, `password`,`email`,`hash`) VALUES(:username, :password, :email,:hash)",
			Array("username" => $username, "password" => $hash_password, "email" => $email,"hash" => $hash));
        $user_id = $this->db->lastInsertId();

        $this->db->query("INSERT INTO `user_details` (`user_id`) VALUES (:userid)", Array("userid"=>$user_id));

        return $created;

	}

	public function verify($email, $hash) {
		return $this->db->single("SELECT COUNT(1) FROM `users` WHERE `email` = :e AND `hash` = :h AND `active` = 0", Array("e"=>$email, "h" => $hash)) == "0" ? false : true;
	}

	public function activate($email, $hash) {
		return $this->db->query("UPDATE `users` SET `active` = 1 WHERE `email` = :e AND `hash` = :h AND `active` = 0 ", Array("e"=>$email, "h" => $hash));
	}

    public function update($info) {
        return $this->db->query("UPDATE `user_details` SET 
                                    `firstname` = :firstname, 
                                    `lastname` = :lastname, 
                                    `middlename` = :middlename,
                                    `birthdate` = :birthdate,
                                    `address` = :address,
                                    `gender` = :gender,
                                    `bio` = :bio
                                WHERE `user_id` = :user_id", $info);
    }

    public function updateSecurity($info) {
        return $this->db->query("UPDATE `users` SET 
                                    `password` = :password
                                WHERE `id` = :id", $info);
    }
}