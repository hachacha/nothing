<html>
	<head>
		<title>edit derives</title>
		<script type="text/javascript" src="../lib/jquery.min.js"></script>
		<style>
			.ret{
				background-color: limegreen;
			}
			textarea{
				resize:both;
			}
		</style>
	</head>
	<body>
		<blink><h2>derives edit; aight</h2></blink>
		<ul>
			<li>if this is set to constant then the derive_path should be just one option</li>
			<li>otherwise it should be a path like so 1,4,3,2 etc</li>
			<li>first page you're on is 1. second click brings you to 4. third to 3...</li>
			<li>in constant mode each it will just keep going to the next path related.</li>
			<li>amt is amount. how much of each thing do you want to show up for each page</li>
		</ul>

		<a href="#newone">go to make new</a>
		<?php 
			include_once("AdminDerives.php");
		?>
		<h2 id="newone">MAKE A NEW ONE</h2>
		<div id="return"></div>
		<form id='newOne'>
			<input type="hidden" name="q_type" value="insert"></input>
			<label for="txt_amt">txtamount</label>
			<input name="txt_amt" type="textarea"></input>
			<label for="img_amt">img amount</label>
			<input name="img_amt" type="textarea"></input>
			<label for="audio">audio</label>
			<input name="audio" type="textarea"></input>
			<label for="d_path">derive path</label>
			<input name="d_path" type="textarea"></input>
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
						url: "AdminDerives.php",
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
					console.log(updateData);
					$.ajax({
						type: "POST",
						url: "AdminDerives.php",
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
				$('.deleteButton').click(function(e){
					e.preventDefault();
					var deleteData = "media_id=d_id&q_type=delete&id="+this.id;
					var returnID = $("#returnu"+this.id);
					$.ajax({
						type: "POST",
						url: "AdminDerives.php",
						data: deleteData,
			            success: function(data) {
			                console.log(data);
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

