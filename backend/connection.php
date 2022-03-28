<?php
$mysqli = new mysqli("localhost","ashok","ashok","covid");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?>