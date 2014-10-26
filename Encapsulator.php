<?php
//abstract for creating html encapsulation

abstract class Encapsulator{
	public function __construct($content,$route){ //figure out the type of array coming in.
		$this->content = $content;
		$this->route = $route;
	}
	protected abstract function encapsFactory($content,$route);//this should be same for both text and graphic

	public function startEncaps(){
		$mfg = $this->encapsFactory($this->content,$this->route);
		return $mfg;
	}
}
?>