<html>
<head>
	<title>403 - Forbidden Directory</title>
</head>
<body>
	<h3>Access to this directory is forbidden.</h3>
	<?php

		/**
		regular expression example
		*/
		$email  = 'leomarbucud@yahoo.com.ph';

		if (preg_match_all("/^([a-z0-9_\-]+)*@([a-z]+\.)+([a-z]{3})+(\.[a-z]{2,3})?$/i", $email, $array))
			echo "Match";

		echo('<pre>');
		var_dump($array);
		echo('</pre>');
	?>
</body>
</html>