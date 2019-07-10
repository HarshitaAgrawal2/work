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
		$select = "select * from user where username = '$uname'";
		$status = mysqli_query($con,$select);
		if(!$status){
		    die("Unable to load data.".mysqli_error($con));
		}
		$row = mysqli_fetch_array($status,MYSQLI_NUM);
		$user_name = $row[0];
        $user_password = $row[1]; 
        $nam = $row[2];
		if ($uname==$user_name && $password==$user_password) {
			session_start();
            $_SESSION["user"] = $user_name;
            $_SESSION['nam'] = $nam;
			header("Location:index.php"); 
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
		<li class="li"><a class="active" href="index.php">L+1</a></li>
		<li class="li"><a  href="admin.php">Admin</a></li>
	</ul>  <br>
	
	<br><br> <img src="logo.png" width="15%"><br>
	<form method="post" id="loginform">
		<p id="loginHeading">L+1 login</p> 
		<label class="inputlabel">Employee code</label> 
		<input type="text" name="username"  placeholder="Type your employee code" class="inputfield">
		<label class="inputlabel">Password</label>
		<input type="password" name="password"  placeholder="Type your password" class="inputfield"> 
		<input type="submit" name="loginSubmit" value="Log in" id="loginbtn">
		<div id="error_msg"><?php echo $msg ; ?></div><br><br><br>
	</form>
	
</body>
</html>
