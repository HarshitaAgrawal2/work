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
	<title>Project</title>
	<link type="text/css" rel="stylesheet" href="main.css" />
	<style>
	 #loginform {
		 border-radius:5px;
		 width:30%;
		 margin-left:35%;
	 }
	</style>
</head>
<body>

	<ul>
		<li class="li"><a >Select Role: </a></li>
		<li class="li"><a  href="index.php">L+1</a></li>
		<li class="li"><a  class="active" href="admin.php">Admin</a></li>
	</ul>   
	
	<br><br><br> <img src="logo.png" width="15%"><br>
   
	<form method="post" id="loginform">
		<p id="loginHeading">Admin login</p>
		<label class="inputlabel">Username</label> 
		<input type="text" name="username" placeholder="Type your username" class="inputfield">
		<label class="inputlabel">Password</label>
		<input type="password" name="password" class="inputfield" placeholder="Type your password"> 
		<input type="submit" name="loginSubmit" value="Login" id="loginbtn">
		<div id="error_msg"><?php echo $msg ; ?></div> <br><br><br>
	</form>
</body>
</html>