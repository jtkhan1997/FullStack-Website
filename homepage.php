<?php 
  session_start(); 

  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Home</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<script>
			
			var i = -1;
			var bgColor = ["pink", "lightblue"];
			function colorChange(bckGrnd) {
			bckGrnd.style.backgroundColor = bgColor[i++ % bgColor.length];
			}
			window.addEventListener("load", colorChange());
		</script>
	</head>
	<body>

		<div class = 'home'>
			<h2>WELCOME!</h2>
		</div>
		<div class = 'home'>

			<?php  if (isset($_SESSION['username'])) : ?>
				<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
				<p> <a href="lab2.php?logout='1'" style="color: red;">logout</a> </p>
			<?php endif ?>
		</div>
		<form method = "get" action = "#" class = 'home' >
			<input type = "button" id = "toggle" name = "tggleBtn" onclick="return colorChange(body);" value = "Toggle">
		</form
	</body>
</html>