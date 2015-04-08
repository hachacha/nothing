<?php

//textfactory
include_once("Creator.php");
include_once("ImageProduct.php");

class ImageFactory extends Creator{
	protected function factoryMethod($limit,$derive){
		$product=new ImageProduct($limit,$derive);
		return($product->getProperties());
	}
}

?>