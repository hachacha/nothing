<?php


include_once("Encapsulator.php");
include_once("ImageEncapsProduct.php");

class ImageEncaps extends Encapsulator{
	protected function encapsFactory($content,$routes){
		$t_product = new ImageEncapsProduct($content,$routes);
		return($t_product->getProperties());
	}
}

?>