<?php

class Post extends Controller
{
    public $userId;

    public function __construct() {
        parent::__construct();
        $this->userId = $this->session->_get('id');

        $this->load->model('post_model','post');
    }

    public function create($media) {
        if( !$this->userId) redirect(BASE_URL);
        //if(!$_POST) redirect(BASE_URL);
        $data['status'] = 'failed';
        $text = http_post('text');

        $post = $this->post->create($this->userId,$text,$media);
        if($post) {
            $this->load->model('account_model','account');
            $account_details = $this->account->getDetails($this->userId);
            $data['status'] = 'success';
            $data['text'] = $text;
            $data['account'] = $account_details;
        }
        //$this->load->view('inc/post',$data);
    }

    public function getAllPosts() {
        if( !$this->userId) {
            $return = Array("error" => "No posts to show");
        } else {
            $posts = $this->post->getAllPosts($this->userId);
            $return = $posts;
        }

        header('Content-Type: application/json');
        echo json_encode($return);

    }

    public function heartPost($postId,$rating) {
        if( !$this->userId) {
            $return = Array("error" => "");
        } else {
            $return["hearts"] = $this->post->heartPost($postId, $this->userId, $rating);
        }
        header('Content-Type: application/json');
        echo json_encode($return);
    }

    public function upload()
    {
        if (isset($_FILES['postImg']))
        {
            $this->upload->fix_file_array($_FILES['postImg']);

            $file = $_FILES['postImg'];

            $date                      = date('d M Y H:i:s');
            $mediaHash = strtotime($date).'_'.$this->userId.'_'.md5($file['name']);

            $img_dest                  = 'assets/images/uploads/'.$mediaHash;
            $this->upload->name        = $file['name'];
            $this->upload->destination = SITE_ROOT.$img_dest;
            $this->upload->tmp_name    = $file['tmp_name'];
            $formats                   = array('jpg','jpeg','gif','png');


            if( $this->upload->set_format($formats) == TRUE )
            {
                if( file_exists($this->upload->destination.'.'.$this->upload->ext) )
                {
                    //return 'Sorry! '.$file['name'].' already exists.';
                    return null;
                }
                else
                {
                    $image_file = $this->upload->destination.'.'.$this->upload->ext;
                    $img_dest .= '.'.$this->upload->ext;

                    if($this->upload->submit()) {

                        list($w_orig, $h_orig) = getimagesize($image_file);

                        $w_set = 500;
                        $h_set = 500;

                        if ($w_orig >= $w_set OR $h_orig >= $h_set) {
                            $this->upload->resize_image(
                                $image_file,
                                $image_file,
                                $w_set,
                                $h_set,
                                $this->upload->ext
                            );
                        }
                        $img = BASE_URL.$img_dest;
                        $media["hash"] = $mediaHash;
                        $media['ext'] = $this->upload->ext;
                        $this->create($media);
                        echo $img;
                    }
                }
            }
        }
    }

}