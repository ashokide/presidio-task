<?php
include_once "connection.php";
    $slots = array();
    if ($result = mysqli_query($mysqli,"SELECT * from slots;")) {
        if($result->num_rows > 0){
            while($data = mysqli_fetch_array($result)){
                array_push($slots,$data);
            }
            echo json_encode(["data"=>$slots,"status"=>1]);
        }
        else{
            echo json_encode(["data"=>"No Slots Available","status"=>0]);
        }
    }
    else{
        echo json_encode(["data"=>"No Slots Available","status"=>0]);
    }
?>