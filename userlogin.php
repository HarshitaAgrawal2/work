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
	<title>Scheduler</title>
	<link type="text/css" rel="stylesheet" href="main.css" />
</head>
<body>

	<ul>
		<li class="li"><a class="active" href="index.php">User Login</a></li>
		<li class="li"><a  href="admin.php">Admin Login</a></li>
	</ul> 
	<br><br><br><br>
	<form method="post" id="loginform">
		<p id="loginHeading">User login</p> 
		<label class="inputlabel">Code</label> 
		<input type="text" name="username"  placeholder="Type your code" class="inputfield">
		<label class="inputlabel">Password</label>
		<input type="password" name="password"  placeholder="Type your password" class="inputfield"> 
		<input type="submit" name="loginSubmit" value="Log in" id="loginbtn">
		<div id="error_msg"><?php echo $msg ; ?></div>
	</form>
</body>
</html>
