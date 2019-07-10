<?php 
    $url = "localhost:3306";
    $user = "root";
    $psw = "";
    $con = mysqli_connect($url, $user, $psw);
    if(!$con){
        die("Unable to connect");
    } 
    mysqli_select_db($con,'harshi');
    $sql_query = "SELECT * FROM details LIMIT 10";
    $resultset = mysqli_query($con, $sql_query) or die("database error:". mysqli_error($con));
    $developer_records = array();
    while( $rows = mysqli_fetch_assoc($resultset) ) {
        $developer_records[] = $rows;
    }
    if(isset($_POST["export_data"])) {
        $filename = "utilization".date('Ymd') . ".xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $show_coloumn = false;
        if(!empty($developer_records)) {
            foreach($developer_records as $record) {
                if(!$show_coloumn) {
                    // display field/column names in first row
                    echo implode("\t", array_keys($record)) . "\n";
                    $show_coloumn = true;
                }
                echo implode("\t", array_values($record)) . "\n";
            }
        }
        exit;
    }
?>
<div class="container">
<h2>Export Data to Excel with PHP and MySQL</h2>
<div class="well-sm col-sm-12">
<div class="btn-group pull-right">
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
<button type="submit" id="export_data" name='export_data' value="Export to excel" class="btn btn-info">Export to excel</button>
</form>
</div>
</div>
<table id="" class="table table-striped table-bordered">
<tr>
<th>Date</th>
<th>Utilization</th>

</tr>
<tbody>
<?php foreach($developer_records as $developer) { ?>
<tr>
<td><?php echo $developer ['wdate']; ?></td>
<td><?php echo $developer ['utilization']; ?></td>

</tr>
<?php } ?>
</tbody>
</table>
</div>