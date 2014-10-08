<?php
include_once("TextFactory.php");
class Client{
	public function __construct(){
		$this->someTextObject = new TextFactory();
		echo $this->someTextObject->startFactory()."<br />";
	}
}
$worker=new Client();

?>