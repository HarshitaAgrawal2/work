<!DOCTYPE html>
<html>
<head>
	<title>Project</title>
	<link type="text/css" rel="stylesheet" href="main.css" />
</head>
<body>	
    <div id="home"><a href="admin.php">Back to Admin Home page</a></div>
	<form method="post">
        <div class="user">   
            <span>You are logged in as: <?php session_start(); echo $_SESSION['admin'];?></span> 
            <input type="submit" name="logout" value="Logout"> 
        </div>
		<h1>Add L+1:</h1>
        <label >Code</label> 
		<input type="text" name="codep" placeholder="Enter code of L+1">
		<label >Name</label> 
		<input type="text" name="name" placeholder="Enter name of L+1">
		<label>Password</label>
		<input type="password" name="password"  placeholder="Set password for L+1"> 
        <input type="submit" name="submit"> <hr>
        <h1>Add L-1:</h1>
        <label >Code</label> 
		<input type="text" name="codem" placeholder="Enter code of L-1">
		<label >Name</label> 
		<input type="text" name="namem" placeholder="Enter name of L-1">
        <label >Code of his L+1</label> 
		<input type="text" name="code" placeholder="Enter code of L+1">
        <input type="submit" name="submitm"> <hr>
        <input type="submit" name="show_plus" value="Show ALL L+1">
        <input type="submit" name="show_minus" value="Show ALL L-1"> 
	</form>  <br>
</body>
</html>
<?php
    $url = "localhost:3306";
    $user = "root";
    $psw = "";
    $con = mysqli_connect($url, $user, $psw);
    if(!$con){
        die("Unable to connect");
    } 
    mysqli_select_db($con, 'harshi');
	if (isset($_POST["submit"])) {
        $codep = $_POST["codep"];
        $name = $_POST["name"];
		$password = $_POST["password"];
		$sql = "INSERT INTO user(username, passw, Namep) VALUES ('$codep', '$password', '$name')";
		$status = mysqli_query($con, $sql);
		if(!$status){
		 	die(mysqli_error($con));
		}
		echo "Stored successfully";
	}
	if (isset($_POST["logout"])) {
        session_destroy();
        header("Location:adminlogin.php");
    }
    if (isset($_POST["submitm"])) {
        $cod = $_POST["code"];
        $code = $_POST["codem"];
        $name = $_POST["namem"];
        $sql = "INSERT INTO lminus(codeplus1, codeminus1, nameMinus1) VALUES ('$cod', '$code', '$name')";
		$status = mysqli_query($con, $sql);
		if(!$status){
		 	die(mysqli_error($con));
		}
        echo "Stored successfully";
    }
    if (isset($_POST["show_plus"])) {
		$select = "select * from user";
		$status = mysqli_query($con,$select);
		if(!$status){
		    die("Unable to load data.".mysqli_error($con));
        }
        echo "<table><tr><th>Code</th><th>Name of L+1</th></tr>";
        while($row = mysqli_fetch_array($status,MYSQLI_NUM)) {
            echo "<tr><td>".$row[0]."</td>" ;
            echo "<td>".$row[2]."</td></tr>" ; 
        }
        echo "</table>";
    }
    if (isset($_POST["show_minus"])) {
		$select = "select * from lminus order by codeplus1";
		$status = mysqli_query($con,$select);
		if(!$status){
		    die("Unable to load data.".mysqli_error($con));
        }
        echo "<table><tr><th>Code</th><th>Name of L-1</th><th>L+1</th></tr>";
        while($row = mysqli_fetch_array($status,MYSQLI_NUM)) {
            echo "<tr><td>".$row[1]."</td>" ;
            echo "<td>".$row[2]."</td>" ;
            echo "<td>".$row[0]."</td></tr>" ; 
        }
        echo "</table>";
    }
?>