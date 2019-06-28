<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="tabledit.js"></script>
<script type="text/javascript" src="eg.js"></script>
<?php
$msg1="";
$msg2="";
$msg3="";
if(isset($_POST['submit'])){
    if(empty($_POST['codep'])){
        $msg1 = "* code is required";
    }
    if(empty($_POST['name'])){
        $msg2 = "* name is required";
    }
    if(empty($_POST['password'])){
        $msg3 = "* password is required";
    }
}
$msg11="";
$msg12="";
$msg13="";
$msg14="";
$msg15="";
if(isset($_POST['submitm'])){
    if(empty($_POST['codem'])){
        $msg11 = "* code is required";
    }
    if(empty($_POST['namem'])){
        $msg12 = "* name is required";
    }
    if(empty($_POST['domain'])){
        $msg13 = "* domain is required";
    }
    if(empty($_POST['dept'])){
        $msg14 = "* department is required";
    }
    if(empty($_POST['code'])){
        $msg15 = "* code of L+1 is required";
    }
}
?>
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
        <li class="li"><a href="excel.php">Upload Project list</a></li>
    </ul>
    <br><br><br> <img src="logo.png" width="15%"> <br>
<div class="admincol">
	<form method="post">
      
		<h1>Add L+1:</h1>
        <label >Code</label>  <div id="error_msg"><?php echo $msg1 ; ?></div>
		<input type="text" name="codep" placeholder="Type code of L+1" value="<?php echo isset($_POST['codep']) ? $_POST['codep'] : '' ?>">
		<label >Name</label>  <div id="error_msg"><?php echo $msg2 ; ?></div>
		<input type="text" name="name" placeholder="Type name of L+1" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>">
		<label>Password</label> <div id="error_msg"><?php echo $msg3 ; ?></div>
		<input type="password" name="password"  placeholder="Set password for L+1" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>"> 
        <input type="submit" name="submit" class="btn"> <br><br>
    </form>
</div>
<div class="admincol">
  
	<form method="post">
        <h1>Add L:</h1>
        <label >Code</label> <div id="error_msg"><?php echo $msg11 ; ?></div>
		<input type="text" name="codem" placeholder="Type code of L-1" value="<?php echo isset($_POST['codem']) ? $_POST['codem'] : '' ?>">
		<label >Name</label> <div id="error_msg"><?php echo $msg12 ; ?></div>
		<input type="text" name="namem" placeholder="Type name of L-1" value="<?php echo isset($_POST['namem']) ? $_POST['namem'] : '' ?>">
        <label >Domain Function</label> <div id="error_msg"><?php echo $msg13 ; ?></div>
		<input type="text" name="domain" placeholder="eg: RETAIL, TECH" value="<?php echo isset($_POST['domain']) ? $_POST['domain'] : '' ?>">
        <label >Department</label> <div id="error_msg"><?php echo $msg14 ; ?></div>
		<input type="text" name="dept" placeholder="eg: BU2" value="<?php echo isset($_POST['dept']) ? $_POST['dept'] : '' ?>">
        <label >Code of his L+1</label> <div id="error_msg"><?php echo $msg15 ; ?></div>
		<input type="text" name="code" placeholder="Type code of L+1" value="<?php echo isset($_POST['code']) ? $_POST['code'] : '' ?>">
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
        if(empty($_POST['codep']) || empty($_POST['name']) || empty($_POST['password'])){
            die();
        }
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
        if(empty($_POST['codem']) || empty($_POST['namem'])  || empty($_POST['dept'])|| empty($_POST['domain'])|| empty($_POST['code'])){
            die();
        }
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
        echo "<table id='data_table'><tr><th>Code</th><th>Name of L+1</th></tr>";
        while($row = mysqli_fetch_assoc($status)) {
            echo "<tr id=". $row['username'] ."><td>".$row['username']."</td>" ;
            echo "<td>".$row['Namep']."</td></tr>" ; 
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