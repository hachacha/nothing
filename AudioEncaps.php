<?php

include_once("Encapsulator.php");
include_once("AudioEncapsProduct.php");

class AudioEncaps extends Encapsulator{
	protected function encapsFactory($content,$routes){
		$a_product = new AudioEncapsProduct($content,$routes);
		return($a_product->getProperties());
	}
}

?>