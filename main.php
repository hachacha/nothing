<html>
<head>
<title>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;o&plus;&lt;
</title>
<script type="text/javascript" src="lib/jquery.min.js"></script>
<script type="text/javascript" src="lib/jquery.cookie.js"></script>
<link rel="stylesheet" type="text/css" href="lib/style.css">


</head>
<body>
<?php

echo "HEY HERE WE ARE IN THE MAIN <br>";

?>
<br />
<a id="go" href="#">clicky</a>
<br />
<br />
<div id="content"></div>
   
<script type="text/javascript">
		$("#go").click(function(e){
			var c = $.cookie("uid");
			e.stopImmediatePropagation();
			e.preventDefault();
			$.ajax({
				url:'Client.php',
				type:'post',
				data:{"uid":c},
				success:function(results){
					console.log(c);
					console.log(results);
					$('#content').html(results);
				}
			});
			return false;
		});
	 
</script>
</body>
</html>