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
	<link type="text/css" rel="stylesheet" href="media/main.css" />
</head>
<body>	
    <div id="home"><a href="admin.php">Go to Admin page</a></div>
	
	<form method="post">
		<input type="submit" name="logout" value="Logout">
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