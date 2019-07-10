<?php
 // Check if user has requested to get detail
 if (isset($_POST["get_data"]))
 {
     // Get the ID of customer user has selected
     $seq = $_POST["id"];
    //echo "<script>console.log('okk')</script>";
     // Connecting with database
     $connection = mysqli_connect("localhost", "root", "", "harshi");
     
     $sql = "SELECT sum(hours) FROM project where id='$seq' ";
     $result = mysqli_query($connection, $sql);
     $row = mysqli_fetch_array($result);
     $donehrs = $row[0];
     session_start();
     $return_arr = array();
     $date = $_SESSION['date'];
     $d = date("l, F d, Y", strtotime($date));
     $return_arr[] = array("donehrs" => $donehrs);
     $return_arr[] = array("date" => $d );
     $d = date("W", strtotime($date));
     $return_arr[] = array("week" => $d );

     // Getting specific customer's detail
     $sql = "SELECT * FROM project where id='$seq' ";
     $result = mysqli_query($connection, $sql);

     while($row = mysqli_fetch_array($result)){
         $inc = $row['inc'];
         $name = $row['name'];
         $hours = $row['hours']; 
        
         $return_arr[] = array("inc" => $inc,
                         "name" => $name,
                         "hours" => $hours,
                         );
     }
     // Encoding array in JSON format
     echo json_encode($return_arr);

     // Important to stop further executing the script on AJAX by following line
     exit();
 }
?>

<!-- Include bootstrap & jQuery -->
<link rel="stylesheet" href="view/bootstrap.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="tabledit.js"></script>
<script type="text/javascript" src="eg2.js"></script>
<script src="view/bootstrap.js"></script>

<?php
    session_start();
    if (isset($_SESSION["user"])) {
    }
    else{
        header("Location:userlogin.php");
    }
    echo "<br><br><br> <img src='logo.png' width='15%'><br>";
    $date = $_SESSION['date'];
    $d = date("F d, Y", strtotime($date));
    $w = date("W", strtotime($date));
    echo "<h1 style=' width:fit-content; font-size:18px'>Week starting from ".$d."<br>Week Number of year: ".$w."</h1>";

    $codeplus = $_SESSION['user'];
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
    //////
    $select = "select seq, codeminus, nameMinus1, utilization from details as A left join lminus on A.codeminus=lminus.codeminus1 where A.wdate = '$date' and codeLplus1 = '$codeplus' ORDER BY `A`.`nameLplus1` ASC";
    $status = mysqli_query($con,$select);
    if(!$status){
        die("Unable to load data.".mysqli_error($con));
    }
    $codelist = array();
    $i = 0;
    echo "<div class='col'><table id='done'><caption>Done</caption><tr><th>Employee code</th><th>Name</th><th >Utilization</th><th class='util'>Action</th></tr>";
    while($row = mysqli_fetch_array($status,MYSQLI_NUM)){
        $codelist[$i++] = $row[1];
        $seq = $row[0];
        echo "<tr><td>".$row[1]."</td>";
        echo "<td>".$row[2]."</td>";
        echo "<td><b>".$row[3]."%</b><br>";
        echo "</td>";
        ?>
        <td>
            <button style="font-size:15px" class = "btn btn-primary" onclick="loadData(this.getAttribute('data-id'));" data-id="<?php echo $seq; ?>">
                Project Details
            </button>
        </td>
        <?php
        echo "</tr>";
    }   
    echo "</table></div>";
    $select = "select codeminus1, nameMinus1 from lminus where codeplus1 = '$codeplus' and codeminus1 NOT IN (select codeminus from details where wdate = '$date' and codeLplus1 = '$codeplus')";
    $status = mysqli_query($con,$select);
    if(!$status){
        die("Unable to load data.".mysqli_error($con));
    }
    echo "<div class='col'><table id='rem'><caption>Remaining</caption><tr><th>Employee code</th><th class='util'>Name</th></tr>";
    while($row = mysqli_fetch_array($status,MYSQLI_NUM)){
        $codelist[$i++] = $row[0];
        echo "<tr><td>".$row[0]."</td>";
        echo "<td>".$row[1]."</td></tr>";
    }   
    echo "</table></div>";
    echo $row[0];
    $msg1="";
    $msg2="";
    $msg3="";
    if(isset($_POST['submit'])){
        if(empty($_POST['code'])){
            $msg1 = "* code is required";
        }
        if(empty($_POST['project'])){
            $msg2 = "* project is required";
        }
        if(empty($_POST['utilization'])){
            $msg3 = "* hours is required";
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Project</title>
    <link type="text/css" rel="stylesheet" href="main.css" />
    <style>
        table caption{
            font-size: 20px;
        }
    </style>
</head>
<body>
	
    <ul>
        <li class="li"><a href="index.php">Select date</a></li>
        <li class="li"><a href="admin.php">Admin</a></li>
        <li class="li"><a href="filldetails.php" class="active">Fill Details</a></li>
        <li class="li" style="float:right"><a href="logout.php">Logout</a></li>
        <li class="li" style="float:right; color:white"><a ><span>You are logged in as: <?php echo $_SESSION['nam'];?></span> </a></li>
    </ul> 
<div id="filldetailsform" class="col" >
    <form method="post" autocomplete="off">
        <h1 style="font-size: 25px;">Fill Details:</h1>
        <label >Employee code</label> 
        <input type="text" name="code" placeholder="Enter employee code of L" list="codeList" value="<?php echo isset($_POST['code']) ? $_POST['code'] : '' ?>" >
        <div id="error_msg"><?php echo $msg1 ; ?></div>
        <datalist id="codeList">
<?php 
                for($i=0; $i<count($codelist); $i++){
                    echo "<option>".$codelist[$i]."</option>";
                }
?>
        </datalist>
		<label >Project</label> 
        <select name="project"  >
            <option value="<?php echo isset($_POST['project']) ? $_POST['project'] : '' ?>" selected>Select</option>
<?php 
                for($i=0; $i<count($projectlist); $i++){
                    echo "<option>".$projectlist[$i]."</option>";
                }
?>
        </select>
        <div id="error_msg"><?php echo $msg2 ; ?></div> 
        <label>Billable Hours for a week starting on <?php $d = date("F d, Y", strtotime($date)); echo $d; ?></label>
        <input type="number" name="utilization" min="0" max="42.5" value="<?php echo isset($_POST['utilization']) ? $_POST['utilization'] : '' ?>" placeholder="Expanation: 5 hrs/day * 4 days = 20 hrs/week "  step="0.1">
        <div id="error_msg"><?php echo $msg3 ; ?></div>
        <input type="submit" name="submit"><hr>
    </form> 
</div> 
</body>
</html>
<?php
	if (isset($_POST["submit"])) {
        if(empty($_POST['code']) || empty($_POST['project']) || empty($_POST['utilization'])){
            die();
        }
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
            echo "<div id='error_msg'>* You can enter utilization of resources who work under you</div>" ;
            die();
		}
		$project = $_POST["project"];
        $date = $_SESSION["date"];
        $hours = $_POST["utilization"];	
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
        //sum
        $sql = "select sum(hours) from project where id='$seq'";
        $status = mysqli_query($con, $sql);
		if(!$status){
		 	die(mysqli_error($con));
        }
        $row = mysqli_fetch_array($status,MYSQLI_NUM);
        $sum = $row[0] + $hours;
        //end
        if($sum>42.5){
            echo "<div id='error_msg'>* Sum of hours cannot exceed by <b>42.5</b></div>" ;
            die();
        }
        $sql = "insert into project (id, name, hours) values('$seq','$project','$hours')";
        $status = mysqli_query($con, $sql);
		if(!$status){
            echo "<div id='error_msg'>* Already entered hours for project: <b>".$project."</b>" ;
		 	die();
        }
        //echo "Stored successfully";
    ?>
    <script> location.replace("filldetails.php"); </script>
    <?php
        //header("Location:filldetails.php"); 
        //$_POST = array();
        //echo '<script type="text/javascript">location.reload(true);</script>';
	}
	if (isset($_POST["logout"])) {
        session_destroy();
        header("Location:userlogin.php");
    }
?>

<script>
    function loadData(id) { 
        console.log("details seq=",id);
        $.ajax({
            url: "filldetails.php",
            method: "POST",            
            data: {get_data: 1, id: id},
            success: function (response) {   

                var len = response.length; 
                console.log("Response",response);
                var jsonpar=$.parseJSON(response);  
                console.log("Response length",jsonpar.length);
                var donehrs = jsonpar[0].donehrs;
                var remhrs = 42.5 - donehrs;
                //
               
     //
                var date = jsonpar[1].date;
                var html = "Duration: <b>1 week</b><br>Week starting from <b>"+date+"</b><br>";
                
                var week = jsonpar[2].week;
                html += "Week number of year: <b>"+week+"</b><br><br>";
                
                html += "<table class='project_table'><tr><th>Seq</th><th>Project Name</th><th>Hours build</th></tr>";
                
                for(var i=3; i<jsonpar.length; i++){
                    
                    var inc = jsonpar[i].inc;
                    var name = jsonpar[i].name;
                    var hours = jsonpar[i].hours;
                   
                    html += "<tr id='"+inc+"' ><td>" + inc + "</td>";
                    html += "<td>" + name + "</td>";
                    html += "<td>" + hours + "</td></tr>";
                }
                html += "</table>";
                html += "<br><br>Total hours utilized: "+donehrs+"<br>";
                html += "Remaining hours to be utilized: "+remhrs+"<br>";
                // And now assign this HTML layout in pop-up body
                
                $("#modal-body").html(html);


                $("#myModal").modal();
            }
        });
    }
</script>


<!-- Modal -->
<div class = "modal fade" id = "myModal" tabindex = "-1" role = "dialog" aria-hidden = "true">
   
   <div class = "modal-dialog">
      <div class = "modal-content">
         
         <div class = "modal-header">
            <h4 class = "modal-title">
               Project Detail
            </h4>

            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
               ×
            </button>
         </div>
        
         <div id = "modal-body">
            Press ESC button to exit.
         </div>
         
         <div class = "modal-footer">
            <button type = "button" class = "btn btn-default" data-dismiss = "modal" style="width: fit-content;
    font-size: smaller;">
               Close
            </button>
         </div>
         
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
   
</div><!-- /.modal -->