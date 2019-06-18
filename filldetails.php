<?php
    session_start();
    if (isset($_SESSION["user"])) {
    }
    else{
        header("Location:userlogin.php");
    }
    $date = $_SESSION['date'];
    $codeplus = $_SESSION['user'];
    $url = "localhost:3306";
    $user = "root";
    $psw = "";
    $con = mysqli_connect($url, $user, $psw);
    if(!$con){
        die("Unable to connect");
    } 
    mysqli_select_db($con, 'harshi');
    $select = "select codeminus, ename, utilization from details where wdate = '$date' and codeLplus1 = '$codeplus'";
    $status = mysqli_query($con,$select);
    if(!$status){
        die("Unable to load data.".mysqli_error($con));
    }
    echo "Done:</br>";
    while($row = mysqli_fetch_array($status,MYSQLI_NUM)){
        echo "<br>Code:".$row[0];
        echo "<br>Name:".$row[1];
        echo "<br>Utilzation:".$row[2];
    }   
    $select = "select codeminus1, nameMinus1 from lminus where codeplus1 = '$codeplus' and codeminus1 NOT IN (select codeminus from details where wdate = '$date' and codeLplus1 = '$codeplus')";
    $status = mysqli_query($con,$select);
    if(!$status){
        die("Unable to load data.".mysqli_error($con));
    }
    echo "<br><br>Remaining:</br>";
    while($row = mysqli_fetch_array($status,MYSQLI_NUM)){
        echo "<br>Code:".$row[0];
        echo "<br>Name:".$row[1];
        
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
		<h1>Fill Details:</h1>
        <label >Code</label> 
		<input type="text" name="code" placeholder="Enter code of L-1">
		<label >Name</label> 
		<input type="text" name="name" placeholder="Enter name of L-1">
		<label >Domain Function</label> 
        <input type="text" name="domain">
        <label >Department</label> 
		<input type="text" name="department" >
		<label >Project</label> 
        <input type="text" name="project" list="projectNames" />
        <datalist id="projectNames">
          <option>Volvo</option>
          <option>Saab</option>
          <option>Mercedes</option>
          <option>Audi</option>
        </datalist>
        <label>Utilization</label>
        <input type="number" name="utilization" min="0" max="100" placeholder="eg: 50">
        <input type="submit" name="submit">
	</form> 
</body>
</html>
<?php
    $msg ="";
	if (isset($_POST["submit"])) {
		$url = "localhost:3306";
		$user = "root";
		$psw = "";
		$con = mysqli_connect($url, $user, $psw);
		if(!$con){
	    	die("Unable to connect");
		} 
		mysqli_select_db($con, 'harshi');
		$codeLplus = $_SESSION['user'];
		$nameLplus = $_SESSION['nam'];
		$code = $_POST["code"];
		$select = "select codeminus1 from lminus where codeplus1 = '$codeLplus'";
		$status = mysqli_query($con,$select);
		if(!$status){
		    die("Unable to load data.".mysqli_error($con));
		}
		$flag = 0;
        while($row = mysqli_fetch_array($status,MYSQLI_NUM)){
            if($row[0]==$code){
				$flag = 1;
				break;
			}
			else{
				$flag = 0;
			}
		}
		if($flag==0){
			die('You can enter utilization of resources who work under you');
		}
        $name = $_POST["name"];
		$domain = $_POST["domain"];
		$department = $_POST["department"];
		$project = $_POST["project"];
        $date = $_SESSION["date"];
        $utilization = $_POST["utilization"];	
		$sql = "INSERT INTO details(codeLplus1, nameLplus1, codeminus, ename, domain, department, project, wdate, utilization) VALUES ('$codeLplus', '$nameLplus', '$code', '$name', '$domain', '$department', '$project', '$date', '$utilization')";
		$status = mysqli_query($con, $sql);
		if(!$status){
		 	die(mysqli_error($con));
		}
        echo "Stored successfully";
        header("Location:filldetails.php");
	}
	if (isset($_POST["logout"])) {
        session_destroy();
        header("Location:userlogin.php");
    }
?>
