<?php

include_once("Product.php");
// include_once("IStyle.php");
class ImageEncapsProduct implements Product{
	public function __construct($content,$route){
		$this->html = array();
		$this->route = $route;
		$this->content = $content;
		$this->overarch_tag = ["img","marquee"];
		$this->h_class = array('bem','bip','boom','bab','bbo','boc','bmx','bunga','bew');
		$this->mdir = array("up","down","left","right");
	}
	public function makeGray () {
		$high = 30;
		$low = 12;
		$mod = rand($high, $low);
		$gray = $mod*8;
		return "rgb(".$gray.",".$gray.",".$gray.");";
	}
	public function genStyle ($temp_tag,$link_text) {
		//decide what rel should be.
		$img_class = $this->h_class[rand(0,count($this->h_class)-1)];
		$div_class = $this->h_class[rand(0,count($this->h_class)-1)];
		$rel = "";
		if((rand(0,100))<Product::IMG_LINK_AMT){
		//changed this to always get a new path!
			$rel = "rel='". $this->route ."'";
			$img_class = $img_class . " nother";
		}
		$gray = $this->makeGray();

		//if marquee
		
		if($temp_tag=="marquee"){
			$fin_dir = $this->mdir[rand(0,3)];
			$fin_scroll = rand(1,20);
			$elem = "<".$temp_tag." direction=".$fin_dir." scrollamount=".$fin_scroll." class='".$img_class."' style='".$gray."' ".$rel."><img src='".$link_text."'/></".$temp_tag.">";
			return $elem;
		}
		$elem = "<div class='".$div_class."' style='background-color:".$gray."' ><".$temp_tag." class='".$img_class."' ".$rel." src='".$link_text."' /> </div>";//makka string
		return $elem;
	}//end gSfunc()

	public function parsePost($post){
		$link_text = $post['file_path'];
		if($post['link_to']=="0"){
			$temp_tag = $this->overarch_tag[rand(0,(sizeof($this->overarch_tag)-1))];
			$tag = $this->genStyle($temp_tag,$link_text);
		}
		else{
			$temp_tag = "a";
			$author = $post['author'];
			$href = "authors/" . $author."/".$post['link_to'];//'/author/folder/(caught by index)'
			$tag = "<".$temp_tag." style='z-index:99;' class='".$this->h_class[rand(0,2)]."' href='".$href."'><img src='".$link_text."'/></".$temp_tag.">";//make a string
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