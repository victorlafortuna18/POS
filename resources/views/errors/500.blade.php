<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>500 server side error</title>
	<link rel="stylesheet" type="text/css" href="404-01.css">
	<link href='https://fonts.googleapis.com/css?family=Source+Code+Pro:900' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Unkempt:400,700' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="Text">
		<h1 class="Text-title">Ups! Error 500<br> Server side error </h1>
		<p class="Text-subtitle">But don't worry, a very cool developer will be working on this</p>

		<button class="btn" id="back"> Go back to home</button>
	</div>
</body>
</html>

	<script>
		document.getElementById('back').onclick=function(){
			goBack()
		}
		
		function goBack(){
				window.history.back();
		}
		
	</script>