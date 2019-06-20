<?php
	$msg ="";
	if (isset($_POST["loginSubmit"])) {
		$uname = $_POST["username"];
		$password = $_POST["password"];
		$url = "localhost:3306";
		$user = "root";
		$psw = "";
		$con = mysqli_connect($url, $user, $psw);
		if(!$con){
		    die("Unable to connect");
		} 
		mysqli_select_db($con,'harshi');
		$select = "select * from admin where username = '$uname'";
		$status = mysqli_query($con,$select);
		if(!$status){
		    die("Unable to load data.".mysqli_error($con));
		}
		$row = mysqli_fetch_array($status,MYSQLI_NUM);
		$user_name = $row[0];
		$user_password = $row[1]; 
		if ($uname==$user_name && $password==$user_password) {
			session_start();
			$_SESSION["admin"] = $user_name;
			header("Location:admin.php"); 
		}
		else{
			$msg = "Invalid login";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Scheduler</title>
	<link type="text/css" rel="stylesheet" href="main.css" />
</head>
<body>
    <div id="back"><a href="index.php">Go to Home</a></div>
	<form method="post">
		<h1>Admin login</h1> <br>
		<label>Username</label> 
		<input type="text" name="username" placeholder="Enter your code">
		<label>Password</label>
		<input type="password" name="password"> 
		<input type="submit" name="loginSubmit" value="Log in">
		<div id="error_msg"><?php echo $msg ; ?></div>
	</form>
</body>
</html>