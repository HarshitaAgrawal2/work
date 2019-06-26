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
    echo "dfkjsdf";
    if ($input['action'] == 'edit') {

        $update_field='';
        if(isset($input['name'])) {
            $update_field.= "name='".$input['name']."'";
        } 
        else if(isset($input['hours'])) {
            $update_field.= "hours='".$input['hours']."'";
        } 

        if($update_field && $input['inc']) {
            echo "Hiiiiiiiiiiiiiii";
            $sql_query = "UPDATE project SET $update_field WHERE inc='" . $input['inc'] . "'";
            mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
        }
        else{
            echo "byeeee";
        }
    }
?>