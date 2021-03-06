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
		if(isset($this->derive->txt_amt))
			if($this->derive->txt_amt > 0){
				$this->TextObject = new TextFactory($this->derive->txt_amt, $this->derive->d_path);//pass amount of text objects in there
				$this->t_array = $this->TextObject->startFactory();
				if($this->t_array!=false){
					$this->TEncaps = new TextEncaps($this->t_array,$this->derive->d_path, $clicks);
					$fin_text = $this->TEncaps->startEncaps();
				}
			}
		if(isset($this->derive->img_amt))
			if($this->derive->img_amt > 0){
				$this->ImageObject = new ImageFactory($this->derive->img_amt,$this->derive->d_path);
				$this->i_array = $this->ImageObject->startFactory();
				if($this->i_array!=false){
					$this->IEncaps = new ImageEncaps($this->i_array,$this->derive->d_path, $clicks);
					$fin_img = $this->IEncaps->startEncaps();	
				}
			}
		if(isset($this->derive->audio))
			if($this->derive->audio > 0){
				$this->AudioObject = new AudioFactory($this->derive->audio,$this->derive->d_path);
				$this->a_array = $this->AudioObject->startFactory();
				if($this->a_array!=false){
					$this->AEncaps = new AudioEncaps($this->a_array,$this->derive->d_path,$clicks);
					$fin_audio = $this->AEncaps->startEncaps();
				}
			}
		
		if($clicks == count($this->derive->d_path)){
			$zero_count = array('<script>count=0;</script>');
		}
		else{
			$zero_count=array("");
		}

		$fin_all = array_merge(
			$fin_text,
			$fin_img,
			$fin_audio,
			$zero_count
			);
		shuffle($fin_all);
		foreach ($fin_all as $out) {
			echo $out;
		}

	}
}
 
$worker=new Client($_POST['uid'],$_POST['iters']);

?>