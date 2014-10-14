<?php
	if(!isset($_COOKIE['uid']) || $_COOKIE['uid']>5){//if cookie not set...
		$new_id = mt_rand(1,5);
		setcookie("uid", $new_id);//set user id
		setcookie("clicks",0);
		header("location: checkCookie.php");
		// var_dump(get_defined_vars());
	}
?>
<html>
<head>
<title>
	&lt;o&plus;&lt;
</title>
</head>
<body>

	<center><a href="main.php"><img src="houseImages/datfukkendog.jpg"/></a></center>

</body>
</html>