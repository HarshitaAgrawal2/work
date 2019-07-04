
<?php
include("Classes/PHPExcel.php");

$connect = mysqli_connect("localhost", "root", "", "harshi");
$output = '';
if(isset($_POST["import"]))
{
 $variable = explode(".", $_FILES["excel"]["name"]);
 $extension = end($variable); // For getting Extension of selected file
 $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
 if(in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
 {
  $file = $_FILES["excel"]["tmp_name"]; // getting temporary source of excel file
  //include("phpexcel.php"); // Add PHPExcel Library in this code
  $objPHPExcel = PHPExcel_IOFactory::load($file); // create object of PHPExcel library by using load() method and in load method define path of selected file

  $output .= "<label class='text-success'>Data Inserted</label><br /><table class='table table-bordered'><tr><th>code of L</th><th>Name of L</th><th>Domain Function</th><th>Department</th><th>Code of L+1</th></tr>";
  foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
  {
   $highestRow = $worksheet->getHighestRow();
   for($row=2; $row<=$highestRow; $row++)
   {
    
    $code = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
    $Name = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
    $dom = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
    $dept = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
    $codep = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
    $query = "INSERT INTO lminus(codeplus1, codeminus1, nameMinus1, domain, dept) VALUES ('$codep','$code','$Name','$dom','$dept')";
    $status = mysqli_query($connect, $query);
    if($status){
        $output .= "<tr>";
        $output .= '<td>'.$code.'</td>';
        $output .= '<td>'.$Name.'</td>';
        $output .= '<td>'.$dom.'</td>';
        $output .= '<td>'.$dept.'</td>';
        $output .= '<td>'.$codep.'</td>';
        $output .= '</tr>';
    }
   }
  } 
  $output .= '</table><br><br>';
 }
 else
 {
  $output = '<label class="text-danger">Invalid File</label>'; //if non excel file then
 }
}
?>

<html>
 <head>
  <title>Project</title>
 <link type="text/css" rel="stylesheet" href="main.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
  <style>
  body
  {
   margin:0;
   padding:0;
   background-color:#f1f1f1;
  }
  .box
  {
    width: 40%;
    border: 1px solid black;
    background-color: white;
    border-radius: 5px;
    margin-top: 20px;
  }
  a:hover{
    text-decoration: none;
    color:white;
  }
  </style>
 </head>
 <body>
    <ul>
        <li class="li"><a  href="admin.php">Admin Home</a></li>
        <li class="li"><a href="index.php">L+1</a></li>
        <li class="li" style="float:right"><a href="logout.php">Logout</a></li>
        <li class="li" style="float:right"><a ><span>You are logged in as: <?php session_start(); echo $_SESSION['admin'];?></span> </a></li>
        <li class="li"><a href="entry.php">Add L/L+1</a></li>
        <li class="li"><a href="excel.php">Upload Project list</a></li>
        <li class="li"><a href="exceluploadplus.php">Upload L+1 list</a></li>
        <li class="li"><a class="active" href="exceluploadL.php">Upload L list</a></li>
    </ul>
    <br><br><br> <img src="logo.png" width="15%"><br>
  <div class="container box">
   <h2 align="center">Import L excel file to database</h2><br />
   <table><caption>Data format</caption><tr><th>code of L</th><th>Name of L</th><th>Domain Function</th><th>Department</th><th>Code of L+1</th></tr></table> <br><br>
   <form method="post" enctype="multipart/form-data">
    <label>Select Excel File</label>
    <input type="file" name="excel" />
    <br />
    <input type="submit" name="import" class="btn btn-info" value="Import" />
   </form>
   <br />
   <br />
   <?php
   echo $output;
   ?>
  </div>
 </body>
</html>