<?php
	if(!isset($_COOKIE['uid']) || $_COOKIE['uid']>8 || $_COOKIE['uid'] < 1){//if cookie not set...
		$new_id = mt_rand(1,8);
		setcookie("uid", $new_id);//set user id
		setcookie("clicks",0);
		header("location: checkCookie.php");
	}
?>
<html>
<head>
<title>
	&lt;o&plus;&lt;
</title>
</head>
<body>

	<center><a href="main.php"><img src="IMG_9843.jpg"/></a></center>
<div style='display:none;'><audio src='order.m4a' controls loop autoplay></audio></div>
</body>
</html>