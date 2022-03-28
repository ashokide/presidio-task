<?php
include_once "connection.php";

if (isset($_POST['username']) && $_POST['username'] && isset($_POST['vaccinename']) && $_POST['vaccinename'] && isset($_POST['slotdate']) && $_POST['slotdate']) {
    if ($stmt = $mysqli->prepare("SELECT * FROM slotbook WHERE username = ? AND vaccinename = ? AND slotdate = ?")) {
        $stmt->bind_param("sss", $username,$vaccinename, $slotdate);
        $username = $_POST['username'];
        $vaccinename = $_POST['vaccinename'];
        $slotdate = $_POST['slotdate'];
        $stmt->execute();
        $stmt = $stmt->get_result();
        if ($stmt->num_rows == 0) {
            $stmt->close();
            if ($stmt = $mysqli->prepare("INSERT INTO slotbook (username,vaccinename,slotdate) VALUES(?,?,?)")) {
                $stmt->bind_param("sss", $username,$vaccinename, $slotdate);
                $username = $_POST['username'];
                $vaccinename = $_POST['vaccinename'];
                $slotdate = $_POST['slotdate'];
                $stmt->execute();
                echo json_encode(["status" => 1, "msg" => "Slot Requested"]);
            } else {
                echo json_encode(["status" => 0, "msg" => "Error in preparing statement"]);
            }
        } else {
            echo json_encode(["status" => 0, "msg" => "Already Slot exists"]);
        }
    } else {
        echo json_encode(["status" => 0, "msg" => "Error in preparing statement"]);
    }
} else {
    echo json_encode(["status" => 0, "msg" => "Error in preparing statement"]);
}
?>