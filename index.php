<?php
    session_start();
    if (isset($_SESSION["user"])) {
    }
    else{
        header("Location:userlogin.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Project</title>
	<link type="text/css" rel="stylesheet" href="main.css" />
</head>
<body>	

    <!--<div id="home"><a href="admin.php">Go to Admin page</a></div>-->
    <ul>
        <li class="li"><a class="active" href="index.php">Home</a></li>
        <li class="li"><a href="admin.php">Admin Login</a></li>
        <li class="li" style="float:right"><a href="logout.php">Logout</a></li>
        <li class="li" style="float:right"><a ><span>You are logged in as: <?php echo $_SESSION['user'];?></span> </a></li>
    </ul>  <br><br><br>
	<form method="post">
		<h1>Enter current week Monday's date:</h1>
        <label >Date</label> 
        <input type="date" name="date">
        <input type="submit" name="submit" value="Submit and next">
	</form> 
</body>
</html>
<?php
    $msg ="";
	if (isset($_POST["submit"])) {
        $_SESSION['date'] = $_POST["date"];
		header("Location:filldetails.php");
	}
	if (isset($_POST["logout"])) {
        session_destroy();
        header("Location:userlogin.php");
    }
?>