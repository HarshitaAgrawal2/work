<?php
    session_start();
    if (isset($_SESSION["admin"])) {
    }
    else{
        header("Location:adminlogin.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Project</title>
	<link type="text/css" rel="stylesheet" href="media/main.css" />
</head>
<style>
    form{
        border: 2px solid black;
        padding: 10px;
    }
</style>
<body>	
    <div id="home"><a href="index.php">Go to Home</a></div>
    <div id="home"><a href="entry.php">Add L+1/L-1</a></div>
    <form method="post" style="border:2px solid white; padding:0px">
        <input type="submit" name="logout" value="Logout">
	</form> 
	<form method="post" >
    <h2>Get Details</h2>
        <label >Date</label> 
        <input type="date" name="date">
        <input type="submit" name="show_details">
	</form> 
</body>
</html>
<?php
    if (isset($_POST["show_details"])) {
		$url = "localhost:3306";
		$user = "root";
		$psw = "";
		$con = mysqli_connect($url, $user, $psw);
		if(!$con){
		    die("Unable to connect");
		} 
        mysqli_select_db($con,'harshi');
        $date = $_POST["date"];
		$select = "select * from lminus as A left join (select * from details where wdate='$date') as B on A.codeplus1=B.codeLplus1 and A.codeminus1=B.codeminus order by A.codeplus1, A.codeminus1";
		$status = mysqli_query($con,$select);
		if(!$status){
		    die("Unable to load data.".mysqli_error($con));
        }
        echo "<table><tr><td>L+1 Code</td><td>L-1 Code</td><td>Utilization(in percentage)</td></tr>";
        while($row = mysqli_fetch_array($status,MYSQLI_NUM)){
            echo "<tr><td>".$row[0]."</td>";
            echo "<td>".$row[1]."</td>";
            echo "<td>".$row[12]."</td></tr>"; 
        }
        echo "</table>";
    }
    if (isset($_POST["logout"])) {
        session_destroy();
        header("Location:adminlogin.php");
    }
?>