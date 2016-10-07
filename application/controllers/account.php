<?php

class Account extends Controller {

    public $data;

    public $userId = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('account_model', 'account');
        $this->userId = $this->session->_get('id');
        if( !$this->userId) return;

        $account_details = $this->account->getDetails($this->userId);
        $this->data['data']['title'] = 'Footnote';
        $this->data['data']['account'] = $account_details;
    }

    public function index() {
        if( !$this->session->_get('id')) redirect(BASE_URL);

        //$this->load->model('post_model','post');
        //$data['data']['posts'] = $this->post->getByUserId($user_id);
        $this->load->view('account/account_details', $this->data);

    }

    public function getDetails() {

        $return = Array();
        if( !$this->userId) {
            $return = Array("error" => "user not logged in.");
        } else {
            $userData = $this->account->getDetails($this->userId);
            unset($userData['password']);
            $return = $userData;
        }


        header('Content-Type: application/json');
        echo json_encode($return);

    }

    public function login() {
        if(!$_POST) redirect(BASE_URL);
        $username = http_post('username');
        $password = http_post('password');
        $remember = http_post('remember');
        $login = $this->account->login($username, $password);
        if($login['login']) {
            if($login['data']['active'] == 0 ) {
                $this->data['data']['title'] = 'Footnote';
                $this->load->view('account/account_inactive',$this->data);
                exit;
            }
            foreach ($login['data'] as $key => $value) {
                $this->session->_set($key, $value);
            }
            if($remember) {
                setcookie('remember', $username, strtotime("now") + (3600 * 24 * 2), '/');
            }
            if($login['data']['level'] > 0 ) {
                redirect(BASE_URL . 'admin');
            } else {
                redirect(BASE_URL . 'account');
            }
        } else {
            redirect(BASE_URL.'?error=1');
        }

    }

    public function register() {
        //if(!$_POST) redirect(BASE_URL);
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $username = $request->username;
        $email = $request->email;
        $password = $request->password;
        $password_v = $request->password_v;
        $hash_password = password_hash($password. HASH_PASSWORD, PASSWORD_DEFAULT);

        if($this->account->userExist($username)) {
            $return['status'] = 'failed';
            $return['message'] = 'User already exist';
        } else {
            if (password_verify($password_v. HASH_PASSWORD, $hash_password)) {
                $hash = md5( rand(0,1000) );
                $create = $this->account->create($username,$email,$hash_password,$hash);
                if($create) {
                    $return['message'] = 'Your account has been made. Please verify it by clicking the activation link that has been send to your email.';
                    $return['status'] = 'success';
                    $this->sendVerificationMail($username,$email,$hash);
                    //echo $msg;
                } else {
                    //echo 'oops something went wrong';
                    $return['status'] = 'failed';
                }
            } else {
                //return with error
//                echo 'password did not match';
                $return['status'] = 'failed';
            }
        }

        header('Content-Type: application/json');
        echo json_encode($return);

    }

    public function verify() {

        $email = http_getParam('email');
        $hash = http_getParam('hash');

        if($email && $hash) {

            $verify = $this->account->verify($email,$hash);

            if($verify) {
                $this->account->activate($email,$hash);
                echo 'Account has been activated';
                echo '<br/>';
                echo 'Redirecting...';
                echo '<script>setTimeout(function(){window.location.href="'.BASE_URL.'";},3000);</script>';
            } else {
                echo '<div class="statusmsg">The url is either invalid or you already have activated your account.</div>';
            }

        } else {
            redirect(BASE_URL);
        }

    }

    public function logout() {
        setcookie('remember','',time()-3600,'/');
        $this->session->_unset('id');
        session_destroy();
        redirect(BASE_URL);
    }

    public function sendVerificationMail($username, $email, $hash) {

        $mail = $this->email->mailer; // create a new object

        $mail->SetFrom("noreply@footnote.com");
        $mail->Subject = "Verify Email";

        $body = "Thanks for signing up!<br>";
        $body .= "Your account has been created, you can login after you have activated your account by clicking the url below.<br/>";
        $body .= "Please click this link to activate your account: ".SITE_DOMAIN.BASE_URL."/account/verify/?email={$email}&hash={$hash}";

        $mail->Body = $body;
        $mail->AddAddress($email);

        if (!$mail->Send()) {
            $msg =  "Mailer Error: " . $mail->ErrorInfo;
        } else {
            $msg =  "Message has been sent";
        }

        return $msg;

    }
    //[GET]
    public function edit() {
        $user_id = $this->session->_get('id');
        if( !$user_id) redirect(BASE_URL);

        $this->data['data']['title'] = 'Edit Account';

        $this->load->view('account/account_edit',$this->data);

    }
    //[POST]
    public function update() {
        $user_id = $this->session->_get('id');
        if( !$user_id) $return['status'] = 'fail';

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
            "user_id" => $user_id
        );

        $update = $this->account->update($info);

        if($update) {
            $return['status'] = 'success';
        } else {
            $return['status'] = 'fail';
        }

        header('Content-Type: application/json');
        echo json_encode($return);

    }

    //[POST]
    public function updateSecurity() {
        $user_id = $this->session->_get('id');
        if( !$user_id) $return['status'] = 'fail';

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $password_c = $request->password_c;
        $password = $request->password;
        $password_v = $request->password_v;

        $hash_password = password_hash($password. HASH_PASSWORD, PASSWORD_DEFAULT);

        $info = Array(
            "password" => $hash_password,
            "id" => $user_id
        );

        $return['status'] = null;

        if (password_verify($password_c. HASH_PASSWORD, $this->data['data']['account']['password'])) {

            if (password_verify($password_v. HASH_PASSWORD, $hash_password)) {
                $updateSecurity = $this->account->updateSecurity($info);    
                if($updateSecurity)
                    $return['status'] = 'success';
            }
        } else {
            $return['status'] = 'fail';
            $return['message'] = 'Incorrect current password';
        }

        header('Content-Type: application/json');
        echo json_encode($return);
    }
}