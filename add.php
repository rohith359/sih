<?php 
require_once "dbconn.php";  
session_start();

// Collect POST data from the form
$aadhar = $_POST["aadharid"];
$iris = $_POST["irisid"];
$_SESSION["aadhar"] = $aadhar;
$_SESSION['iris'] = $iris;

// SQL query to insert data into the database
$sql = "INSERT INTO people (aadharnumber, irisid, date) VALUES ('$aadhar', '$iris', NULL)";  

// Check if the query was successful
?>
<html>
<head>
    <title>Result</title>
    <style>
        /* General Body Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            margin: 0;
            text-align: center;
        }

        /* Message Container Styling */
        .message {
            padding: 20px;
            margin: 20px;
            border-radius: 8px;
            font-size: 18px;
            text-align: center;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
        }

        /* Success Message Styling */
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        /* Error Message Styling */
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Link Styling */
        a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }

        a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>

<?php

$sql = "INSERT INTO people (aadharnumber, irisid, date) VALUES ('$aadhar', '$iris', NULL)";  
$sql1 = "select * from people where aadharnumber = '$aadhar' and irisid='$iris'";
$rs = $conn->query($sql1);
if($rs->num_rows>0)
{
    echo "already have your details";
}
else{
    $sql2 = "select * from people where aadharnumber = '$aadhar' or irisid='$iris'";
    $rs = $conn->query($sql2);
    if($rs->num_rows>0)
    {
        echo "Re-check your Aadhaar ID or Iris ID; one of them is incorrect.";
    }
    else{
        if ($conn->query($sql) === TRUE) {
            // Success message
            echo "<div class='message success'>Inserted successfully. <a href='add.html'>Add more users</a></div>";
        } else {
            // Error message
            echo "<div class='message error'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }
    }
}
?>

</body>
</html>
