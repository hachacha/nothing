<?php
//Product.php

interface Product{
	//link_amt should be two digit number between 0 and 10 denoting how often you want to link to other things (20==20%)
	const IMG_LINK_AMT = 100;
	const TXT_LINK_AMT = 0;
	
	public function getProperties();
}

?>