<?php

class User_model extends Model {

	public function login()
	{
		$email = post('email');
		$password = post('password');
	
		if (isset($_COOKIE['USER_id']))
		{
			$id = $_COOKIE['USER_id'];
			$this->db->_select()
					->_from('users')
					->_where('USER_id',$id)
					->_limit('1')
					->_execute();
		}
		else
		{
			$this->mysql->_select()
					->_from('tbl_users')
					->_where('USER_email',$email)
					->_and('USER_password', $password)
					->_limit('1')
					->_execute();
		}
		
		$row = $this->mysql->_return_result();
		$numrows = $this->mysql->_num_rows();
		if ($numrows == 1)
			return $row;
		else
			return false;
	}

	public function post($img = '')
	{
		$text   = htmlentities(post('write')).$img;
		$userId = $this->session->_get('USER_id');
		$date   = date('d M Y H:i:s');
		$data   = array(
				'POST_id'   => '',
				'USER_id'   => $userId,
				'POST_text' => $text,
				'POST_date' => $date
			);
		$this->mysql->_insert('tbl_posts', $data)->_execute();
		return $this->load_post();
	}

	public function load($offset, $count)
	{
		$this->mysql->_select()
					->_from('tbl_posts as p')
					->_join('tbl_users as u', 'LEFT')
					->_on('p.USER_id','u.USER_id')
					->_orderby('p.POST_id', 'DESC')
					->_limit($offset, $count)
					->_execute();
		$row = $this->mysql->_return_result();
		//echo $this->mysql->query;
		return $row;
	}


	public function load_post()
	{
		$this->mysql->_select()
					->_from('tbl_posts as p')
					->_join('tbl_users as u', 'LEFT')
					->_on('p.USER_id','u.USER_id')
					->_orderby('POST_id','DESC')
					->_limit('1')
					->_execute();
		$row = $this->mysql->_return_result();
		
		return $row;
	}

	public function comment()
	{
		$text    = htmlentities(post('txt-comment'));
		$post_id = post('post-id');
		$date    = date('d M Y H:i:s');
		$data    = array(
				'COM_id'   => '',
				'POST_id'  => $post_id,
				'USER_id'  => $this->session->_get('USER_id'),
				'COM_text' => $text,
				'COM_date' => $date
			);
		$this->mysql->_insert('tbl_comments', $data)->_execute();
		return $this->load_comment($post_id);
	}

	public function load_comment($post_id)
	{
		$this->mysql->_select()
					->_from('tbl_comments as c')
					->_join('tbl_users as u')
					->_on('c.USER_id','u.USER_id')
					->_where('POST_id',$post_id)
					->_orderby('COM_id','DESC')
					->_limit('1')
					->_execute();
		$row = $this->mysql->_return_result();
		return $row;
	}

	public function load_comments($post_id)
	{
		$this->mysql->_select()
					->_from('tbl_comments as c')
					->_join('tbl_users as u')
					->_on('c.USER_id','u.USER_id')
					->_where('POST_id',$post_id)
					->_orderby('COM_id','ASC')
					->_execute();
		$row =  $this->mysql->_return_result();
		return $row;		
	}

	public function like_post($post_id)
	{
		$userId = $this->session->_get('USER_id');
		$data   = array(
				'id'		=> '',
				'POST_id'   => $post_id,
				'USER_id'   => $userId
			);
		$this->mysql->_insert('tbl_postlikes', $data)->_execute();
		return $this->mysql->query;
	}

	public function unlike_post($post_id)
	{
		$this->mysql->_delete('tbl_postlikes','POST_id',$post_id)
					->_and('USER_id', $this->session->_get('USER_id'))
					->_execute();
		return $this->mysql->query;
	}

	public function check_like_post($post_id)
	{
		$this->mysql->_select()
					->_from('tbl_postlikes')
					->_where('POST_id',$post_id)
					->_and('USER_id',$this->session->_get('USER_id'))
					->_execute();
		$count = $this->mysql->_num_rows();
		if ($count <= 0)
			return false;
		else
			return true;
	}

	public function count_like_post($post_id)
	{
		$this->mysql->_select()
					->_from('tbl_postlikes')
					->_where('POST_id',$post_id)
					->_execute();
		$count = $this->mysql->_num_rows();
		$row   = $this->mysql->_return_result();
		if ($count <= 0)
			return false;
		else
			return $c_r = array($count, $row);
	}
}