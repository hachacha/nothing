<?php

include_once("DeriveFoundation.php"); //handles getting the first piste.

include_once("TextFactory.php");
include_once("TextEncaps.php");

include_once("ImageFactory.php");
include_once("ImageEncaps.php");

include_once("AudioFactory.php");
include_once("AudioEncaps.php");

class Client{
	
	private $Foundation;
	private $TextObject;
	private $ImageObject;
	private $AudioObject;

	public function __construct($uid){
		//make dbquery object to figure out how much new text and which new text.
		$this->Foundation = new DeriveFoundation($uid);
		$this->derive = $this->Foundation->getDerive();//deriveamt is the object containing how much to return
		// $this->TextObject = new TextFactory($this->derive->txt_amt, $this->derive->d_id);//pass amount of text objects in there
		$this->ImageObject = new ImageFactory($this->derive->img_amt,$this->derive->d_id);
		$this->AudioObject = new AudioFactory($this->derive->audio,$this->derive->d_id);

		// $this->t_array = $this->TextObject->startFactory();
		$this->i_array = $this->ImageObject->startFactory();
		$this->a_array = $this->AudioObject->startFactory();

		// $this->TEncaps = new TextEncaps($this->t_array,$this->derive->d_path);
		$this->IEncaps = new ImageEncaps($this->i_array,$this->derive->d_path);
		$this->AEncaps = new AudioEncaps($this->a_array,$this->derive->d_path);

		// echo "<pre>" . $this->TEncaps->startEncaps() . "</pre>";
		// $fin_text = $this->TEncaps->startEncaps();
		$fin_img = $this->IEncaps->startEncaps();
		$fin_audio = $this->AEncaps->startEncaps();

		$fin_all = array_merge(
			// $fin_text,
			$fin_img,
			$fin_audio
			);
		shuffle($fin_all);
		foreach ($fin_all as $out) {
			echo $out;
		}

	}
}
 
$worker=new Client($_POST['uid']);

?>