<?php

include_once("DeriveFoundation.php"); //handles checking database for shizz.

include_once("TextFactory.php");
include_once("TextEncaps.php");

class Client{
	private $Foundation;
	private $TextObject;
	public function __construct($uid){
		//make dbquery object to figure out how much new text and which new text.
		$this->Foundation = new DeriveFoundation($uid);
		$this->derive = $this->Foundation->getDerive();//deriveamt is the object containing how much to return
		$this->TextObject = new TextFactory($this->derive->txt_amt, $this->derive->d_id);//pass amount of text objects in there
		$this->t_array = $this->TextObject->startFactory();
		$this->TEncaps = new TextEncaps($this->t_array,$this->derive->d_path);
		// echo "<pre>" . $this->TEncaps->startEncaps() . "</pre>";
		$fin_text = $this->TEncaps->startEncaps();

		foreach ($fin_text as $out) {
			echo $out;
		}
		//$this->ImgObject = new ImgFactory($r->img_amt, $r->d_id);

	}
}
 
$worker=new Client($_POST['uid']);

?>