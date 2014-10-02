<html>
<head>
<title>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;o&plus;&lt;
</title>
<script type="text/javascript" src="lib/jquery.min.js"></script>
<script>
	
	 
</script>
</head>
<body>
<?php
// include_once("checkCookie.php");
include_once("TextFactory.php");
echo "HEY HERE WE ARE IN THE MAIN <br>";
echo "your cookie is " . $_COOKIE['uid'];
class Client{
	public function __construct(){
		$this->someTextObject = new TextFactory();
		echo $this->someTextObject->startFactory()."<br />";
	}
}

$worker=new Client();

?>
</body>
</html>