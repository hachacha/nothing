<?php
	//here should select all from text, print out and give options to alter.
	include_once("AdminEdit.php");
	class AdminDerives extends AdminEdit {
		public function __construct(){
			if(Product::DERIVE_TYPE=="constant")//what kind of derives we dealin with?
					$this->table = "derives";
				else
					$this->table = "derives_set";

			if(!empty($_POST)){
				if($_POST['q_type']=="insert"){
					echo parent::evalNew($_POST, $this->table);
					return;	
				}
				if($_POST['q_type']=="update"){
					echo parent::evalUp($_POST, $this->table);
					return;	
				}
				elseif ($_POST['q_type']=='delete') {
					if(parent::deleteMe($_POST,$this->table)==TRUE)
						echo "WOW U REALLY DELETED ME LOL! <a href='#' onclick='window.location.reload();'>refresh</a>";
					else
						echo "THS FUCKD UP. CALL THE COPS";
				}
			}
			else{
				$this->row = null;
				$this->formInsides = "";
				$this->sql = "SELECT * FROM $this->table ORDER BY d_id asc;";
				$this->db = UConnect::doConnect();
				$q=$this->db->prepare($this->sql);
				$q->execute();
				$row = $q->fetchAll(PDO::FETCH_ASSOC);
				$this->row = $row;
				if(empty($this->row)){
					echo "either there is nothing here or this shit is broken. call the police";
					die();
				}
				
				echo parent::makeHTML($this->row,'d_id');	
			}
		}
	}
	$x = new AdminDerives();
	
?>