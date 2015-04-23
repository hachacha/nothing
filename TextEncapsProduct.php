<?php

include_once("Product.php");
// include_once("IStyle.php");
class TextEncapsProduct implements Product{
	public function __construct($content,$route){
		$this->html = array();
		$this->content = $content;
		$this->route = $route;
		$this->overarch_tag = ["marquee","h2","h3","h4","b","i","p"];
		$this->h_class = array('bem','bip','boom');
		$this->mdir = array("up","down","left","right");

	}
	public function genStyle($temp_tag,$link_text){

		//decide what rel should be.
		$class = $this->h_class[rand(0,count($this->h_class)-1)];
		$rel = "";
		if((rand(0,100))<Product::TXT_LINK_AMT){
			$rel = "rel='".(string)$this->route."'";
			$class = $class . " nother";
		}
		if($temp_tag=="marquee"){
			$fin_dir = $this->mdir[rand(0,3)];
			$fin_scroll = rand(0,40);
			$elem = "<".$temp_tag." direction=".$fin_dir." scrollamount=".$fin_scroll." class='".$class."' ".$rel.">".$link_text."</".$temp_tag.">";
			return $elem;
		}
		$elem = "<".$temp_tag." class='".$class."' ".$rel.">".$link_text."</".$temp_tag.">";//makka string
		return $elem;
	}//end gSfunc()

	public function parsePost($post){
		$link_text = $post['content'];
		if($post['link_to']=="0"){
			$temp_tag = $this->overarch_tag[rand(0,(sizeof($this->overarch_tag)-1))];
			$tag = $this->genStyle($temp_tag,$link_text);
		}
		else{
			$temp_tag = "a";
			$author = $post['author'];
			$href = "authors/" . $author."/".$post['link_to'];//'/author/folder/(caught by index)'
			$tag = "<".$temp_tag." style='z-index:99;' class='".$this->h_class[rand(0,2)]."' href='".$href."'>".$link_text."</".$temp_tag.">";//make a string
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