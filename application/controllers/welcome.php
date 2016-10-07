<?php

class Welcome extends Controller {

	public $data;

	public function __construct()
	{
		// call parent constructor
		parent::__construct();

		$this->data['title'] = "Welcome";

		$this->load->view('templates/header',$this->data);

	}

	public function test() {
		$ip = $this->geolocation->getClientIP();
        echo $ip.'<br/>';
		$this->geolocation->request($ip);
		//var_dump($this->geolocation->location_data);
        echo 'I am at : '.$this->geolocation->location_data['city'];
        echo '<br/>';
    
	}

	public function index()
	{
		if($this->session->_get('id')) redirect(BASE_URL.'account');
		$this->load->model('welcome_model');
		//$this->welcome_model->index();
		$this->load->view('welcome',$this->data);
		//$this->load->view('login/login-form',$this->data);

		$this->load->view('templates/footer');

	}

	public function __destruct()
	{
		$this->load->view('templates/footer');
	}

}