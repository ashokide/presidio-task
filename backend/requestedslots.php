<?php
include_once "connection.php";
session_start();
$requested = array();
if ($result = mysqli_query($mysqli, "SELECT * FROM slotbook where username = '" . $_SESSION['username'] . "' AND accepted = 0")) {
    if ($result->num_rows > 0) {
        while ($data = mysqli_fetch_array($result)) {
            array_push($requested, $data);
        }
        echo json_encode(["data" => $requested, "status" => 1]);
    } else {
        echo json_encode(["data" => "No Requested Slots Available", "status" => 0]);
    }
} else {
    echo json_encode(["data" => "No Requested Slots Available", "status" => 0]);
}
?>