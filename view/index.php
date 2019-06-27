<?php
    // Check if user has requested to get detail
    if (isset($_POST["get_data"]))
    {
        // Get the ID of customer user has selected
        $seq = $_POST["id"];

        // Connecting with database
        $connection = mysqli_connect("localhost", "root", "", "harshi");

        // Getting specific customer's detail
        $sql = "SELECT * FROM project where id='$seq' ";
        $result = mysqli_query($connection, $sql);
       
//
        
$return_arr = array();

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


//

        // Important to echo the record in JSON format
        //echo json_encode($groups);

        // Important to stop further executing the script on AJAX by following line
        exit();
    }
?>

<?php
    // Connecting with database and executing query
    $connection = mysqli_connect("localhost", "root", "", "harshi");
    $sql = "SELECT * FROM details";
    $result = mysqli_query($connection, $sql);
?>

<!-- Include bootstrap & jQuery -->
<link rel="stylesheet" href="bootstrap.css" />
<script src="jquery-3.3.1.min.js"></script>
<script src="bootstrap.js"></script>

<!-- Creating table heading -->
<div class="container">
    <table class="table">
        <tr>
            <th>Code of L</th>
            <th>Date</th>
            <th>utilization</th>
            <th>Actions</th>
        </tr>

        <!-- Display dynamic records from database -->
        <?php while ($row = mysqli_fetch_object($result)) { ?>
            <tr>
                <td><?php echo $row->codeminus; ?></td>
                <td><?php echo $row->wdate; ?></td>
                <td><?php echo $row->utilization; ?></td>
                <!--Button to display details -->
        <td>
            <button class = "btn btn-primary" onclick="loadData(this.getAttribute('data-id'));" data-id="<?php echo $row->seq; ?>">
                Project Details
            </button>
        </td>
            </tr>
        <?php } ?>
    </table>
</div>

<script>
    function loadData(id) {
        console.log(id);
        $.ajax({
            url: "index.php",
            method: "POST",
            data: {get_data: 1, id: id},
            success: function (response) {
                response = $.parseJSON(response);
                var len = response;
                var html = "<table class='project_table'><tr><th>Seq</th><th>Project</th><th>Hours</th></tr>";

                for(var i=0; i<len; i++){
                    var inc = response[i].inc;
                    var name = response[i].name;
                    var hours = response[i].hours;

                   // html += "<tr id=" +"'"+ inc +"'"+ "><td>" + inc + "</td>";
                    html += "<td>" + name + "</td>";
                    html += "<td>" + hours + "</td></tr>";
                }
                html += "</table>";
                
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
               Customer Detail
            </h4>

            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
               ×
            </button>
         </div>
         
         <div id = "modal-body">
            Press ESC button to exit.
         </div>
         
         <div class = "modal-footer">
            <button type = "button" class = "btn btn-default" data-dismiss = "modal">
               OK
            </button>
         </div>
         
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
   
</div><!-- /.modal -->