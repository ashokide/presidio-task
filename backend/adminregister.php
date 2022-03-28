<?php
include_once "connection.php";

$username = $_POST["username"];
$password = $_POST["password"];
$phoneno = $_POST["phoneno"];
$city = $_POST["city"];
$adminid = $_POST["adminid"];

if (isset($username) && $username && isset($password) && $password && isset($phoneno) && $phoneno && isset($city) && $city && isset($adminid) && $adminid) {
    if ($stmt = $mysqli->prepare("SELECT * FROM admin WHERE username = ?")) {
        $stmt->bind_param("s", $name);
        $name = $username;
        $stmt->execute();
        $stmt = $stmt->get_result();
        if ($stmt->num_rows == 0) {
            $stmt->close();
            if ($stmt = $mysqli->prepare("INSERT INTO admin (username,password,phoneno,city,adminid) VALUES(?,?,?,?,?)")) {
                $stmt->bind_param("sssss", $user, $pass, $phone, $city, $aid);
                $user = $username;
                $phone = $phoneno;
                $city = $city;
                $aid = $adminid;
                $pass = password_hash($password, PASSWORD_DEFAULT);
                $stmt->execute();
                session_start();
                $_SESSION["adminname"] = $username;
                echo json_encode(["status" => 1, "msg" => "Admin Registered"]);
            } else {
                echo json_encode(["status" => 0, "msg" => "Error in preparing statement"]);
            }
        } else {
            echo json_encode(["status" => 0, "msg" => "Admin already exists"]);
        }
    } else {
        echo json_encode(["status" => 0, "msg" => "Error in preparing statement"]);
    }
}
?>