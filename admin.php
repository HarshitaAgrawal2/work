<?php
    session_start();
    if (isset($_SESSION["admin"])) {
    }
    else{
        header("Location:adminlogin.php");
    }
    $url = "localhost:3306";
    $user = "root";
    $psw = "";
    $con = mysqli_connect($url, $user, $psw);
    if(!$con){
        die("Unable to connect");
    } 
    mysqli_select_db($con, 'harshi');
    ///////
    $select = "select namep from projectList ORDER BY namep";
    $status = mysqli_query($con,$select);
    if(!$status){
        die("Unable to load project data.".mysqli_error($con));
    }
    $projectlist = array();
    $i = 0;
    while($row = mysqli_fetch_array($status,MYSQLI_NUM)){
        $projectlist[$i++] = $row[0];
    }
    ////
    ///////
    $select = "SELECT DISTINCT domain FROM lminus order by domain";
    $status = mysqli_query($con,$select);
    if(!$status){
        die("Unable to load domain data.".mysqli_error($con));
    }
    $domainlist = array();
    $i = 0;
    while($row = mysqli_fetch_array($status,MYSQLI_NUM)){
        $domainlist[$i++] = $row[0];
    }
    ////
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
    .adminSideForm{
        border-radius:5px;
        width:30%;
        margin-left:35%;
    }
    .adminSideForm input[type="submit"]{
        font-size:15px;
        width:fit-content;
    }
    table td{
        text-align:left;
    }
</style>
<body>	

    <ul>
        <li class="li"><a class="active" href="admin.php">Admin Home</a></li>
        <li class="li"><a href="index.php">L+1</a></li>
        <li class="li" style="float:right"><a href="logout.php">Logout</a></li>
        <li class="li" style="float:right"><a ><span>You are logged in as: <?php echo $_SESSION['admin'];?></span> </a></li>
        <li class="li"><a href="entry.php">Add L/L+1</a></li>
        <li class="li"><a href="excel.php">Upload Project list</a></li>
        <li class="li"><a href="exceluploadplus.php">Upload L+1 list</a></li>
        <li class="li"><a href="exceluploadL.php">Upload L list</a></li>
    </ul>
    <br><br><br> <img src="logo.png" width="15%"><br>
	<form method="post" class="adminSideForm" style="font-size:15px"> 
        <br>
        <label >Date (From)</label> 
        <input type="date" name="date" value="<?php echo isset($_POST['date']) ? $_POST['date'] : '' ?>">
        <label >Date (To)</label> 
        <input type="date" name="todate" value="<?php echo isset($_POST['todate']) ? $_POST['todate'] : '' ?>">
        <label>Utilization below :</label>
        <input type="number" min="0" max="100" name="belowfilter" >
        <label>Utilization above :</label>
        <input type="number" min="0" max="100" name="abovefilter" >
        <label >Project</label> 
        <select name="projectfilter">
            <option value="" selected>Select</option>
<?php 
                for($i=0; $i<count($projectlist); $i++){
                    echo "<option>".$projectlist[$i]."</option>";
                }
?>
        </select> <br><br>
        <label >Domain Function</label> 
        <select name="domainfilter">
            <option value="" selected>Select</option>
<?php
                for($i=0; $i<count($domainlist); $i++){
                    echo "<option>".$domainlist[$i]."</option>";
                }
?>

        </select> <br><br>
        <input type="submit" name="show_details" class="btn" value="Generate Report">
	</form> <br>
</body>
<style>
table th{
    height: 80px;
    width: 100px;
}
</style>
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
        $bel = $_POST['belowfilter'];
        $ab = $_POST['abovefilter'];
        $proj = $_POST['projectfilter'];
        $dom = $_POST['domainfilter'];
        if($date=="" || $todate==""){
            die( '<div style="color:red; text-align:center ; font-size:20px">* Select date range</div>');
        }
        $sql = "select wdate from details where wdate >= '$date' and wdate <= '$todate' group by wdate";
        $st = mysqli_query($con,$sql);
        if(!$st){
		    die("Unable to load data.".mysqli_error($con));
        }
        $tableCount = 0;
        $count = 0;
        while($dr = mysqli_fetch_array($st,MYSQLI_NUM)){
            $date = $dr[0];
            if($bel=="" && $ab=="" && $proj=="" && $dom==""){
                $select = "select * from lminus as A left join (select * from details where wdate='$date') as B on A.codeplus1=B.codeLplus1 and A.codeminus1=B.codeminus left join user on user.username = codeplus1 order by A.codeplus1, A.codeminus1";
                $status = mysqli_query($con,$select);
                if(!$status){
                    die("Unable to load data.".mysqli_error($con));
                }
                $d = date("l, F d, Y", strtotime($date));
                if($tableCount==0){
                    echo "<table class='hitable'><tr><th>Employee code of L+1</th><th>L+1 Name/data given by</th><th>Name of L</th><th>DomainFunction of L</th><th>Dept of L</th><th wrap>".$d."</th></tr>";
                    $rowCount = 0; 
                    while($row = mysqli_fetch_array($status,MYSQLI_NUM)){
                        $rowCount++;
                        echo "<tr><td>".$row[0]."</td>";
                        echo "<td>".$row[13]."</td>";
                        echo "<td>".$row[2]."</td>";
                        echo "<td>".$row[3]."</td>";
                        echo "<td>".$row[4]."</td>";
                        if($row[10]==""){
                            echo "<td style='background-color:red;'>Not filled</td></tr>"; 
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
                            echo "<td style='background-color:red;'>Not filled</td></tr>"; 
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
                if($bel=="" && $ab=="" && $proj=="" && $dom==""){
                    $select = "select round(avg(utilization),2) from lminus as A left join (select * from details where wdate between '$start' and '$todate') as B on A.codeplus1=B.codeLplus1 and A.codeminus1=B.codeminus left join user on user.username = codeplus1 group by A.codeplus1, A.codeminus1 order by A.codeplus1, A.codeminus1";
                    $status = mysqli_query($con,$select);
                    if(!$status){
                        die("Unable to load data.".mysqli_error($con));
                    }
                    echo "<table class='hitable'><tr><th>Average utilization of a month</th></tr>";
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
            }
            else if($ab=="" && $dom=="" && $proj==""){
                if($count==0){
                    echo "<b>Report for Utilization below ".$bel."%</b><br><br>";
                    $count=1;
                }
                $select = "SELECT * FROM `details` left join lminus on codeminus=lminus.codeminus1 WHERE wdate='$date' and utilization <= $bel";
                $status = mysqli_query($con,$select);
                if(!$status){
                    die("Unable to load data.".mysqli_error($con));
                }
                $d = date("l, F d, Y", strtotime($date));
                echo "<table class='hitable'><tr><th>Employee code of L+1</th><th>Name of L</th><th>DomainFunction of L</th><th>Dept of L</th><th>".$d."</th></tr>";
                $rowCount = 0; 
                while($row = mysqli_fetch_array($status,MYSQLI_NUM)){
                    $rowCount++;
                    echo "<tr>";
                    echo "<td>".$row[1]."</td>";
                    //echo "<td>".$row[3]."</td>";
                    echo "<td>".$row[8]."</td>";
                    echo "<td>".$row[9]."</td>";
                    echo "<td>".$row[10]."</td>";
                    echo "<td>".$row[5]."</td>";
                }
                echo "</table>";
                echo "<br><br><br><br><br>";    
            }
            else if($bel=="" && $dom=="" && $proj==""){
                if($count==0){
                    echo "<b>Report for Utilization above ".$ab."%</b><br><br>";
                    $count=1;
                }
                $select = "SELECT * FROM `details` left join lminus on codeminus=lminus.codeminus1 WHERE wdate='$date' and utilization >= $ab";
                $status = mysqli_query($con,$select);
                if(!$status){
                    die("Unable to load data.".mysqli_error($con));
                }
                $d = date("l, F d, Y", strtotime($date));
                echo "<table class='hitable'><tr><th>Employee code of L+1</th><th>Name of L</th><th>DomainFunction of L</th><th>Dept of L</th><th>".$d."</th></tr>";
                $rowCount = 0; 
                while($row = mysqli_fetch_array($status,MYSQLI_NUM)){
                    $rowCount++;
                    echo "<tr>";
                    echo "<td>".$row[1]."</td>";
                    //echo "<td>".$row[3]."</td>";
                    echo "<td>".$row[8]."</td>";
                    echo "<td>".$row[9]."</td>";
                    echo "<td>".$row[10]."</td>";
                    echo "<td>".$row[5]."</td>";
                }
                echo "</table>";
                echo "<br><br><br><br><br>";    
            }
            else if($dom=="" && $proj==""){
                if($count==0){
                    echo "<b>Report for Utilization above ".$ab."% and below ".$bel."%</b><br><br>";
                    $count=1;
                }
                $select = "SELECT * FROM `details` left join lminus on codeminus=lminus.codeminus1 WHERE wdate='$date' and utilization between $ab and $bel";
                $status = mysqli_query($con,$select);
                if(!$status){
                    die("Unable to load data.".mysqli_error($con));
                }
                $d = date("l, F d, Y", strtotime($date));
                echo "<table class='hitable'><tr><th>Employee code of L+1</th><th>Name of L</th><th>DomainFunction of L</th><th>Dept of L</th><th>".$d."</th></tr>";
                $rowCount = 0; 
                while($row = mysqli_fetch_array($status,MYSQLI_NUM)){
                    $rowCount++;
                    echo "<tr>";
                    echo "<td>".$row[1]."</td>";
                   // echo "<td>".$row[3]."</td>";
                    echo "<td>".$row[8]."</td>";
                    echo "<td>".$row[9]."</td>";
                    echo "<td>".$row[10]."</td>";
                    echo "<td>".$row[5]."</td>";
                }
                echo "</table>";
                echo "<br><br><br><br><br>";    
            }
        }
        //
        
        //
    }
    echo "<br><br><br>";
?>