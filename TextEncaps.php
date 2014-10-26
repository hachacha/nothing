<?php

//textfactory
include_once("Encapsulator.php");
include_once("TextEncapsProduct.php");

class TextEncaps extends Encapsulator{
	protected function encapsFactory($content,$routes){
		$t_product = new TextEncapsProduct($content,$routes);
		return($t_product->getProperties());
	}
}

?>