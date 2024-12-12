<?php
require_once "dbconn.php";  
session_start();

$aadhar=$_POST["aadharid"];
$iris=$_POST["irisid"];
$_SESSION["aadhar"] = $aadhar;
$_SESSION['iris']=$iris;

$sql = "select * from people where aadharnumber='$aadhar' and irisid='$iris'"; 
$rs = $conn->query($sql); 
if($rs->num_rows>0) 
    {  
        $rec = $rs->fetch_assoc(); 
        if ($rec['date']==NULL){
            header('location:vote.html');
        }
        else{
            header('location:voted.php');
        }
    }
        
else{
    echo "<div style='text-align:center;'>User credentials not matched ! <br> <p>go to
                <a href='homepage.php' style='text-decoration:none;font-size:20px'>home</a> again</div>";
}
?>
