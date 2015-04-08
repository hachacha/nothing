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

<div id="content"></div>
   
<script type="text/javascript">
function new_path(){
	$('.nother').click(function(e){//for permutations of links to next shits.
		var c = $(this).attr('rel');//data rel is new id to process.
		clicks++;
		e.stopImmediatePropagation();
		e.preventDefault();
		$.ajax({
			url:'admin/Client.php',
			type:'post',
			data:{"uid":c,'iters':clicks},
			success:function(results){
				$('#content').html(results);
				new_path();
			}
		});
		return false;
	});	
};

$(window).load(function(e){//for initial.
	var c = $.cookie("uid");//initial id is the derive.
	clicks = 0;
	e.stopImmediatePropagation();
	e.preventDefault();
	$.ajax({
		url:'admin/Client.php',
		type:'post',
		data:{"uid":c,'iters':clicks},
		success:function(results){
			$('#content').html(results);
			new_path();
		}
	});
	return false;
});
</script>
</body>
</html>