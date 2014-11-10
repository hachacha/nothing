<?php

include_once("DeriveFoundation.php"); //handles checking database for shizz.

include_once("TextFactory.php");
include_once("TextEncaps.php");

include_once("ImageFactory.php");
include_once("ImageEncaps.php");

class Client{
	private $Foundation;
	private $TextObject;
	public function __construct($uid){
		//make dbquery object to figure out how much new text and which new text.
		$this->Foundation = new DeriveFoundation($uid);
		$this->derive = $this->Foundation->getDerive();//deriveamt is the object containing how much to return
		$this->TextObject = new TextFactory($this->derive->txt_amt, $this->derive->d_id);//pass amount of text objects in there
		$this->ImageObject = new ImageFactory($this->derive->txt_amt,$this->derive->d_id);
		
		$this->t_array = $this->TextObject->startFactory();
		$this->i_array = $this->ImageObject->startFactory();

		$this->TEncaps = new TextEncaps($this->t_array,$this->derive->d_path);
		$this->IEncaps = new ImageEncaps($this->i_array,$this->derive->d_path);

		// echo "<pre>" . $this->TEncaps->startEncaps() . "</pre>";
		$fin_text = $this->TEncaps->startEncaps();
		$fin_img = $this->IEncaps->startEncaps();

		$fin_all = array_merge($fin_text,$fin_img);

		foreach ($fin_all as $out) {
			echo $out;
		}
		//$this->ImgObject = new ImgFactory($r->img_amt, $r->d_id);

	}
}
 
$worker=new Client($_POST['uid']);

?>