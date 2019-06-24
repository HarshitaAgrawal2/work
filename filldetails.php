<?php
    session_start();
    if (isset($_SESSION["user"])) {
    }
    else{
        header("Location:userlogin.php");
    }
    echo "<br><br><br>";
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
    $select = "select codeminus, nameMinus1, domain, dept, utilization from details as A left join lminus on A.codeminus=lminus.codeminus1 where A.wdate = '$date' and codeLplus1 = '$codeplus' ORDER BY `A`.`nameLplus1` ASC";
    $status = mysqli_query($con,$select);
    if(!$status){
        die("Unable to load data.".mysqli_error($con));
    }
    echo "<div class='col'><table id='done'><caption>Done</caption><tr><th>Code</th><th>Name</th><th>DomainFunction</th><th>Dept</th><th>Utilization</th></tr>";
    while($row = mysqli_fetch_array($status,MYSQLI_NUM)){
        echo "<tr><td>".$row[0]."</td>";
        echo "<td>".$row[1]."</td>";
        echo "<td>".$row[2]."</td>";
        echo "<td>".$row[3]."</td>";
        echo "<td>".$row[4]."%<ol><li>Volvo : 40 hrs</li><li>Volvo : 40 hrs</li></ol></td></tr>";
    }   
    echo "</table></div>";
    $select = "select codeminus1, nameMinus1 from lminus where codeplus1 = '$codeplus' and codeminus1 NOT IN (select codeminus from details where wdate = '$date' and codeLplus1 = '$codeplus')";
    $status = mysqli_query($con,$select);
    if(!$status){
        die("Unable to load data.".mysqli_error($con));
    }
    echo "<div class='col'><table id='rem'><caption>Remaining</caption><tr><th>Code</th><th>Name</th></tr>";
    $codelist = array();
    $i = 0;
    while($row = mysqli_fetch_array($status,MYSQLI_NUM)){
        $codelist[$i++] = $row[0];
        echo "<tr><td>".$row[0]."</td>";
        echo "<td>".$row[1]."</td></tr>";
    }   
    echo "</table></div>";
    echo $row[0];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Project</title>
	<link type="text/css" rel="stylesheet" href="main.css" />
</head>
<body>
	
    <ul>
        <li class="li"><a href="index.php">Home</a></li>
        <li class="li"><a href="admin.php">Admin Login</a></li>
        <li class="li"><a href="filldetails.php" class="active">Fill Details</a></li>
        <li class="li" style="float:right"><a href="logout.php">Logout</a></li>
        <li class="li" style="float:right"><a ><span>You are logged in as: <?php echo $_SESSION['user'];?></span> </a></li>
    </ul> 
<div id="filldetailsform" class="col">
    <form method="post">
        <h1>Fill Details:</h1>
        <label >Code</label> 
		<input type="text" name="code" placeholder="Enter code of L-1" list="codeList">
        <datalist id="codeList">
            <?php 
                for($i=0; $i<count($codelist); $i++){
                    echo "<option>".$codelist[$i]."</option>";
                }
            ?>
        </datalist>
		<!--<label >Name</label> 
		<input type="text" name="name" placeholder="Enter name of L-1">
		<label >Domain Function</label> 
        <input type="text" name="domain">
        <label >Department</label> 
		<input type="text" name="department" >-->
		<label >Project</label> 
        <input type="text" name="project" list="projectNames" />
        <datalist id="projectNames">
          <option>Volvo</option>
          <option>Saab</option>
          <option>Mercedes</option>
          <option>Audi</option>
        </datalist>
        <label>Working Hours for a week of <?php echo $_SESSION["date"] ?></label>
        <input type="number" name="utilization" min="0" max="42.5" placeholder="eg: 20 ( Expanation: 5 hrs/day * 4 days = 20 hrs/week )"  step="0.1">
        <input type="submit" name="submit"><hr>
    </form> 
</div> 
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
        /*$name = $_POST["name"];
		$domain = $_POST["domain"];
		$department = $_POST["department"];*/
		$project = $_POST["project"];
        $date = $_SESSION["date"];
        $hours = $_POST["utilization"];	
		//$sql = "INSERT INTO details(codeLplus1, nameLplus1, codeminus, ename, domain, department, project, wdate, utilization) VALUES ('$codeLplus', '$nameLplus', '$code', '$name', '$domain', '$department', '$project', '$date', '$utilization')";
        $sql = "INSERT INTO details(codeLplus1, nameLplus1, codeminus, wdate) VALUES ('$codeLplus', '$nameLplus', '$code', '$date')";
        $status = mysqli_query($con, $sql);
		if(!$status){
            
        }
        $sql = "select seq from details where codeLplus1='$codeLplus' and codeminus='$code' and wdate='$date'";
        $status = mysqli_query($con, $sql);
		if(!$status){
		 	die(mysqli_error($con));
        }
        $row = mysqli_fetch_array($status,MYSQLI_NUM);
        $seq = $row[0];
        $sql = "insert into project (id, name, hours) values('$seq','$project','$hours')";
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
