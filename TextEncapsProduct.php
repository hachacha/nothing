<?php

//textproduct.php
include_once("Product.php");
class TextEncapsProduct implements Product{
	public function __construct($content){
		$this->content = $content;
		$this->final_text = array();
		$this->tag = null;
		$this->overarch_tag = array("marquee","h2","h3","h4","b","i","p");
		$this->marquee = array("scrollamount","direction");
		$this->m_direction = array("up","down","left","right");
		$this->position = array("relative","absolute","fixed");
		
	}
	public function parsePost($content){
		$alt = $content['author'];
		if($content['link_to']==0){
			$this->overarch_tag[rand(0,$this->sizeof($overarch_tag))];
		}
		else{
			$this->tag = "a";
			$this->href = "/".$alt."/".$content['link_to'];//'/author/folder/(caught by index)'
		}
	}
	public function genStyle(){
		//position
		$x_place = rand(0,500);//should be left Xpx
		$y_place = rand(0,800);//shoudl be top Ypx
		//color
		$color = "";
		for($q=0;$q<12;$q++){
			$temp_c = rand(0,15);	
			$color = $color.(string)$temp_c;
		}
		//choose other tag
		$tag = $this->overarch_tag(rand(0,6));
		//if marquee
		if($tag=="marquee"){
			$fin_dir = $this->m_direction[rand(0,4)];
			$fin_scroll = rand(0,40);
		}
		else{
			$size = rand(0,4);
		}


	}
	public function getProperties(){
		//here we need to get if the text is linkable,
		//pick some possible stylings.
		foreach ($this->content as $post) {//in the initial denoting text
			array_push($this->final_text, $this->parsePost($post));//push each piece to the array.
		}
		return json_encode($this->final_text);
	}
}

?>	