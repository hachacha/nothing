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

	public function __construct($uid, $clicks=0){
		//make dbquery object to figure out how much new text and which new text.
		$this->foundation = new DeriveFoundation($uid,$clicks);
		$this->derive = $this->foundation->getProperties();//deriveamt is the object containing how much to return
		$fin_text = array();
		$fin_img = array();
		$fin_audio = array();

		if($this->derive->txt_amt > 0 && isset($this->derive->txt_amt)){
			$this->TextObject = new TextFactory($this->derive->txt_amt, $this->derive->d_path);//pass amount of text objects in there
			$this->t_array = $this->TextObject->startFactory();
			$this->TEncaps = new TextEncaps($this->t_array,$this->derive->d_path, $clicks);
			$fin_text = $this->TEncaps->startEncaps();
		}
			
		if($this->derive->img_amt > 0 && isset($this->derive->img_amt)){
			$this->ImageObject = new ImageFactory($this->derive->img_amt,$this->derive->d_path);
			$this->i_array = $this->ImageObject->startFactory();
			$this->IEncaps = new ImageEncaps($this->i_array,$this->derive->d_path, $clicks);
			$fin_img = $this->IEncaps->startEncaps();
		}
		if($this->derive->audio > 0 && isset($this->derive->audio)){
			$this->AudioObject = new AudioFactory($this->derive->audio,$this->derive->d_path);
			$this->a_array = $this->AudioObject->startFactory();
			$this->AEncaps = new AudioEncaps($this->a_array,$this->derive->d_path,$clicks);
			$fin_audio = $this->AEncaps->startEncaps();
		}
		
		if($clicks == count($this->derive->d_path)){
			$zeroCount = array('<script>count=0;</script>');
		}
		else{
			$zeroCount="";
		}

		$fin_all = array_merge(
			$fin_text,
			$fin_img,
			$fin_audio
			);
		shuffle($fin_all);
		foreach ($fin_all as $out) {
			echo $out;
		}

	}
}
 
$worker=new Client($_POST['uid'],$_POST['iters']);

?>