<?php

//textproduct.php
include_once("Product.php");
class TextProduct implements Product{
	private $mfgProduct;
	public function __construct($limit, $derive){
		$this->limit = $limit;
		$this->derive = $derive;
		$this->table = "text_media";
		$this->sql = "SELECT t_content, author, link_to FROM $this->table WHERE d_id = :derive ORDER BY tm_id asc LIMIT :limiter";
		$this->db = UConnect::doConnect();
	}
	public function getProperties(){
		//Begin heredoc formating
		$this->mfgProduct=<<<MALI
		<br>noot noot motherfucker<br>
MALI;
		try{
			$q=$this->db->prepare($this->sql);
			$q->execute(array(':derive'=>$this->derive, ':limiter'=>$this->limit));
			$row = $q->fetchObject();
			$this->db=null;	//disconnect
			return $row;
		}
		catch(PDOException $e) {
	  		echo $e->getMessage();
	  		$this->db=null;	//disconnect
	  		exit();
		}
	return $this->mfgProduct;

	}
}

?>	