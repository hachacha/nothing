<?php

//audiofact
include_once("Creator.php");
include_once("AudioProduct.php");

class AudioFactory extends Creator{
	protected function factoryMethod($limit,$derive){
		$product=new AudioProduct($limit,$derive);
		return($product->getProperties());
	}
}

?>