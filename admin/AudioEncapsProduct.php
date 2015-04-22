<?php

include_once("Product.php");
class AudioEncapsProduct implements Product{
	public function __construct($content){
		$this->content = $content;
	}
	public function parsePost($post){
		$path = $post[0]['content'];
		$path = htmlentities($path, ENT_QUOTES);
		$tag = array("<div style='display:none;'><audio src='".$path."' controls loop autoplay></audio></div>");
		return $tag;
	}

	public function getProperties(){
		return $this->parsePost($this->content);
	}
}

?>	
