<?php

class Admin extends Controller {

    public $data;
    
    public function __construct() {
        parent::__construct();
        if(!$this->session->_get('id')) redirect(BASE_URL);
        if(!$this->session->_get('level') > 0) redirect(BASE_URL);
        $this->data['data']['title'] = 'Welcome to Admin Panel!';
        $this->load->model('admin_model','admin');
    }

    public function index() {
        $this->load->view('admin/login', $this->data);
    }

    public function getUsers() {

        $return = $this->admin->getUsers();

        header('Content-Type: application/json');
        echo json_encode($return);
    }

    public function getUserById($id) {

        $return = $this->admin->getUserById($id);

        header('Content-Type: application/json');
        echo json_encode($return);
    }

    public function updateUserInfo($id) {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $info = Array(
            "firstname" => $request->firstname,
            "lastname" => $request->lastname,
            "middlename" => $request->middlename,
            "birthdate" => $request->birthdate,
            "address" => $request->address,
            "gender" => $request->gender->value,
            "bio" => $request->bio,
            "user_id" => $id
        );

        $update = $this->admin->updateUserInfo($info);

        if($update) {
            $return['status'] = 'success';
        } else {
            $return['status'] = 'fail';
        }

        header('Content-Type: application/json');
        echo json_encode($return);
    }

    public function updateUserCredentials() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        
        $info["username"] = $request->username;
        $info["email"] = $request->email;
        if(isset($request->password)) {
            if($request->password != '') {
                $info["password"] = password_hash($request->password . HASH_PASSWORD, PASSWORD_DEFAULT);
            }
        }
        $info["active"] = (string)$request->active;
        $info["id"] = $request->user_id;

        $update = $this->admin->updateUserCredentials($info);

        if($update) {
            $return['status'] = 'success';
        } else {
            $return['status'] = 'fail';
        }

        header('Content-Type: application/json');
        echo json_encode($return);
    }

    public function deleteUser() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $id = $request->user_id;

        $delete = $this->admin->deleteUser($id);

        if($delete) {
            $return['status'] = 'success';
        } else {
            $return['status'] = 'fail';
        }

        header('Content-Type: application/json');
        echo json_encode($return);
    }

    public function addUser() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $username = $request->username;
        $email = $request->email;
        $password = $request->password;
        $hash_password = password_hash($password. HASH_PASSWORD, PASSWORD_DEFAULT);

        $this->load->model('account_model', 'account');

        if($this->account->userExist($username)) {
            $return['status'] = 'failed';
            $return['message'] = 'User already exist';
        } else {
            $hash = md5( rand(0,1000) );
            $add = $this->account->create($username,$email,$hash_password,$hash);
            if($add) {
                $return['status'] = 'success';
            }
        }
        header('Content-Type: application/json');
        echo json_encode($return);
    }

}