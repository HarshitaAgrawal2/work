<?php
    session_start();
    if (isset($_SESSION["user"])) {
    }
    else{
        header("Location:userlogin.php");
    }
    $msg ="";
    if (isset($_POST["submit"])) {
        if(empty($_POST['date'])){
            $msg="* Date is required";
        }
        else{
            $date = $_POST["date"];
            $d = date("l", strtotime($date));
            if($d=='Monday'){
                $_SESSION['date'] = $_POST["date"];
		        header("Location:filldetails.php");
            }
            else{
                $msg = "* Select monday's date";
            }
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
        <li class="li"><a class="active" href="index.php">Home</a></li>
        <li class="li"><a href="admin.php">Admin</a></li>
        <li class="li" style="float:right"><a href="logout.php">Logout</a></li>
        <li class="li" style="float:right"><a ><span>You are logged in as: <?php echo $_SESSION['user'];?></span> </a></li>
    </ul>  <br><br><br> <img src="logo.png" width="15%"><br>
	<form method="post" class="userSideForm">
		<h1>Enter current week Monday's date:</h1>
        <label >Date</label> 
        <input type="date" name="date">
        <input type="submit" name="submit" value="Submit and next" class="btn">
        <div id="error_msg"><?php echo $msg ; ?></div>
	</form> 
</body>
</html>
<?php
    
	if (isset($_POST["submit"])) {
        if(empty($_POST['date'])){
            die();
        }
        
	}
	if (isset($_POST["logout"])) {
        session_destroy();
        header("Location:userlogin.php");
    }
?>