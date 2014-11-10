<?php

include_once("Product.php");
// include_once("IStyle.php");
class ImageEncapsProduct implements Product{
	public function __construct($content,$routes){
		$this->html = array();
		$this->content = $content;
		$this->overarch_tag = ["img","marquee"];
		$this->h_class = array('bem','bip','boom');
		$this->mdir = array("up","down","left","right");
		$this->routes = explode(',', $routes);//turn routes to string.
		$this->x = 0;

	}
	public function genStyle($temp_tag,$link_text){

		//decide what rel should be.
		$class = $this->h_class[rand(0,count($this->h_class)-1)];
		$rel = "";
		if((rand(0,10))>2){
			$rel = "rel='".(string)$this->routes[$this->x]."'";
			$class = $class . " nother";
		}
		
		//color
		// $color = "";
		// for($q=0;$q<12;$q++){
		// 	$temp_c = rand(0,15);	
		// 	$color = $color.(string)$temp_c;
		// }

		
		//if marquee
		
		if($temp_tag=="marquee"){
			$fin_dir = $this->mdir[rand(0,3)];
			$fin_scroll = rand(0,40);
			$elem = "<".$temp_tag." direction=".$fin_dir." scrollamount=".$fin_scroll." class='".$class."' ".$rel."><img src='".$link_text."'/></".$temp_tag.">";
			$this->x++;//increment x
			return $elem;
		}
		$elem = "<".$temp_tag." class='".$class."' ".$rel." src='".$link_text."' />";//makka string
		$this->x++;//increment x
		return $elem;
	}//end gSfunc()

	public function parsePost($post){
		$link_text = $post['i_path'];
		if($this->x > (count($this->routes)-1)){
			$this->x=0;
		}
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
		$this->x++;
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