<?php

//imageproduct.php
include_once("Product.php");
class ImageProduct implements Product{
	private $mfgProduct;
	public function __construct($limit, $route){//stick it to the class and make some basic db tweaks.
		$this->limit = $limit;
		$this->route = $route;
		$this->table = "img_media";
		$this->sql = "SELECT content, author, link_to FROM $this->table WHERE d_id = :derive";
		$this->rawReturn = array();
		$this->db = UConnect::doConnect();
	}
	public function getProperties(){
		try{
			$q=$this->db->prepare($this->sql);
			$q->execute(array(':derive'=>$this->route));
			$this->row = $q->fetchAll(PDO::FETCH_ASSOC);//return associated array.
			$this->db=null;	//disconnect
			$this->returned_amt = sizeof($this->row);
			if(sizeof($this->returned_amt)==0)
				return False;
			if($this->limit > $this->returned_amt)
				$this->limit = $this->returned_amt;
			shuffle($this->row);//shuffle that shit
			for($i=0;$i<$this->limit;$i++){//loop through to choose some random img.
				array_push($this->rawReturn, $this->row[$i]);//push a part of the return shuffled row.
			}
			return $this->rawReturn;//return the selected few encapsulated in an array 'txt'
		}
		catch(PDOException $e) {
			mail("jkiritharan@gmail.com", "your db fucked up", $e->getMessage());
	  		echo $e->getMessage();
	  		$this->db=null;	//disconnect
	  		exit();
		}
		return $this->mfgProduct;

	}
}

?>	