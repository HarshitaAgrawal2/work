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
	<link type="text/css" rel="stylesheet" href="main.css" />
</head>
<style>
    form{
        border: 2px solid black;
        padding: 10px;
    }
</style>
<body>	

    <ul>
        <li class="li"><a class="active" href="admin.php">Admin Home</a></li>
        <li class="li"><a href="index.php">User</a></li>
        <li class="li" style="float:right"><a href="logout.php">Logout</a></li>
        <li class="li" style="float:right"><a ><span>You are logged in as: <?php echo $_SESSION['admin'];?></span> </a></li>
        <li class="li"><a href="entry.php">Add User</a></li>
    </ul>
    <br><br><br> <img src="logo.png" width="15%"><br>
	<form method="post" class="adminSideForm"> 
        <br>
        <label >Date (From)</label> 
        <input type="date" name="date" value="<?php echo isset($_POST['date']) ? $_POST['date'] : '' ?>">
        <label >Date (To)</label> 
        <input type="date" name="todate" value="<?php echo isset($_POST['todate']) ? $_POST['todate'] : '' ?>">
        <input type="submit" name="show_details" class="btn" value="Generate Report">
	</form> <br>
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
        $start = $date;
        $todate = $_POST["todate"];
        $sql = "select wdate from details where wdate >= '$date' and wdate <= '$todate' group by wdate";
        $st = mysqli_query($con,$sql);
        if(!$st){
		    die("Unable to load data.".mysqli_error($con));
        }
        $tableCount = 0;
        while($dr = mysqli_fetch_array($st,MYSQLI_NUM)){
            $date = $dr[0];
            $select = "select * from lminus as A left join (select * from details where wdate='$date') as B on A.codeplus1=B.codeLplus1 and A.codeminus1=B.codeminus left join user on user.username = codeplus1 order by A.codeplus1, A.codeminus1";
            $status = mysqli_query($con,$select);
            if(!$status){
                die("Unable to load data.".mysqli_error($con));
            }
            $d = date("l, F d, Y", strtotime($date));
            if($tableCount==0){
                echo "<table class='hitable'><tr><th>Code</th><th>L+1/data given by</th><th>Name</th><th>DomainFunction</th><th>Dept</th><th>".$d."</th></tr>";
                $rowCount = 0; 
                while($row = mysqli_fetch_array($status,MYSQLI_NUM)){
                    $rowCount++;
                    echo "<tr><td>".$row[0]."</td>";
                    echo "<td>".$row[13]."</td>";
                    echo "<td>".$row[2]."</td>";
                    echo "<td>".$row[3]."</td>";
                    echo "<td>".$row[4]."</td>";
                    if($row[10]==""){
                        echo "<td style='background-color:red;'>--</td></tr>"; 
                    }
                    else{
                        echo "<td>".$row[10]." %</td></tr>"; 
                    }
                }
                echo "</table>";
            }
            else{
                echo "<table class='hitable'><tr><th>".$d."</th></tr>";
                $rowCount = 0; 
                while($row = mysqli_fetch_array($status,MYSQLI_NUM)){
                    $rowCount++;
                    echo "<tr>";
                    if($row[10]==""){
                        echo "<td style='background-color:red;'>--</td></tr>"; 
                    }
                    else{
                        echo "<td>".$row[10]." %</td></tr>"; 
                    }
                }
                echo "</table>";
            }
            $tableCount++;
            //if($tableCount==5){
                //$tableCount=0;
            //}
        }
        $select = "select avg(utilization) from lminus as A left join (select * from details where wdate between '$start' and '$todate') as B on A.codeplus1=B.codeLplus1 and A.codeminus1=B.codeminus left join user on user.username = codeplus1 group by A.codeplus1, A.codeminus1 order by A.codeplus1, A.codeminus1";
        $status = mysqli_query($con,$select);
        if(!$status){
            die("Unable to load data.".mysqli_error($con));
        }
        echo "<table class='hitable'><tr><th>Average utilization</th></tr>";
        $rowCount = 0; 
        while($row = mysqli_fetch_array($status,MYSQLI_NUM)){
            $rowCount++;
            echo "<tr>";
            if($row[0]==""){
                echo "<td style='background-color:red;'>--</td></tr>"; 
            }
            else{
                echo "<td>".$row[0]." %</td></tr>"; 
            }
        }
        echo "</table>";
    }
    
?>