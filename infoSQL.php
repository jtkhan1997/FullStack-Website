<!DOCTYPE html>
<html>
	<head>
		<style>
			error{
				padding: 70px 0;
				text-align: center;
				margin-top: 100px;
				color: red;
				font-size: 20pt;
			}
		</style>
	</head>
<body>
<?php
	session_start();
	$username = "";
	$session = 'false';
	$hash ="";
	$db_host = 'localhost';
	$db_user = 'root';
	$db_password = 'root';
	$db_db = 'lab2';			// the database to
								// connect to on this server
	$db_port = 8889;
	$mysqli = new mysqli(
		$db_host,
		$db_user,
		$db_password,
		$db_db,
		$db_port	// be careful...you need this!
	);
	if ($mysqli->connect_error) {
		echo 'Errno: '.$mysqli->connect_errno;
		echo '<br>';
		echo 'Error: '.$mysqli->connect_error;
		exit();
	}
	if (isset($_POST['register_user'])) {

		$errors = array();
		$count = '0';
	

		$username = mysqli_real_escape_string($mysqli, $_POST['username']); 
		$password = $_POST['password'];
		if(empty($username)) { $errors[$count] = 'Username is required'; $count += '1';}
		if (empty($password)) {  $errors[$count] = 'Password is required'; $count += '1';}
		
		$user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
		$result = mysqli_query($mysqli, $user_check_query);
		$user = mysqli_fetch_assoc($result);
		if ($user) {
			if ($user['username'] === $username) {
				$errors[$count] = 'Username already exists.';$count += '1';
			}
		}
		//display all errors
		echo '<error>';
			foreach($errors as $error) {
				echo "<li>$error</li>";
			}
		echo '</error>';
		if (count($error) == 0) {
			//Salt hash
			$hash_salt = password_hash($password, PASSWORD_DEFAULT);
			$hash = $hash_salt;
			$query = "INSERT INTO users (username, password) 
						VALUES('$username', '$hash_salt')";
			mysqli_query($mysqli, $query);
		}
	}
	if (isset($_POST['login_user'])) {
		$errors2 = array();
		$count2 = '0';
	
		$username = mysqli_real_escape_string($mysqli, $_POST['username']);
		$password = mysqli_real_escape_string($mysqli, $_POST['password']);

		if (empty($username)) {
			$errors2[$count2] = 'Username is required';
			$count2 += '1';
		}
		if (empty($password)) {
			$errors2[$count2] = 'Password is required';
			$count += '1';
		}
		//display all errors
		echo '<error>';
			foreach($errors2 as $error) {
				echo "<li>$error</li>";
			}
		echo '</error>';

		if (count($errors2) == 0) {
			$stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
			$stmt->bind_param("s", $username);
			$stmt->execute();
			$user = $stmt->get_result()->fetch_assoc();
			
			if($user && password_verify($password, $user['password'])){
				$_SESSION['username'] = $username;
				if($user['username'] == 'Administrator'){
						header('location: adminpage.php');
				} else{
					$session = true;
					header('location: homepage.php');
					
				}
			}else {
				echo '<error>';
					echo '<ul>';
						echo 'Wrong Username/Password';
						
					echo '</ul>';
				echo '</error>';
			}	
		}
	}
?>
</body>
</html>