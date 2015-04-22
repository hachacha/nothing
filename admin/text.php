<html>
	<head>
		<title>edit text</title>
		<script type="text/javascript" src="../lib/jquery.min.js"></script>
		<style>
			.ret{
				background-color: pink;
			}
			textarea{
				resize:both;
			}
		</style>
	</head>
	<body>
		<blink><h2>text edit; aight</h2></blink>
		<ul>
			<li>when you log in you get a cookie/derive set like [1,3,4,2] (unless you have it set to endless)</li>
			<li>first page you're on is 1. second click brings you to 3. third to 4 etc.</li>
			<li>you have a chance of seeing any of the content on there that has derive of 1</li>
			<li>text does not have 2 b attributed to an author. but it may be a good idea for organizational purposes for the future.</li>
			<li>if it's not linking to anything then put a zero in there</li>
			<li>if it is linking somewhere make sure that the author is set, and the link_to has the same name as the folder within the author's folder</li>
			<li>within that you need to have an index.php OR index.html as the main landing page</li>
		</ul>

		<a href="#newone">go to make new</a>
		<?php 
			include_once("AdminText.php");
		?>
		<h2 id="newone">MAKE A NEW ONE</h2>
		<div id="return"></div>
		<form id='newOne'>
			<input type="hidden" name="q_type" value="insert"></input>
			<label for="d_id">derive</label>
			<input name="d_id" type="textarea"></input>
			<label for="content">content</label>
			<input name="content" type="textarea"></input>
			<label for="link_to">link</label>
			<input name="link_to" type="textarea"></input>
			<label for="author">author</label>
			<input name="author" type="textarea"></input>
			<input type="submit" name="submit" value="make new"></input>
		</form>
		
		<script>
			$(document).ready(function(){
				$('#newOne').submit(function(e){
					e.preventDefault();
					var createData = $("#newOne").serialize();
					console.log(createData);
					$.ajax({
						type: "POST",
						url: "AdminText.php",
						data: createData,
			            success: function(data) {
			                console.log(data);
			                $("#return").html(data);
			            },
			            error: function(){
			                  alert('error handing here');
			            }
					});
				});
				$('.updateForm').submit(function(e){
					e.preventDefault();
					var updateData = $("#"+this.id).serialize();
					var returnID = $("#return"+this.id);
					console.log("#return"+this.id);
					$.ajax({
						type: "POST",
						url: "AdminText.php",
						data: updateData,
			            success: function(data) {
			                console.log(data);
			                // console.log("#return"+this.id);
			                console.log(returnID);
			                returnID.html(data);
			            },
			            error: function(){
			                  alert('error handing here');
			            }
					});
				});
			});
		</script>
	</body>
</html>

