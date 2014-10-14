<?php

include_once("DeriveFoundation.php"); //handles checking database for shizz.
include_once("TextFactory.php");


class Client{
	public function __construct($uid){
		//make dbquery object to figure out how much new text and which new text.
		$this->Foundation = new DeriveFoundation($uid);
		$this->TextObject = new TextFactory();
		echo $this->TextObject->startFactory()."<br />" . $uid;
	}
}
 
$worker=new Client($_POST['uid']);

?>