<?php
//abstract for creating html encapsulation

abstract class Encapsulator{
	public function __construct($content){ //figure out the type of array coming in.
		$this->content = $content;
	}
	protected abstract function encapsFactory($content);//this should be same for both text and graphic

	public function startEncaps(){
		$mfg = $this->encapsFactory($this->content);
		return $mfg;
	}
}
?>