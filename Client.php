<?php

include_once("DeriveFoundation.php"); //handles checking database for shizz.
include_once("TextFactory.php");


class Client{
	private $Foundation;
	private $TextObject;
	public function __construct($uid){
		//make dbquery object to figure out how much new text and which new text.
		$this->Foundation = new DeriveFoundation($uid);
		$this->r = $this->Foundation->getDerive();//deriveamt is the object containing how much to return
		$this->TextObject = new TextFactory($this->r->txt_amt, $this->r->d_id);//pass amount of text objects in there
		print_r($this->TextObject->startFactory());
		//$this->ImgObject = new ImgFactory($r->img_amt, $r->d_id);

	}
}
 
$worker=new Client($_POST['uid']);

?>