<?php
include_once "connection.php";
session_start();
$accepted = array();
if ($result = mysqli_query($mysqli, "SELECT * FROM slotbook where username = '" . $_SESSION['username'] . "' AND accepted = 1")) {
    if ($result->num_rows > 0) {
        while ($data = mysqli_fetch_array($result)) {
            array_push($accepted, $data);
        }
        echo json_encode(["data" => $accepted, "status" => 1]);
    } else {
        echo json_encode(["data" => "No Accepted Slots Available", "status" => 0]);
    }
} else {
    echo json_encode(["data" => "No Accepted Slots Available", "status" => 0]);
}
?>