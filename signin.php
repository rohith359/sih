<?php
require 'dbconn.php';
$uid = mysqli_real_escape_string($conn, $_POST["user_id"]);
$password = mysqli_real_escape_string($conn, $_POST["password"]);
$uid = $_POST["user_id"];
$password = $_POST["password"];
$sql = "select * from admin where userId = '$uid' and password='$password'";
$rs = $conn->query($sql);
if($rs->num_rows>0)
{
    header('location:count.php');
}
else{
    echo "Invalid user credentials
    <br><br> Please <a href='signin.html'> Signin</a> again.</a></font>";
}
?>
