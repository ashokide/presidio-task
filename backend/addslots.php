<?php
include_once "connection.php";

$vaccinename = $_POST["vaccinename"];
$date = $_POST["date"];

if (isset($vaccinename) && $vaccinename && isset($date) && $date) {
    if ($stmt = $mysqli->prepare("SELECT * FROM slots WHERE vaccinename = ? AND slotdate = ?")) {
        $stmt->bind_param("ss", $name,$dat);
        $name = $vaccinename;
        $dat = $date;
        $stmt->execute();
        $stmt = $stmt->get_result();
        if ($stmt->num_rows == 0) {
            $stmt->close();
            if ($stmt = $mysqli->prepare("INSERT INTO slots (vaccinename,slotdate) VALUES(?,?)")) {
                $stmt->bind_param("ss", $name,$dat);
                $name = $vaccinename;
                $dat = $date;
                $stmt->execute();
                echo json_encode(["status" => 1, "msg" => "Slot Added"]);
            } else {
                echo json_encode(["status" => 0, "msg" => "Error in preparing statement"]);
            }
        } else {
            echo json_encode(["status" => 0, "msg" => "Slot already exists"]);
        }
    } else {
        echo json_encode(["status" => 0, "msg" => "Error in preparing statement"]);
    }
}
?>