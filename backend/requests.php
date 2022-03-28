<?php
include_once "connection.php";
    $requests = array();
    if ($result = mysqli_query($mysqli,"SELECT users.username,phoneno,city,vaccinename,slotdate from users INNER JOIN slotbook on users.username = slotbook.username AND slotbook.accepted = 0;")) {
        if($result->num_rows > 0){
            while($data = mysqli_fetch_array($result)){
                array_push($requests,$data);
            }
            echo json_encode(["data"=>$requests,"status"=>1]);
        }
        else{
            echo json_encode(["data"=>"No Requests Available","status"=>0]);
        }
    }
    else{
        echo json_encode(["data"=>"No Requests Available","status"=>0]);
    }
?>