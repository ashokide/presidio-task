<?php
include_once "connection.php";
if (isset($_POST['username']) && $_POST['username'] && isset($_POST['password']) && $_POST['password']) {
    if ($stmt = $mysqli->prepare("SELECT * FROM admin WHERE username = ?;")) {
        $stmt->bind_param("s", $username);
        $username = $_POST['username'];
        $stmt->execute();
        $stmt = $stmt->get_result();
        if ($stmt->num_rows == 0) {
            $stmt->close();
            echo json_encode(["status" => 0, "msg" => "User Not Found / Invalid Username"]);
        } else {
            if (password_verify($_POST['password'], $stmt->fetch_assoc()['password'])) {
                session_start();
                $_SESSION["adminname"] = $username;
                echo json_encode(["status" => 1, "msg" => "Logged In Successfully"]);
            } else {
                echo json_encode(["status" => 0, "msg" => "Invalid Password"]);
            }
        }
    } else {
        echo json_encode(["status" => 0, "msg" => "Error in preparing statement"]);
    }
}
?>