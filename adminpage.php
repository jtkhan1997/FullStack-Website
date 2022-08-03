<!DOCTYPE html>
<?php include('infoSQL.php') ?>
<html>
	<head>
		<title> Admin </title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
	<hr>	

	<table border="1" class = 'form'>
		<thead>
			<tr>
				<td>Username</td>
				<td>Password</td>
			</tr>
		</thead>
		<tbody>
<?php

		$sql = "SELECT * FROM users ORDER BY username";
		$stmt = $mysqli->prepare($sql);
		$stmt->execute();
		$result = $stmt->get_result();

		foreach($result as $resultRow)
		{	
			$user =  $resultRow["username"];
			$pass =   $resultRow["password"];
			print("<tr><td>$user</td>" 
				. "<td>$pass</td></tr>");

			
		}
?>	
		
		
		</tbody>
	</table>
		

	</body>
</html>