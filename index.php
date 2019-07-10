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
            $selectedWeekNo = date("W", strtotime($date));
            $todayWeekNo = date("W", strtotime(date("Y/m/d")));
            if($selectedWeekNo >= $todayWeekNo){
                if($d=='Monday'){
                    $_SESSION['date'] = $_POST["date"];
                    header("Location:filldetails.php");
                }
                else{
                    $msg = "* Select monday's date";
                }
            }
            else{
                $msg = "* You cannot select previous week day";
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
<!--	
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
    function EnableMonday(date) {
        var day = date.getDay();  
        // If day == 1 then it is Monday
        if (day == 1) {
            return [true] ; 
        } 
        else { 
            return [false] ;
        }
    }
    $(function() {
        $( "#datepicker" ).datepicker({
            beforeShowDay: EnableMonday,
            dateFormat: ' d MM, yy' ,
            showWeek: true,
            firstDay: 1,
            minDate: '-6d'
        });
    });
</script>-->
<style>
#datepicker{
    border: 1px solid teal;
    color: teal;
}
.userSideForm{
    margin-left:30%;
}
</style>
    <ul>
        <li class="li"><a class="active" href="index.php">Home</a></li>
        <li class="li"><a href="admin.php">Admin</a></li>
        <li class="li" style="float:right"><a href="logout.php">Logout</a></li>
        <li class="li" style="float:right"><a ><span>You are logged in as: <?php echo $_SESSION['nam'];?></span> </a></li>
    </ul>  <br><br><br> <img src="logo.png" width="15%"><br>
	<form method="post" class="userSideForm"  style="border-radius:5px; width:40%" autocomplete="off">
		<h1 style="font-size:15px">Select starting date of week for which you want to forecast utilization of your Ls.:</h1>
        <label style="font-size:15px" >Date: </label>
        <input type="date" name="date" style="width:40%;" id="datepicker"> <br> 
        <input type="submit" name="submit" value="Next" class="btn" style="font-size:15px">
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