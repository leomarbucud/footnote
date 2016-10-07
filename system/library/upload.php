<?php

class Upload {
	
	public $name;
	public $type;
	public $size;
	public $destination;
	public $tmp_name;
	public $error;
	public $formats = array();
	public $ext;
	
	public function fix_file_array(&$files)
	{
		$names = array( 'name'=> 1,'type' => 1, 'tmp_name' => 1, 'error' => 1, 'size' => 1);
		
		foreach($files as $key => $part)
		{
			$key = (string)$key;
			if(isset($names[$key]) && is_array($part) )
			{
				foreach ($part as $position => $value)
				{
					$files[$position][$key] = $value;
				}
				
				unset($files[$key]);
			}
		}
	}

	public function set_format($array)
	{
		list($this->name, $this->ext) = explode('.',$this->name);
		if( in_array($this->ext,$array) )
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function submit()
	{
		if($this->error > 0)
		{
			return FALSE;
		}
		else
		{
			if( move_uploaded_file($this->tmp_name, $this->destination.'.'.$this->ext) )
			{
				//echo $this->name." uploaded. <br />";
				return TRUE;
			}
		}
	}

	public function resize_image($target, $newcopy, $w, $h, $ext)
	{
		list($w_orig, $h_orig) = getimagesize($target);

		$scale_ratio = $w_orig / $h_orig;

		if (($w / $h) > $scale_ratio)
		{
			$w = $h * $scale_ratio;
		}
		else
		{
			$h = $w / $scale_ratio;
		}

		$img = '';
		$ext = strtolower($ext);

		if ($ext == 'gif')
			$img = imagecreatefromgif($target);
		else if ($ext == 'png')
			$img = imagecreatefrompng($target);
		else
			$img = imagecreatefromjpeg($target);

		$tci = imagecreatetruecolor($w, $h);

		imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);

		if ($ext == 'gif')
			imagegif($tci, $newcopy);
		else if ($ext == 'png')
			imagepng($tci, $newcopy);
		else
			imagejpeg($tci, $newcopy, 84);
	}

	public function crop_image($target, $newcopy, $w, $h, $ext, $src_x = '', $src_y = '')
	{
		list($w_orig, $h_orig) = getimagesize($target);
		if ($src_x == '' AND $src_y == '')
		{
			$src_x = ($w_orig / 2) - ($w / 2);
			$src_y = ($h_orig / 2) - ($h / 2);
		}

		$img = '';
		$ext = strtolower($ext);

		if ($ext == 'gif')
			$img = imagecreatefromgif($target);
		else if ($ext == 'png')
			$img = imagecreatefrompng($target);
		else
			$img = imagecreatefromjpeg($target);

		$tci = imagecreatetruecolor($w, $h);

		imagecopyresampled($tci, $img, 0, 0, $src_x, $src_y, $w, $h, $w, $h);

		if ($ext == 'gif')
			imagegif($tci, $newcopy);
		else if ($ext == 'png')
			imagepng($tci, $newcopy);
		else
			imagejpeg($tci, $newcopy, 84);

	}

	
}