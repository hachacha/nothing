<?php

//edit interface shows 
include_once("../UConnect.php");
include_once("../Product.php");
class AdminEdit {
	public function seekDerives () {//function to get possible derives.
		if(Product::DERIVE_TYPE=="set"){
			$table = "derives_set";
		}
		elseif(Product::DERIVE_TYPE=="constant"){
			$this->table = "derives";
		}
		$this->sql = "SELECT * FROM $table;";
		$this->db = UConnect::doConnect();
		$q=$this->db->prepare($this->sql);
		$q->execute();
		$d = $q->fetchAll(PDO::FETCH_ASSOC);
		$this->derives = $d;
		return $this->derives;
	}

	public function updateRow($val,$table){
		if($val['link_to']=="")
			$val['link_to'] = 0;
		$this->sql = "UPDATE $table SET d_id = :d_id, content = :content, author = :author, link_to = :link_to WHERE ".$val['media_id']." = :id";
		try{
			$this->db = UConnect::doConnect();
			$q=$this->db->prepare($this->sql);
			$q->bindParam(':d_id', $val['d_id'],PDO::PARAM_INT);
			$q->bindParam(':content',$val['content'],PDO::PARAM_STR);
			$q->bindParam(':author',$val['author'],PDO::PARAM_STR);
			$q->bindParam(':link_to',$val['link_to'],PDO::PARAM_STR);
			$q->bindParam(':id',$val['c_id'],PDO::PARAM_INT);
			// $q->execute(array(':d_id'=>(int)$val['d_id'],':content'=>$val['content'],':author'=>$val['author'],':link_to'=>$val['link_to']));
			$q->execute();
			$this->db=null;//make null to close conn.
			return TRUE;
		}
		catch(PDOException $e) {
  			echo $e->getMessage();
  			$this->db=null;//make null to close conn.
  			die();
  			exit();
		}
		$this->db=null;//make null to close conn.

	}
	public function updateDeriveRow($val,$table){
		if($val['link_to']=="")
			$val['link_to'] = 0;
		$this->sql = "UPDATE $table SET txt_amt = :txt_amt, img_amt = :img_amt, audio = :audio, d_path = :d_path WHERE ".$val['media_id']." = :id";
		try{
			$this->db = UConnect::doConnect();
			$q=$this->db->prepare($this->sql);
			$q->bindParam(':txt_amt', $val['txt_amt'],PDO::PARAM_INT);
			$q->bindParam(':img_amt',$val['img_amt'],PDO::PARAM_INT);
			$q->bindParam(':audio',$val['audio'],PDO::PARAM_INT);
			$q->bindParam(':d_path',$val['d_path'],PDO::PARAM_STR);
			$q->bindParam(':id',$val['c_id'],PDO::PARAM_INT);
			// $q->execute(array(':d_id'=>(int)$val['d_id'],':content'=>$val['content'],':author'=>$val['author'],':link_to'=>$val['link_to']));
			$q->execute();
			$this->db=null;//make null to close conn.
			return TRUE;
		}
		catch(PDOException $e) {
  			echo $e->getMessage();
  			$this->db=null;//make null to close conn.
  			die();
  			exit();
		}
		$this->db=null;//make null to close conn.

	}
	public function insertNew($val,$table){
		$this->sql = "INSERT INTO $table (d_id, content, author, link_to) VALUES (:d_id, :content, :author, :link_to)";
		try{
			$this->db = UConnect::doConnect();
			$q=$this->db->prepare($this->sql);
			$q->bindParam(':d_id', $val['d_id'],PDO::PARAM_INT);
			$q->bindParam(':content',$val['content'],PDO::PARAM_STR);
			$q->bindParam(':author',$val['author'],PDO::PARAM_STR);
			$q->bindParam(':link_to',$val['link_to'],PDO::PARAM_STR);
			// $q->execute(array(':d_id'=>(int)$val['d_id'],':content'=>$val['content'],':author'=>$val['author'],':link_to'=>$val['link_to']));
			$q->execute();
			$this->db=null;//make null to close conn.
			return TRUE;
		}
		catch(PDOException $e) {
  			echo $e->getMessage();
  			$this->db=null;//make null to close conn.
  			die();
  			exit();
		}
		$this->db=null;//make null to close conn.

	}
	public function insertNewDerive($val,$table){
		$this->sql = "INSERT INTO $table (txt_amt, img_amt, audio, d_path) VALUES (:txt_amt, :img_amt, :audio, :d_path)";
		try{
			$this->db = UConnect::doConnect();
			$q=$this->db->prepare($this->sql);
			$q->bindParam(':txt_amt', $val['txt_amt'],PDO::PARAM_INT);
			$q->bindParam(':img_amt',$val['img_amt'],PDO::PARAM_INT);
			$q->bindParam(':audio',$val['audio'],PDO::PARAM_INT);
			$q->bindParam(':d_path',$val['d_path'],PDO::PARAM_STR);
			$q->execute();
			$this->db=null;//make null to close conn.
			return TRUE;
		}
		catch(PDOException $e) {
  			echo $e->getMessage();
  			$this->db=null;//make null to close conn.
  			die();
  			exit();
		}
		$this->db=null;//make null to close conn.

	}
	public function deleteMe($var,$table){
		$this->sql = "DELETE FROM $table WHERE ".$var['media_id']." = :id;";
		try{
			$this->db = UConnect::doConnect();
			$q=$this->db->prepare($this->sql);
			$q->bindParam(':id',$var['id'],PDO::PARAM_INT);
			$q->execute();
			$this->db=null;//make null to close conn.
			return TRUE;
		}
		catch(PDOException $e) {
  			echo $e->getMessage();
  			$this->db=null;//make null to close conn.
  			die();
  			exit();
		}	
	}
	public function evalNew($row,$type){
		switch ($type) {
			case 'text':
				if($this->insertNew($row,'text_media')==TRUE){
					return "was successful. <a href='#' onclick='window.location.reload();'>refresh</a>";
				}
				break;
			case 'audio':
				# code...
				break;
			case 'image':
				if($this->insertNew($row,'img_media')==TRUE){
					return "was successful. <a href='#' onclick='window.location.reload();'>refresh</a>";
				}
				break;							
			case 'derives':
				if($this->insertNewDerive($row,'derives')==TRUE){
					return "was successful. <a href='#' onclick='window.location.reload();'>refresh</a>";
				}
				break;
			case 'derives_set':
				if($this->insertNewDerive($row,'derives_set')==TRUE){
					return "was successful. <a href='#' onclick='window.location.reload();'>refresh</a>";
				}
				break;
			default:
				# code...
				break;
		}
	}
		public function evalUp($row,$type){
		switch ($type) {
			case 'text':
				if($this->updateRow($row,'text_media')==TRUE){
					return "was successful. <a href='#' onclick='window.location.reload();'>refresh</a>";
				}
				break;
			case 'audio':
				# code...
				break;
			case 'image':
				if($this->updateRow($row,'img_media')==TRUE){
					return "was successful. <a href='#' onclick='window.location.reload();'>refresh</a>";
				}
				break;
			case 'derives':
				if($this->updateDeriveRow($row,'derives')==TRUE){
					return "was successful. <a href='#' onclick='window.location.reload();'>refresh</a>";
				}
				break;
			case 'derives_set':
				if($this->updateDeriveRow($row,'derives_set')==TRUE){
					return "was successful. <a href='#' onclick='window.location.reload();'>refresh</a>";
				}
				break;							
			
			default:
				# code...
				break;
		}
	}

	public function makeHTML($row,$media_id){
		if($media_id!="d_id"){
			$derives = AdminEdit::seekDerives();
			for($i=0;$i<count($row);$i++){
				// echo $i . " " . $this->row[$i]['d_id'] . ' ||||';
				$this->formInsides .= "<form id='u".$row[$i][$media_id]."' class='updateForm'>";
				$this->formInsides .= "<input type='hidden' name='media_id' value='".$media_id."'></input>";
				$this->formInsides .= '<input type="hidden" name="q_type" value="update"></input>';
				$this->formInsides .= '<input type="hidden" name="c_id" value="'.$row[$i][$media_id].'"></input>';
				$this->formInsides .= "<div class='ret'> <p><span  style='background-color:yellow;'>".$row[$i][$media_id]."</span></p>";
				$this->formInsides .= "<label for='d_id'>derive</label>";
				$this->formInsides .= "<select name='d_id'>";
				foreach ($derives as $key) {
					$this->formInsides .= ($key['d_id'] == $row[$i]['d_id'] ? "<option selected='selected'>".$row[$i]['d_id']."</option>" : "<option>".$row[$i]['d_id']."</option>");
				}
				$this->formInsides .= "</select>";
				$this->formInsides .= "<label for='author'> author</label>";
				$this->formInsides .= "<input type='textarea' name='author' value='".$row[$i]['author']."'></input>";
				$this->formInsides .= "<br />";
				$this->formInsides .= "<label for='link_to'> link</label>";
				$this->formInsides .= "<input type='textarea' name='link_to' value='".$row[$i]['link_to']."'></input>";
				$this->formInsides .= "<label for='content'> content</label>";
				$this->formInsides .= "<input type='textarea' style='height:40px;max-height:40px;' rows='55' cols='50' name='content' value='".$row[$i]['content']."'></input>";
				$this->formInsides .= ($media_id == 'i_id' ? "<div class='preImg'><img src='../".$row[$i]['content']."'/></div>" : '');
				$this->formInsides .= "<br /> <input type='submit' value='submit changes for id:".$row[$i][$media_id]."'></input>";
				$this->formInsides .= "<button class='deleteButton' id='".$row[$i][$media_id]."'>delete this!</button>";
				$this->formInsides .="<br /></div><br /></form>";
				$this->formInsides .="<div id='returnu".$row[$i][$media_id]."'></div>";
			}
			return $this->formInsides;
		}
		else{
			for($i=0;$i<count($row);$i++){
				// echo $i . " " . $this->row[$i]['d_id'] . ' ||||';
				$this->formInsides .= "<form id='u".$row[$i][$media_id]."' class='updateForm'>";
				$this->formInsides .= "<input type='hidden' name='media_id' value='".$media_id."'></input>";
				$this->formInsides .= '<input type="hidden" name="q_type" value="update"></input>';
				$this->formInsides .= '<input type="hidden" name="c_id" value="'.$row[$i][$media_id].'"></input>';
				$this->formInsides .= "<div class='ret'> <p><span  style='background-color:yellow;'>".$row[$i][$media_id]."</span></p>";
				$this->formInsides .= "<label for='txt_amt'>txt amount</label>";
				$this->formInsides .= "<input type='textarea' name='txt_amt' value='".$row[$i]['txt_amt']."'></input>";
				$this->formInsides .= "<label for='img_amt'> img amount</label>";
				$this->formInsides .= "<input type='textarea' name='img_amt' value='".$row[$i]['img_amt']."'></input>";
				$this->formInsides .= "<br />";
				$this->formInsides .= "<label for='audio'> audio</label>";
				$this->formInsides .= "<input type='textarea' name='audio' value='".$row[$i]['audio']."'></input>";
				$this->formInsides .= "<label for='d_path'> d_path </label>";
				$this->formInsides .= "<input type='textarea' style='height:40px;max-height:40px;' rows='55' cols='50' name='d_path' value='".$row[$i]['d_path']."'></input>";
				$this->formInsides .= "<br /> <input type='submit' value='submit changes for id:".$row[$i][$media_id]."'></input>";
				$this->formInsides .= "<button class='deleteButton' id='".$row[$i][$media_id]."'>delete this!</button>";
				$this->formInsides .="<br /></div><br /></form>";
				$this->formInsides .="<div id='returnu".$row[$i][$media_id]."'></div>";
			}
			return $this->formInsides;
		}
		
	}

}

?>