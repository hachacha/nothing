<?php

//textfactory
include_once("Creator.php");
include_once("TextProduct.php");

class TextFactory extends Creator{
	protected function factoryMethod($limit,$derive){
		$product=new TextProduct($limit,$derive);
		return($product->getProperties());
	}
}

?>