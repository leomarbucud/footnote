<?php

class Name_model extends Model {

	public function show()
	{
		//echo $this->mysql->num_rows('Select * from items');
		$this->mysql->_select()
					->_from('tbl_post')
					//->_where('id','1')
					->_execute();
		$row = $this->mysql->_return_result();

		foreach ($row as $key) 
		{
				echo $key['POST_text'].'<br>';
		}
	}

	public function insert()
	{
		$data = array(
				'id' => '',
				'item_name' => 'Interview'
			);
		$this->mysql->_insert('items', $data)->_execute();
	}

	public function delete()
	{
		$this->mysql->_delete('items','id','24');
		echo $this->mysql->query;
	}

	public function update()
	{
		$this->mysql->_update('items',array('name'=>'honey','id'=>'2'), array('id'=>'2'));
		echo $this->mysql->query;
	}
}