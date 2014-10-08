<html>
<head>
<title>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;o&plus;&lt;
</title>
<script type="text/javascript" src="lib/jquery.min.js"></script>

</head>
<body>
<?php
// include_once("checkCookie.php");

echo "HEY HERE WE ARE IN THE MAIN <br>";
echo "your cookie is " . $_COOKIE['uid'];

?>
<br />
<a id="go" href="#">clicky</a>
<br />
<br />
<div id="content">
</div>
<script type="text/javascript">
	$("#go").click(function(e){
		e.stopImmediatePropagation();
		e.preventDefault();
		$.ajax({
			url:'Client.php',
			type:'post',
			success:function(results){
				console.log("ass");
				$('#content').html(results);
			}
		});
		return false;
	});
	 
</script>
</body>
</html>