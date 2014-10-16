<?php

//textproduct.php
include_once("Product.php");
class TextProduct implements Product{
	private $mfgProduct;
	public function __construct($limit, $derive){
		$this->limit = $limit;
		$this->derive = $derive;
		$this->table = "text_media";
		$this->sql = "SELECT tm_id, t_content, author, link_to FROM $this->table WHERE d_id = :derive;";
		$this->rawReturn = array('txt'=>array());
		$this->db = UConnect::doConnect();
	}
	public function getProperties(){
		try{
			$q=$this->db->prepare($this->sql);
			$q->execute(array(':derive'=>$this->derive));
			$this->row = $q->fetchAll();
			$this->db=null;	//disconnect
			for($i=0;$i<$this->limit;$i++){
				$rand_int = rand(0,$this->limit);//make random int
				array_push($this->rawReturn['txt'], $this->row[$rand_int]);//push a part of the return randomly chosen to rawreturn.
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