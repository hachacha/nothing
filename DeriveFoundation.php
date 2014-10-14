<?php
//derive foundation (debord style derive)
include_once("UConnect.php");
class DeriveFoundation{
	public function __construct($uid){
		include_once("UConnect.php");
		$this->uid = $uid;
		$this->table_master="derives";
		$this->db = UConnect::doConnect();
		// var_dump($this->db);
		$sql = "SELECT txt_amt, img_amt, audio from $this->table_master where d_id = :uid;";
		try{
			$q=$this->db->prepare($sql);
			$q->execute(array(':uid'=>$this->uid));
			$row = $q->fetch();
			echo $row['txt_amt'] . " here is some thing from that other part";
		}
		catch(PDOException $e) {
	  		echo $e->getMessage();
	  		exit();
		}
		$this->db=null;	//disconnect
	}
}
?>