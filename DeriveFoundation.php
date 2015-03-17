<?php
//derive foundation (debord style derive)
include_once("UConnect.php");
class DeriveFoundation{
	public function __construct($uid){
		$this->uid = $uid;
		$this->table_master="derives";
		$this->db = UConnect::doConnect();
		$this->sql = "SELECT txt_amt, img_amt, audio, d_path, d_id from $this->table_master where d_id = :uid;";
	}
	public function getDerive(){
		try{
			$q=$this->db->prepare($this->sql);
			$q->execute(array(':uid'=>$this->uid));
			$row = $q->fetchObject();
			$this->db=null;	//disconnect
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