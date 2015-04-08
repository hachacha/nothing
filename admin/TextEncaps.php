<?php

include_once("Encapsulator.php");
include_once("TextEncapsProduct.php");

class TextEncaps extends Encapsulator{
	protected function encapsFactory($content,$route){
		$t_product = new TextEncapsProduct($content,$route);
		return($t_product->getProperties());
	}
}

?>