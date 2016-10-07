<?php

class Post extends Controller {

	public function load_post()
	{
		$this->load->model('user_model','um');
		$this->um->load_post();

	}
	public function load_posts($offset, $count)
	{
		$this->load->model('user_model','um');
		$row = $this->um->load($offset, $count);
		echo $this->mysql->query;
		if ( ! count($row) == 0)
		{
			foreach ($row as $key)
			{
				$data['id']          = $key['POST_id'];
				$data['text']        = nl2br(preg_replace("/(\\r\\n){2,}/", "<br />", $key['POST_text']));
				$data['date']        = $key['POST_date'];
				$data['name']        = ucwords($key['USER_firstname'].' '.$key['USER_middlename'].' '.$key['USER_lastname']);
				$data['profile_pic'] = $key['USER_profile_pic'];
				$this->load->view('inc/posts', $data);
			}
		}
		else
		{
			echo '0';
		}
	}
	public function write()
	{
		$img = $this->upload();

		$this->load->model('user_model','um');
		$row = $this->um->post($img);

		foreach ($row as $key)
		{
			$data['id']          = $key['POST_id'];
			$data['text']        = nl2br(preg_replace("/(\\r\\n){2,}/", "<br />", $key['POST_text']));
			$data['date']        = $key['POST_date'];
			$data['name']        = ucwords($key['USER_firstname'].' '.$key['USER_middlename'].' '.$key['USER_lastname']);
			$data['profile_pic'] = $key['USER_profile_pic'];

			$this->load->view('inc/posts', $data);
		}
	}

	public function upload()
	{
		if (isset($_FILES['my-img']))
		{
			$this->upload->fix_file_array($_FILES['my-img']);

			foreach ($_FILES['my-img'] as $position => $file)
			{
				$date                      = date('d M Y H:i:s');
				$this->upload->name        = $file['name'];
				$this->upload->destination = 'assets/images/uploads/'.strtotime($date).'_'.$this->session->_get('id').'_'.md5($file['name']);
				$this->upload->tmp_name    = $file['tmp_name'];
				$formats                   = array('jpg','jpeg','gif','png');

				

				if( $this->upload->set_format($formats) == TRUE )
				{
					if( file_exists($this->upload->destination.'.'.$this->upload->ext) )
					{
						//return 'Sorry! '.$file['name'].' already exists.';
						return null;;
					}
					else
					{
						$image_file = $this->upload->destination.'.'.$this->upload->ext;
						$this->upload->submit();

						list($w_orig, $h_orig) = getimagesize($image_file);


						$w_set = 500;
						$h_set = 500;

						if ($w_orig >= $w_set OR $h_orig >= $h_set)
						{
							$this->upload->resize_image(
								$image_file,
								$image_file,
								$w_set,
								$h_set,
								$this->upload->ext
							);

							$img = '<div class="upload-cont" ><img src="'.$image_file.'" /></div> ';
						}
						else
						{
							$img = '<div class="upload-cont" ><img src="'.$image_file.'" /></div> ';
						}						
						return $img;
					}
				}
				else
				{
					return null;
				}
			}
		}
	}
	public function comment()
	{
		$this->load->model('user_model','um');		
		$row = $this->um->comment();
		
		foreach ($row as $key)
		{
			$data['id']          = $key['COM_id'];
			$data['comment']     = nl2br($key['COM_text']);
			$data['name']        = ucwords($key['USER_firstname'].' '.$key['USER_middlename'].' '.$key['USER_lastname']);
			$data['profile_pic'] = $key['USER_profile_pic'];
			$data['date']        = $key['COM_date'];

			$this->load->view('inc/comments', $data);
		}
	}

	public function load_comments($post_id)
	{
		$this->load->model('user_model','um');		
		$row = $this->um->load_comments($post_id);
		$count = 1;
		foreach ($row as $key)
		{
			if ($count <= 5)
			{
				$data['id']          = $key['COM_id'];
				$data['comment']     = nl2br($key['COM_text']);
				$data['name']        = ucwords($key['USER_firstname'].' '.$key['USER_middlename'].' '.$key['USER_lastname']);
				$data['profile_pic'] = $key['USER_profile_pic'];
				$data['date']        = $key['COM_date'];

				$this->load->view('inc/comments', $data);
			}

			$count++;
		}
		if ($count >= 6)
			echo '<div class="view-all-comments">
					<a href="javascript: load_all_comments('.$post_id.')"> View all comments </a>
				</div>';
	}

	public function load_all_comments($post_id)
	{
		$this->load->model('user_model','um');		
		$row = $this->um->load_comments($post_id);
		foreach ($row as $key)
		{
			$data['id']          = $key['COM_id'];
			$data['comment']     = nl2br($key['COM_text']);
			$data['name']        = ucwords($key['USER_firstname'].' '.$key['USER_middlename'].' '.$key['USER_lastname']);
			$data['profile_pic'] = $key['USER_profile_pic'];
			$data['date']        = $key['COM_date'];

			$this->load->view('inc/comments', $data);
		}
	}

	public function like_post($post_id)
	{
		$this->load->model('user_model','um');		
		echo $this->um->like_post($post_id);
	}

	public function unlike_post($post_id)
	{
		$this->load->model('user_model','um');		
		echo $this->um->unlike_post($post_id);
	}

	public function check_like_post($post_id)
	{
		$this->load->model('user_model','um');		
		if ($this->um->check_like_post($post_id))
			echo 'true';
		else
			echo 'false';
	}

	public function count_like_post($post_id)
	{
		$this->load->model('user_model','um');
		$c_r   = $this->um->count_like_post($post_id);
		$count = $c_r[0];
		$row   = $c_r[1];
		$text  = '';
		$you   = '';
		// echo count($row);
		if (count($row) >= 1)
		{
			foreach ($row as $key)
			{
				if ($key['USER_id'] == $this->session->_get('USER_id'))
				{
					$you .= 'You ';
				}
			}
			if ($count > 1 AND preg_match("/^You/", $you))
			{
				$text .= $you.'and '.($count - 1).' '.(($count - 1 >= 2) ? ' others like this' : ' other like this');
			}
			elseif ($count == 1 AND preg_match("/^You/", $you))
			{
				$text .= $you.'like this';
			}
			else
			{
				$text .= '<a href="#">'.$count.' '. (($count <= 1) ? 'person </a>likes' : 'persons </a>like').' this';

			}
		}
		echo $text;
	}
}