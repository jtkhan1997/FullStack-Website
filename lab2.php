<!DOCTYPE html>
<?php include('infoSQL.php') ?>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Lab 2</title>
		<link rel = "stylesheet" type = "text/css" href = "style.css"/>	
		<script src = 'https://code.jquery.com/jquery-3.6.0.min.js'> </script>
	</head>
	<body>
		
		<div>
			<div class = "form">
				<form class = "registerForm" method = "post">
					<h2>Please Register </h2>
					<input type = "text" placeholder = "Username" name = "username">
					<input type = "password" placeholder = "Password" name = "password" >
					<input type = "submit" id = "register" name = "register_user">
					<p class = "flag"><a href = "#"> Login </a> </p>
					</form>
				<form class = "loginForm" method = "post" id = "login-form">
					<h2>Please Log in</h2>
					<input type = "text" placeholder = "Username" name = "username" >
					<input type = "password" placeholder = "Password" name = "password" >
					<input type = "submit" id = "login" name = "login_user" value = "Submit">
					<p class = "flag"><a href = "#"> Register</a></p>
				</form>
			</div>
			
			<script>
				$('.flag').click(function(){
					$('form').animate({height: "toggle", opacity: "toggle"}, "slow");
				});
			</script>
		</div>
	</body>
</html>