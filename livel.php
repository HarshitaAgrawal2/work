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
        if(isset($input['Namep'])) {
            $update_field.= "nameMinus1='".$input['Namep']."'";
        } 
        else if(isset($input['domain'])) {
            $update_field.= "domain='".$input['domain']."'";
        } 
        else if(isset($input['dept'])) {
            $update_field.= "dept='".$input['dept']."'";
        } 
        if($update_field && $input['username']) {
            $sql_query = "UPDATE lminus SET $update_field WHERE codeminus1='" . $input['username'] . "'";
            mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
        }
    }
?>