
<!DOCTYPE html>
<html>
<head>
	<title>Project</title>
	<link type="text/css" rel="stylesheet" href="main.css" />
</head>
<body>	

    <ul>
        <li class="li"><a href="admin.php">Admin Home</a></li>
        <li class="li"><a href="index.php">User</a></li>
        <li class="li"><a class="active" href="entry.php">Add User</a></li>
        <li class="li" style="float:right"><a href="logout.php">Logout</a></li>
        <li class="li" style="float:right"><a ><span>You are logged in as: <?php session_start(); echo $_SESSION['admin'];?></span> </a></li>
    </ul>
    <br><br><br> <img src="logo.png" width="15%"> <br>
<div class="admincol">
	<form method="post">
      
		<h1>Add L+1:</h1>
        <label >Code</label> 
		<input type="text" name="codep" placeholder="Type code of L+1">
		<label >Name</label> 
		<input type="text" name="name" placeholder="Type name of L+1">
		<label>Password</label>
		<input type="password" name="password"  placeholder="Set password for L+1"> 
        <input type="submit" name="submit" class="btn"> 
    </form>
</div>
<div class="admincol">
  
	<form method="post">
        <h1>Add L:</h1>
        <label >Code</label> 
		<input type="text" name="codem" placeholder="Type code of L-1">
		<label >Name</label> 
		<input type="text" name="namem" placeholder="Type name of L-1">
        <label >Domain Function</label> 
		<input type="text" name="domain" placeholder="eg: RETAIL, TECH">
        <label >Department</label> 
		<input type="text" name="dept" placeholder="eg: BU2">
        <label >Code of his L+1</label> 
		<input type="text" name="code" placeholder="Type code of L+1">
        <input type="submit" name="submitm" class="btn"> <br><br>
    </form>
</div>
<div class="admincol">
    <form method="post">
        <input type="submit" name="show_plus" value="Show ALL L+1" class="showbtn" style="background-color: <?php isset($_POST["show_plus"]) ? $color='yellowgreen' : $color="beige"; echo $color; ?>">
        <input type="submit" name="show_minus" value="Show ALL L" class="showbtn" style="background-color: <?php isset($_POST["show_minus"]) ? $color='yellowgreen' : $color="beige"; echo $color; ?>"> 
    </form>  <br>
</div>
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
        $domain = $_POST["domain"];
        $dept = $_POST["dept"];
        $sql = "INSERT INTO lminus(codeplus1, codeminus1, nameMinus1, domain, dept) VALUES ('$cod', '$code', '$name', '$domain', '$dept')";
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
        echo "<table><tr><th>Code</th><th>Name of L-1</th><th>DomainFunction</th><th>Dept</th><th>L+1</th></tr>";
        while($row = mysqli_fetch_array($status,MYSQLI_NUM)) {
            echo "<tr><td>".$row[1]."</td>" ;
            echo "<td>".$row[2]."</td>" ;
            echo "<td>".$row[3]."</td>" ;
            echo "<td>".$row[4]."</td>" ;
            echo "<td>".$row[0]."</td></tr>" ; 
        }
        echo "</table>";
    }
?>