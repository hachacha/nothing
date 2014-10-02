<?php

//textproduct.php
include_once("Product.php");
class TextProduct implements Product{
	private $mfgProduct;

	public function getProperties(){
		//Begin heredoc formating
		$this->mfgProduct=<<<MALI
		<br>noot noot motherfucker<br>
MALI;
return $this->mfgProduct;

	}
}

?>	