<?php	
	session_start();
	error_reporting(E_ALL);
	
	//if the user clicks the logout link in the main page
	if(isset($_GET["flag"]) && $_GET["flag"] == "logout"){
		//clear the session array variable
		$_SESSION = array();
		//destroy the session
		session_destroy();
		//unset all session
		unset($_SESSION);
		echo "<h1>Thank you for logging in.</h1>";
	}
	
	//if user has already logged in
	if(isset($_SESSION["username"]) && $_SESSION["username"] != ""){	
		header("location: main.php");
		exit;
	}
	
	//get the flag if user is not yet logged in
	if(isset($_GET["flag"]) && $_GET["flag"] == "false"){
		echo "<h1>You need to login first.</h1>";
	}
	
	
	
	if(isset($_POST["btnLogin"])){
		
		$username = $_POST["username"];
		$password = $_POST["password"];
		
		include("db_class.php");
		$login_user = PDO_DB::query("select * from user where username = ? and password = ? ", array($username, md5($password)), "SELECT");
		if(count($login_user) > 0){
			$login_user = $login_user[0];
			$_SESSION["id"] = $login_user["id"];
			$_SESSION["username"] = $login_user["username"];
			header("location: main.php");
			exit;
		}
		else {
			echo "<p>Invalid username or password. Please try again</p>";
		}
		
	}
	
	
	
?>



<!DOCTYPE html>
<html>
<head>
	<title> Login Form in HTML5 and CSS3</title>
	<link rel="stylesheet" a href="css\style.css">
	<link rel="stylesheet" a href="css\font-awesome.min.css">
</head>
<body>
	<div class="container">
	<img src="images/person.png"/>
		<form>
			<div class="form-input">
				<input type="text" name="text" placeholder="Enter the User Name"/>	
			</div>
			<div class="form-input">
				<input type="password" name="password" placeholder="password"/>
			</div>
			<input type="submit" type="submit" value="LOGIN" class="btn-login"/>
		</form>
	</div>
</body>
</html>