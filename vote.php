<?php
session_start();
require_once "dbconn.php";  
$parties = [
    'binaculars' => 'Party A',
    'bread' => 'Party B',
    'brush' => 'Party C',
    'cauliflower' => 'Party D',
    'chimney' => 'Party E',
    'dieselpump' => 'Party F',
    'dishantenna' => 'Party G',
    'gascylinder' => 'Party H',
    'grapes' => 'Party I',
    'kettle' => 'Party J',
    'slate' => 'Party K',
    'mixie' => 'Party L',
    'pot' => 'Party M',
    'pressurecooker' => 'Party N',
    'ring' => 'Party O',
    'nota' => 'x'
];

$count=0;
$l='';
$aadhar = $_SESSION["aadhar"];
$iris = $_SESSION['iris'];
date_default_timezone_set("Asia/Kolkata"); 
$d = date("y/m/d H:i:s"); 
$sql = "select * from people where aadharnumber='$aadhar' and irisid='$iris'"; 
$rs = $conn->query($sql); 
if($rs->num_rows>0) 
    {  
    $rec = $rs->fetch_assoc(); 
    if ($rec['date']==NULL){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $vote = key($_POST); 
            if (array_key_exists($vote, $parties)) {
                $_SESSION['vote'] = $parties[$vote];
                $string = $parties[$vote];
                $last_char = substr($string, -1);  
                $l=$last_char;
                $message = "You have successfully voted for " . $parties[$vote];
                $sql = "select count from vote where party='$last_char'"; 
                $rs = $conn->query($sql); 
                if($rs->num_rows>0) {  
                    $rec = $rs->fetch_assoc(); 
                    $count=$rec['count'];
                    $count+=1;
                }
                $sql = "update vote set count='$count' where party='$l'"; 
                if($conn->query($sql) === TRUE){ 
                    $sql1 = "update people set date='$d' WHERE aadharnumber = '$aadhar' AND irisid = '$iris'";
                    if ($conn->query($sql1) === TRUE) {
                            echo '';
                        }
                    } 
                else {
                    $message = "Invalid vote!";
                }
            }
        } 
        else {
            $message = "Please select a party to vote for.";
        }
    }
    else{
        header('location:voted.php');
    }
}


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Vote Confirmation</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 20px;
                text-align: center;
            .message {
                background-color: #dff0d8;
                color: #3c763d;
                padding: 20px;
                border-radius: 5px;
                font-size: 18px;
                margin-top: 20px;
            }
            .error {
                background-color: #f2dede;
                color: #a94442;
            }
            .redirecting {
                font-size: 16px;
                margin-top: 20px;
                color: #555;
            }
        </style>
        <script>
            setTimeout(function() {
                window.location.href = 'homepage.php'; 
            }, 5000);
        </script>
    </head>
    <body>
        <h1>Voting Confirmation</h1>
        <div class="message <?php echo isset($message) && strpos($message, 'Invalid') !== false ? 'error' : ''; ?>">
            <?php echo $message; ?>
        </div>

        <div class="redirecting">
            You will be redirected to the homepage in 5 seconds...
        </div>
    </body>
</html>
