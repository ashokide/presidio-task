<?php
include_once "connection.php";
if (isset($_POST['username']) && $_POST['username'] && isset($_POST['slotdate']) && $_POST['slotdate']) {
    if ($stmt = $mysqli->prepare("SELECT * FROM slotbook WHERE username = ? AND slotdate = ?")) {
        $stmt->bind_param("ss", $username, $slotdate);
        $username = $_POST['username'];
        $slotdate = $_POST['slotdate'];
        $stmt->execute();
        $stmt = $stmt->get_result();
        if ($stmt->num_rows == 0) {
            $stmt->close();
            echo json_encode(["status" => 0, "msg" => "Slot Not Found"]);
        } else {
            if ($stmt = $mysqli->prepare("UPDATE slotbook SET accepted = 1 WHERE username = ? AND slotdate = ?")) {
                $stmt->bind_param("ss", $username, $slotdate);
                $username = $_POST['username'];
                $slotdate = $_POST['slotdate'];
                $stmt->execute();
                $stmt->close();
                echo json_encode(["status" => 1, "msg" => "Slot Accepted.Thanks For Booking 😊"]);
            } else {
                echo json_encode(["status" => 0, "msg" => "Error in preparing statement"]);
            }
        }
    }
} else {
    echo json_encode(["status" => 0, "msg" => "Invalid Data"]);
}
?>