<?php
$conn=new mysqli('localhost','root','','sih');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
