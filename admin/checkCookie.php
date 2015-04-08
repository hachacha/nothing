<?php
	if(isset($_COOKIE['uid'])){
		header('location: main.php');
	}
	else{
		echo 'enable your cookies man';
	}
?>