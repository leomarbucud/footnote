<html>
<head>
	<title>404 Not Found</title>
	<style type="text/css">
		.error-box{
			font-family: 'tahoma', verdana;
			margin: auto;
			border: 1px solid #dfdfdf;
			/*padding: 10px;*/
			margin-top: 30px;
			max-width: 600px;
			overflow: hidden;
		}
		.error-heading{
			padding: 10px;
			margin-top: 0px;
			border-bottom: 1px solid #dfdfdf;
			width: 100%;
		}
		p{
			padding: 0 10px 0 10px;
		}
		p a{
			text-decoration: none;
			color: #00a;
		}
		p.footer{
			text-align: right;
			margin-bottom: 1px;
			border-top: 1px solid #dfdfdf;
			color: #dfddfd;
		}
	</style>
</head>
<body>

	<div class="error-box">
		<h1 class="error-heading">404 Not found</h1>
		<p>
			<a href="javascript: history.go(-1);"><< Go back.</a>
		</p>
		<p><small><em>Date: <?=date('m/d/Y');?> Time: <?=time('h:m:s');?></em></small></p>
		<p class="footer"><small><em><a href="<?=$_SERVER['SERVER_NAME']?>"><?=$_SERVER['SERVER_NAME']?></a></em></small></p>
	</div>

</body>
</html>