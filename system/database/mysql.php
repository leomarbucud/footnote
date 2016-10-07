<?php if ( ! defined('BASEPATH')) exit('Not allowed');

class MySQL {
	
	private $host;
	private $user;
	private $password;
	private $db;
	private $db_handler;
	public $query;
	public $result;
	public $data_array = array();

	public function __construct()
	{
		require APPPATH.'config/database.php';

		foreach ($db as $key => $value) 
		{
			$this->$key = $value;
		}

		$this->initialize_connection();
	}

	public function initialize_connection()
	{
		$this->db_handler = mysql_connect($this->host,$this->user,$this->password) or die('Unable to coonect database.');
		mysql_select_db($this->db, $this->db_handler) or die('Unable to select database.');
	}

	public function _query($query = '')
	{
		$this->query = $query;
	}

	public function _select($fields = '*')
	{
		if ($fields != '*')
		{
			$fields =  '`'.str_replace(',', '`, `', $fields).'`';
		}
		else
		{
			$fields = '*';
		}
		$this->query = 'SELECT '.$fields;
		return $this;
	}

	public function _from($table)
	{	
		if (preg_match("/[ ]/", $table))
		{
			$array = preg_split("/[ ]/", $table);
			$this->query .= ' FROM `'.$array[0].'` '.(count($array > 1) ? $array[1].' '.$array[2] : '');
		}
		else
			$this->query .= ' FROM `'.$table.'`';
		
		return $this;
	}

	public function _join($table, $type = 'INNER')
	{
		$array = preg_split("/[ ]/", $table);
		$this->query .= ' '.$type.' JOIN  `'.$array[0].'` '.(count($array > 1) ? $array[1].' '.$array[2] : '');
		return $this;
	}
	public function _on($table1, $table2)
	{
		$this->query .= ' ON '.$table1.'='.$table2;
		return $this;
	}
	public function _where($field = '', $value = '')
	{
		$this->query .= ' WHERE `'.$field.'` = \''. $this->escape($value).'\'';
		return $this;
	}

	public function _and($field = '', $value = '')
	{
		$this->query .= ' AND `'.$field.'` = \''. $this->escape($value).'\'';
		return $this;
	}

	public function _or($field = '', $value = '')
	{
		$this->query .= ' OR `'.$field.'` = \''. $this->escape($value).'\'';
		return $this;
	}

	public function _where_like($field = '', $value = '', $pos = '')
	{
		if ($pos == 'L')
		{
			$value = '%'.$this->escape($value);
		}
		elseif ($pos == 'R') 
		{
			$value = $this->escape($value).'%';
		}
		else
		{
			$value = '%'.$this->escape($value).'%';
		}
		$this->query .= ' WHERE `'.$field. '` LIKE \''.$value.'\'';

		return $this;
	}

	public function _and_like($field = '', $value = '', $pos = '')
	{
		if ($pos == 'L')
		{
			$value = '%'.$this->escape($value);
		}
		elseif ($pos == 'R') 
		{
			$value = $this->escape($value).'%';
		}
		else
		{
			$value = '%'.$this->escape($value).'%';
		}
		$this->query .= ' AND `'.$field. '` LIKE \''.$value.'\'';

		return $this;
	}

	public function _or_like($field = '', $value = '', $pos = '')
	{
		if ($pos == 'L')
		{
			$value = '%'.$this->escape($value);
		}
		elseif ($pos == '') 
		{
			$value = $this->escape($value).'%';
		}
		else
		{
			$value = '%'.$this->escape($value).'%';
		}
		$this->query .= ' OR `'.$field. '` LIKE \''.$value.'\'';

		return $this;
	}

	public function _limit($offset = 0, $count = '')
	{
		if ( $offset >= 0 AND ! empty($count))
		{
			$this->query .= ' LIMIT '.$offset.', '.$count;
			
		}
		elseif($count == '')
		{
			$this->query .= ' LIMIT '.$offset;
		}
		return $this;
	}

	public function _orderby($field, $type = 'ASC')
	{
		$this->query .= ' ORDER BY '.$field.' '.$type;
		return $this;
	}
	public function _insert($table = '', $data = array())
	{
		$this->query = 'INSERT INTO `'.$table.'`';
		$fields = array();
		$values = array();
		foreach($data as $field => $value)
		{
			$fields[] = '`'.$field.'`';
			$values[] = '\''.$this->escape($value).'\'';
		}
		$this->query .= '('.implode(',',$fields).') VALUES('.implode(', ',$values).')';
		return $this;
	}

	public function _update($table, $values = null, $where = null)
	{
		$total = 1;
		$count = count($values);
		$this->query = 'UPDATE `'.$table.'` SET ';

		foreach ($values as $key => $value)
		{
			if ($total != $count)
				$this->query .= '`'.$key ."` = '". $this->escape($value)."', ";
			else
				$this->query .= '`'.$key ."` = '". $this->escape($value)."' ";

			$total++;
		}

		$this->query .= 'WHERE ';

		foreach ($where as $key => $value) 
		{
			$this->query .= '`'.$key. "` = '".$this->escape($value)."'";
		}

		return $this;
	}

	public function _delete($table = '', $field = '', $value = '')
	{
		$this->query = 'DELETE FROM `'.$table.'` WHERE `'.$field.'` = \''.$this->escape($value).'\'';
		return $this;
	}

	public function _execute()
	{
		$this->result = mysql_query($this->query);
		if ( ! $this->result)
		{
			echo 'MySQL Error';//mysql_error($this->result);
			exit;
		}
		return $this->result;
	}

	private function escape($string)
	{
		return mysql_real_escape_string($string);
	}

	
	public function _num_rows()
	{
		return mysql_num_rows($this->_execute());
	}

	public function _return_result()
	{
		if ( ! $this->result)
		{
			echo 'Error on your query.';
			exit;
		}

		while ($data = mysql_fetch_assoc($this->result))
		{
			$this->data_array[] = $data;
		}
		return $this->data_array;
	}
}