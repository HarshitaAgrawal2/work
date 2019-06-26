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
        if(isset($input['Namep'])) {
            $update_field.= "Namep='".$input['Namep']."'";
        } 
        //else if(isset($input['address'])) {
            //$update_field.= "address='".$input['address']."'";
        //} 

        if($update_field && $input['username']) {
            echo "Hiiiiiiiiiiiiiii";
            $sql_query = "UPDATE user SET $update_field WHERE username='" . $input['username'] . "'";
            mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
        }
        else{
            echo "byeeee";
        }
    }
?>