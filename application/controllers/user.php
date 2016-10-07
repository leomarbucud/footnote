<?php

class User extends Controller {

	private $salt = "^#$4%9f+1^p9)M@4M)V$";

	public function login() {
		$this->load->model('user_model', 'um');
		$result = $this->um->login();
		if ( $result != false)
		{
			foreach ($result as $key) 
			{
				foreach ($key as $field => $value) 
				{
					$this->session->_set($field, $value);									
				}
			}
			if (@post('keep-me'))
			{
				setcookie('USER_id', $this->session->_get('USER_id'), strtotime()+(3600*24*2) , '/');
			}
			redirect(BASE_URL);
		}

		else {
			$data['title'] = 'Login - Error';
			$data['error'] = '<div class="error">Login failed!</div>';
			$this->load->view('inc/header',$data);
			$this->load->view('login/login-form', $data);
			$this->load->view('inc/footer');
		}
	}

	public function register() {
		$this->load->model('user_model', 'm');
		$username = post('username');
		$email = post('email');
		$password = post('password');
		$password_v = post('password_v');
		$hash_password = password_hash($password. $this->salt, PASSWORD_DEFAULT);

		$is_password_match = password_verify($password_v, $hash_password);

		if ($is_password_match) {

		} else {

		}

	}

	public function logout()
	{	
		setcookie('USER_id','',time()-3600,'/');
		$this->session->_unset('USER_id');
		session_destroy();
		redirect(BASE_URL);
	}
}