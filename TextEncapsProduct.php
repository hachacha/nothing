<?php

//textproduct.php
include_once("Product.php");
class TextEncapsProduct implements Product{
	public function __construct($content){
		$this->content = $content;
	}
	public function getProperties(){
		return "ort ort ort im in tep!";
	}
}

?>	