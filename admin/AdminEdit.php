<?php

//edit interface shows 
include_once("UConnect.php");
class AdminEdit {
	
	public function updateRow($val,$table){
		if($val['link_to']=="")
			$val['link_to'] = 0;
		$this->sql = "UPDATE $table SET d_id = :d_id, content = :content, author = :author, link_to = :link_to WHERE ".$val['media_id']." = :id";
		// print_r($val);

		// die();
		try{
			$this->db = UConnect::doConnect();
			$q=$this->db->prepare($this->sql);
			$q->bindParam(':d_id', $val['d_id'],PDO::PARAM_INT);
			$q->bindParam(':content',$val['content'],PDO::PARAM_STR);
			$q->bindParam(':author',$val['author'],PDO::PARAM_STR);
			$q->bindParam(':link_to',$val['link_to'],PDO::PARAM_STR);
			$q->bindParam(':id',$val['c_id'],PDO::PARAM_STR);
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
		// print_r($val);
		// die();
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
				# code...
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
				# code...
				break;							
			
			default:
				# code...
				break;
		}
	}

	public function makeHTML($row,$media_id){
			
			for($i=0;$i<count($row);$i++){
				// echo $i . " " . $this->row[$i]['d_id'] . ' ||||';
				$this->formInsides .= "<form id='u".$row[$i][$media_id]."' class='updateForm'>";
				$this->formInsides .= "<input type='hidden' name='media_id' value='".$media_id."'></input>";
				$this->formInsides .= '<input type="hidden" name="q_type" value="update"></input>';
				$this->formInsides .= '<input type="hidden" name="c_id" value="'.$row[$i][$media_id].'"></input>';
				$this->formInsides .= "<div class='ret'> <p><span  style='background-color:yellow;'>".$row[$i][$media_id]."</span></p>";
				$this->formInsides .= "<label for='d_id'>derive</label>";
				$this->formInsides .= "<input type='textarea' name='d_id' value='".$row[$i]['d_id']."'></input>";
				$this->formInsides .= "<label for='author'> author</label>";
				$this->formInsides .= "<input type='textarea' name='author' value='".$row[$i]['author']."'></input>";
				$this->formInsides .= "<br />";
				$this->formInsides .= "<label for='link'> link</label>";
				$this->formInsides .= "<input type='link' name='text' value='".$this->row[$i]['link_to']."'></input>";
				$this->formInsides .= "<label for='content'> content</label>";
				$this->formInsides .= "<input type='textarea' style='height:40px;max-height:40px;' rows='55' cols='50' name='content' value='".$this->row[$i]['content']."'></input>";
				$this->formInsides .= "<div class='preImg'><img src='../".$this->row[$i]['content']."'/></div>";
				$this->formInsides .= "<br /> <input type='submit' value='submit changes for id:".$this->row[$i][$media_id]."'></input>";
				$this->formInsides .="<br /></div><br /></form>";
				$this->formInsides .="<div id='returnu".$row[$i][$media_id]."'></div>";
			}
			return $this->formInsides;
		}

}

?>