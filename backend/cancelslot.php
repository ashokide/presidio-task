<?php
include_once "connection.php";
session_start();
if (isset($_POST['username']) && $_POST['username'] && isset($_POST['vaccinename']) && $_POST['vaccinename'] && isset($_POST['slotdate']) && $_POST['slotdate']) {
    if ($stmt = $mysqli->prepare("SELECT * FROM slotbook WHERE username = ? AND slotdate = ? AND vaccinename = ?")) {
        $stmt->bind_param("sss", $username, $slotdate, $vaccinename);
        $username = $_POST['username'];
        $slotdate = $_POST['slotdate'];
        $vaccinename = $_POST['vaccinename'];
        $stmt->execute();
        $stmt = $stmt->get_result();
        if ($stmt->num_rows == 0) {
            $stmt->close();
            echo json_encode(["status" => 0, "msg" => "Slot Not Found"]);
        } else {
            if ($stmt = $mysqli->prepare("DELETE FROM slotbook WHERE AND username = ? AND slotdate = ? AND vaccinename = ?")) {
                $stmt->bind_param("sss", $username, $slotdate, $vaccinename);
                $username = $_POST['username'];
                $slotdate = $_POST['slotdate'];
                $vaccinename = $_POST['vaccinename'];
                $stmt->execute();
                $stmt->close();
                echo json_encode(["status" => 1, "msg" => "Slot Cancelled.Try Other Slots 😊"]);
            } else {
                echo json_encode(["status" => 0, "msg" => "Error in preparing statement"]);
            }
        }
    }
} else {
    echo json_encode(["status" => 0, "msg" => "Invalid Data"]);
}
?>