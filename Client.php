<?php
include_once("TextFactory.php");
class Client{
	public function __construct($uid){
		$this->someTextObject = new TextFactory();
		echo $this->someTextObject->startFactory()."<br />" . $uid;
	}
}
 
$worker=new Client($_POST['uid']);

?>