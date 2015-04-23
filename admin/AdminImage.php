<?php
	//here should select all from img, print out and give options to alter.
	include_once("AdminEdit.php");
	class AdminImage extends AdminEdit {
		public function __construct(){
			if(!empty($_POST)){
				if($_POST['q_type']=="insert"){
					echo parent::evalNew($_POST, "image");
					return;	
				}
				if($_POST['q_type']=="update"){
					echo parent::evalUp($_POST, "image");
					return;	
				}
				elseif ($_POST['q_type']=='delete') {
					if(parent::deleteMe($_POST,"img_media")==TRUE)
						echo "WOW U REALLY DELETED ME LOL! <a href='#' onclick='window.location.reload();'>refresh</a>";
					else
						echo "THS FUCKD UP. CALL THE COPS";
				}
			}
			else{
				$this->row = null;
				$this->formInsides = "";
				$this->sql = "SELECT * FROM img_media ORDER BY i_id asc;";
				$this->db = UConnect::doConnect();
				$q=$this->db->prepare($this->sql);
				$q->execute();
				$row = $q->fetchAll(PDO::FETCH_ASSOC);
				$this->row = $row;
				if(empty($this->row)){
					echo "either there is nothing here or this shit is broken. call the police";
					die();
				}
				// else
					// var_dump($this->row);
					// $this->makeHTML();
				echo parent::makeHTML($this->row,'i_id');	
			}
			
		}
		
	}
	$x = new AdminImage();
	
?>