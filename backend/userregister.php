<?php
include_once "connection.php";
if (isset($_POST['username']) && $_POST['username'] && isset($_POST['password']) && $_POST['password'] && isset($_POST['phoneno']) && $_POST['phoneno'] && isset($_POST['city']) && $_POST['city']) {
    if ($stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ?")) {
        $stmt->bind_param("s", $username);
        $username = $_POST['username'];
        $stmt->execute();
        $stmt = $stmt->get_result();
        if ($stmt->num_rows == 0) {
            $stmt->close();
            if ($stmt = $mysqli->prepare("INSERT INTO users (username,password,phoneno,city) VALUES(?,?,?,?)")) {
                $stmt->bind_param("ssss", $username, $password,$phoneno,$city);
                $username = $_POST['username'];
                $phoneno = $_POST['phoneno'];
                $city = $_POST['city'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $stmt->execute();
                session_start();
                $_SESSION["username"] = $username;
                echo json_encode(["status" => 1, "msg" => "User Registered"]);
            } else {
                echo json_encode(["status" => 0, "msg" => "Error in preparing statement"]);
            }
        } else {
            echo json_encode(["status" => 0, "msg" => "Username already exists"]);
        }
    } else {
        echo json_encode(["status" => 0, "msg" => "Error in preparing statement"]);
    }
}
?>