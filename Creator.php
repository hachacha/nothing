<?php

//creator.php

abstract class Creator{
	public function __construct($limit,$derive){
		$this->limit=$limit;
		$this->derive=$derive;
	}
	protected abstract function factoryMethod($limit,$derive);//this should be same for both text and graphic

	public function startFactory(){
		$mfg = $this->factoryMethod($this->limit,$this->derive);
		return $mfg;
	}
}

?>