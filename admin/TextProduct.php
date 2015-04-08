<?php

//textproduct.php
include_once("Product.php");
class TextProduct implements Product{
	private $mfgProduct;
	public function __construct($limit, $route){//stick it to the class and make some basic db tweaks.
		$this->limit = $limit;
		$this->route = $route;
		$this->table = "text_media";
		$this->sql = "SELECT t_content, author, link_to FROM $this->table WHERE d_id = :derive;";
		$this->rawReturn = array();
		$this->db = UConnect::doConnect();
	}
	public function getProperties(){
		try{
			$q=$this->db->prepare($this->sql);
			$q->execute(array(':derive'=>$this->route));
			$this->row = $q->fetchAll(PDO::FETCH_ASSOC);//return associated array.
			$this->db=null;	//disconnect
			for($i=0;$i<$this->limit;$i++){//loop through to choose some random text.
				$rand_int = mt_rand(0,(sizeof($this->row)-1));//make random int
				array_push($this->rawReturn, $this->row[$rand_int]);//push a part of the return randomly chosen to rawreturn.
			}
			return $this->rawReturn;//return the selected few encapsulated in an array 'txt'
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