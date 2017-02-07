<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Token incorrecto</title>
	<link href='https://fonts.googleapis.com/css?family=Source+Code+Pro:900' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Unkempt:400,700' rel='stylesheet' type='text/css'>
	<style>
	body,html
{
	width: 100%;
	height: 100%;
	margin: 0;
	background: #8a846a;
	background: url("./public/assets/images/q.jpg") no-repeat center center fixed; 
	  -webkit-background-size: cover;
	  -moz-background-size: cover;
	  -o-background-size: cover;
	  background-size: cover;
	 
}
.Text
{
	margin: 30px;
	padding: 10px;
	color: white;
	position: fixed;
}
@media (min-width : 768px) and (max-width : 1024px)  { 

	.Text
	{
		margin: 20px;
	}
}
.Text-title
{
	font-size: 60px;
	font-family: 'Source Code Pro', ;
	margin-bottom: 2px;
}
.Text-subtitle
{
	margin-top:2px; 
	font-family: 'Unkempt', cursive;
	font-size: 25px;
}
@media (max-width : 480px) { 
	.Text-title
	{
		font-size: 40px
	}
	.Text-subtitle
	{
		font-size: 20px
	}

}

.btn
{
	width: 200px;
	padding:10px;
	color: white;
	font-size: 14px;
	border:none;
	-webkit-box-shadow: 0 8px 6px -6px black;
	   -moz-box-shadow: 0 8px 6px -6px black;
	        box-shadow: 0 8px 6px -6px black;
	background: orange;
}	
		
	</style>
</head>
<body>
	<div class="Text">
		<h1 class="Text-title">Ups! Error de inactividad<br> El token no coincide </h1>
		<p class="Text-subtitle">Pero no te preocupes, un desarollador muy divertido esta trabajando en esto.</p>
		<button class="btn" id="back"> Regresar</button>
	</div>
	
	<script>
		document.getElementById('back').onclick=function(){
			goBack()
		}
		
		function goBack(){
				window.history.back();
		}
		
	</script>
</body>
</html>
