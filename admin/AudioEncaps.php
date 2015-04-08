<?php

include_once("Encapsulator.php");
include_once("AudioEncapsProduct.php");

class AudioEncaps extends Encapsulator{
	protected function encapsFactory($content,$route){
		$a_product = new AudioEncapsProduct($content,$route);
		return($a_product->getProperties());
	}
}

?>