<?php
//derive foundation (debord style derive)
include_once("UConnect.php");
include_once("Product.php");
class DeriveFoundation{
	public function __construct ($uid, $clicks) {
		$this->uid = $uid;
		$this->clicks = $clicks;
		$this->sql_values = '';
		if (Product::DERIVE_TYPE == "constant") {
			$this->table_master="derives";	
		}
		elseif (Product::DERIVE_TYPE == "set") {
			$this->table_master="derives_set";
			$this->long_path = true;
		}
		else
			return "TABLE NOT SET";
		if(Product::AUDIO_ON==1)
			$this->sql_values .= 'audio, ';
		if(Product::TXT_ON==1)
			$this->sql_values .= 'txt_amt, ';
		if(Product::IMG_ON==1)
			$this->sql_values .= 'img_amt, ';
		$this->sql_values .= 'd_path, d_id';
		
		$this->db = UConnect::doConnect();
		$this->sql = "SELECT ".$this->sql_values." from $this->table_master where d_id = :uid;";
	}
	public function getProperties () {
		try{
			$q=$this->db->prepare($this->sql);
			$q->execute(array(':uid'=>$this->uid));
			$row = $q->fetchObject();
			$this->db=null;	//disconnect
			if($this->long_path){
				$row->d_path = explode(",", $row->d_path);
				if(count($row->d_path)<$this->clicks)
					$this->clicks=0;
				$row->d_path = $row->d_path[$this->clicks];
			}
			return $row;
		}
		catch(PDOException $e) {
	  		echo $e->getMessage();
	  		$this->db=null;	//disconnect
	  		exit();
		}
	}
}
?>