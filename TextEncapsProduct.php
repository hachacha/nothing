<?php

include_once("Product.php");
include_once("IStyle.php");
class TextEncapsProduct implements Product{
	public function __construct($content){

		$this->html = array();
		$this->content = $content;
		$this->overarch_tag = ["marquee","h2","h3","h4","b","i","p"];
		$this->h_class = array('bem','bip','boom');
		$this->mdir = array("up","down","left","right");

	}
	public function genStyle($temp_tag,$link_text){
		//color
		$color = "";
		for($q=0;$q<12;$q++){
			$temp_c = rand(0,15);	
			$color = $color.(string)$temp_c;
		}
		//if marquee
		$class = $this->h_class[rand(0,2)];
		if($temp_tag=="marquee"){
			$fin_dir = $this->mdir[rand(0,3)];
			$fin_scroll = rand(0,40);
			return "<".$temp_tag." direction=".$fin_dir." scrollamount=".$fin_scroll." class='".$class."'>".$link_text."</".$temp_tag.">";
		}

		return "<".$temp_tag." class='".$class."'>".$link_text."</".$temp_tag.">";//makka string
	}//end gSfunc()

	public function parsePost($post){
		$link_text = $post['t_content'];
		if($post['link_to']=="0"){
			$temp_tag = $this->overarch_tag[rand(0,(sizeof($this->overarch_tag)-1))];
			$tag = $this->genStyle($temp_tag,$link_text);
			
		}
		else{
			$temp_tag = "a";
			$author = $post['author'];
			$href = "hatmen/" . $author."/".$post['link_to'];//'/author/folder/(caught by index)'
			$tag = "<".$temp_tag." style='z-index:99;' href='".$href."'>".$link_text."</".$temp_tag.">";//make a string
		}
		return $tag;
	}

	public function getProperties(){
		//here we need to get if the text is linkable,
		//pick some possible stylings.
		foreach ($this->content as $post) {//in the initial denoting text
			array_push($this->html, $this->parsePost($post));//push each piece to the array.
		}
		return $this->html;
	}
}

?>	