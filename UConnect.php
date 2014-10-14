<?php

include_once("IConnect.php");

class UConnect implements IConnect{
	private static $server=IConnect::HOST;
	private static $currentDB=IConnect::DBNAME;
	private static $user=IConnect::UNAME;
	private static $pass=IConnect::PW;
	private static $db;
	public function doConnect(){
		try{
			self::$db=new PDO("pgsql:host=".self::$server." port=5432 dbname=".self::$currentDB." user=".self::$user." password=". self::$pass);
			if(self::$db){
				//echo "i've connected";
			}
		}
		catch(PDOException $e) {
  			echo $e->getMessage();
		}
		return self::$db;
	}
		
}

?>