<?php
	if(isset($_COOKIE['uid'])){
		header('location: /nothing');
	}
	else{
		echo 'enable your cookies man';
	}
