<?php
    $url = "localhost:3306";
    $user = "root";
    $psw = "";
    $conn = mysqli_connect($url, $user, $psw);
    if(!$conn){
        die("Unable to connect");
    } 
    mysqli_select_db($conn,'harshi');
    
    $input = filter_input_array(INPUT_POST);
    
    if ($input['action'] == 'edit') {

        $update_field='';
        if(isset($input['name'])) {
            $update_field.= "name='".$input['name']."'";
        } 
        else if(isset($input['hours'])) {
            $update_field.= "hours='".$input['hours']."'";
        } 

        if($update_field && $input['inc']) {
            $inc = $input['inc'];
            $sql = "select id, hours from project where inc='$inc'";
            $res = mysqli_query($conn, $sql);
            $r = mysqli_fetch_array($res,MYSQLI_NUM);
            $id = $r[0];
            $h = $r[1];
            $sql = "select sum(hours) from project where id='$id'";
            $res = mysqli_query($conn, $sql);
            $r = mysqli_fetch_array($res,MYSQLI_NUM);
            $sum = $r[0];
            $hrs = $input['hours'];
            $sum = $sum + $hrs -$h;
            if($sum<=42.5){
                $sql_query = "UPDATE project SET $update_field WHERE inc='" . $input['inc'] . "'";
                mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
            }
        }
    }
?>


