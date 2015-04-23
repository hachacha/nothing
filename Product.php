<?php
//Product.php

interface Product{
	//link_amt should be two digit number between 0 and 10 denoting how often you want to link to other things (20==20%)
	//no audio because there should only be 1 audio per page, yes?
	const IMG_LINK_AMT = 100;
	const TXT_LINK_AMT = 0;
	
	const AUDIO_ON = 0;//0 is no audio. 1 is yes audio
	const IMG_ON = 1;
	const TXT_ON = 1;

	const DERIVE_TYPE = "set";//derive is done in "set" or "constant" format.
	
	public function getProperties();
}

?>