@@ -0,0 +1,109 @@
<html>
<head>
    <title>Add Voter</title>
    <style>
        /* General Body Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            margin: 0;
            background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRVHzrXVZ68x5mGTqHXMfRKJOlFgHm03SAVWg&s');
            background-size: cover; /* Ensures the image covers the entire body */
            background-size: 100% 100%;
            background-position: center; /* Keeps the image centered */
            background-repeat: no-repeat; /* Prevents the image from repeating */
            padding: 20px;
        }
        /* Header Styling */
        h3 {
            text-align: right;
            margin-bottom: 20px;
        }
        /* Admin Button Styling */
        button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        /* Table Styling */
        table {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            background-color: rgb(138, 219, 136);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-spacing: 0;
        }
        /* Table Header Styling */
        th {
            text-align: left;
            padding-bottom: 12px;
            font-size: 18px;
            color: #333;
        }
        /* Input Field Styling */
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        /* Submit Button Styling */
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <!-- Admin Button -->
    <h3><a href='homepage.php'><button>SignOut</button></a></h3>
    <br><br><br><br><br><br><br><br><br>
    <!-- Voter Form -->
    <form action="add.php" method="post">
        <table>
            <tr>
                <th>Add User Credentials</th>
            </tr>
            <tr>
                <td><input type="text" placeholder="Enter your Aadhar Number" name="aadharid" required></td>
            </tr>
            <tr>
                <td><input type="text" placeholder="Enter your Iris ID" name="irisid" required></td>
            </tr>
            <tr>
                <td align="center"><input type="submit" value="Add"></td>
            </tr>
        </table>
    </form>
</body>
</html>
‎add.php
+99
Original file line number	Diff line number	Diff line change
@@ -0,0 +1,99 @@
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
‎count.php
+128
Original file line number	Diff line number	Diff line change
@@ -0,0 +1,128 @@
<html>
<?php
    require 'dbconn.php';
    session_start();
?>
<head>
    <title>Counting</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
	    font-family: Arial, sans-serif;
            background-image: url('data:image/jpeg;base64,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');
            background-size: cover; /* Ensures the image covers the entire body */
            background-size: 100% 100%;
            background-position: center; /* Keeps the image centered */
            background-repeat: no-repeat; /* Prevents the image from repeating */
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
            background-color: gold;
            padding:10px;
        }
        h3 {
            text-align: right;
        }
        button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: 20%;
            margin: 3px;
            border-radius: 10px;
            cursor: pointer;
        }
        table {
            width: 60%;
            margin: 0 auto;
            border-collapse: collapse;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
            font-size: 18px;
        }
        td {
            background-color: #fff;
            font-size: 16px;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        button:hover {
            background-color: #0056b3;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        caption {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            color: black;
            background-color: #f1f1f1;
            padding:10px;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding-top: 30px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h3><a href='add.html'><button>Add voter</button></a><a href='homepage.php'><button>Sign Out</button></a></h3>
    <div class="container">
        <!--<h1>Vote Count Results</h1>-->
        <?php
            $html = "<table>
            <caption>Vote Count Results for Each Party </caption>
            <tr>
                <th>Rank</th>
                <th>Party</th>
                <th>Count</th>
            </tr>";
            $rowno = 1;
            $sql = "SELECT * FROM vote ORDER BY count DESC";
            $rs = $conn->query($sql);
            if($rs->num_rows > 0) {
                foreach($rs as $rec): 
                    $html .= "<tr>
                        <td>".$rowno++."</td>
                        <td>".'Party '.$rec["party"]."</td>
                        <td>".$rec["count"]."</td>
                    </tr>";
                endforeach;
            }
            $html .= "</table>";
            $_SESSION["data"] = $html;
            echo $html;
        ?>
    </div>
</body>
</html>
‎dbconn.php
+6
Original file line number	Diff line number	Diff line change
@@ -0,0 +1,6 @@
<?php
$conn=new mysqli('localhost','root','','sih');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
‎homepage.php
+171
Original file line number	Diff line number	Diff line change
@@ -0,0 +1,171 @@
<html>
    <head>
        <title>Home Page</title>
        <style>
            body, h3, table {
                margin: 0;
                padding: 0;
            }
            body {
                font-family: Arial, sans-serif;
                background-image: url('https://img.freepik.com/free-vector/vote-indian-general-election-background-with-india-map-design_1017-49833.jpg?t=st=1733990780~exp=1733994380~hmac=c8ec2ca3d97c86069f0ce0a9515d174ef3f60f57f3f3a6e37c462985e8080e3e&w=826');
                background-size: cover; /* Ensures the image covers the entire body */
		background-size: 100% 100%;
                background-position: center; /* Keeps the image centered */
                background-repeat: no-repeat; /* Prevents the image from repeating */
                padding: 20px;
            }
            a {
                text-decoration: none;
                color: black;
                font-size: 16px;
            }
            h3 {
                text-align: right;
                margin-bottom: 20px;
            }
            /* Styling the Admin Button */
            button {
                padding: 10px 20px;
                background-color: #007BFF;
                color: white;
                border: none;
                border-radius: 10px;
                cursor: pointer;
            }
            button:hover {
                background-color: #0056b3;
            }
            /* Table Styling */
            table {
                width: 100%;
                max-width: 400px;
                margin: 20px auto;
                border-spacing: 0;
                background-color: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            }
            th {
                text-align: left;
                padding-bottom: 12px;
                font-size: 18px;
                color: #333;
            }
            /* Input Fields */
            input[type="text"] {
                width: 100%;
                padding: 10px;
                margin: 8px 0;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }
            input[type="submit"] {
                background-color: #007BFF;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
            }
            input[type="submit"]:hover {
                background-color: #0056b3;
            }
            /* Styling the dynamic PHP output */
            .status-text {
                text-align: center;
                font-size: 18px;
                margin: 10px 0;
            }
            /* Styling for the total, not voted, and voted counts */
            .total {
                font-weight: bold;
                color: #333;
            }
            .not-voted {
                color: red;
            }
            .voted {
                color: green;
            }
            /* Container for the dynamic status messages */
            .status-container {
                display: flex;
                justify-content: center;
                gap: 20px;
                font-size: 18px;
                font-weight: bold;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <h3><a href='signin.html'><button>Admin</button></a></h3>
        <form action="validate.php" method="post">
            <table>
                <tr>
                    <th>User Credentials</th>
                </tr>
                <tr>
                    <td><input type="text" placeholder="Enter your Aadhar Number" name="aadharid" required></td>
                </tr>
                <tr>
                    <td><input type="text" placeholder="Enter your Iris ID" name="irisid" required></td>
                </tr>
                <tr>
                    <td align="center"><input type="submit" value="Submit"></td>
                </tr>
            </table>
        </form>
        <!-- PHP Output Section for Vote Counts -->
        <div class="status-container">
            <?php
            require 'dbconn.php';
            // Fetch total number of candidates
            $sql = "SELECT count(*) AS total FROM people";
            $rs = $conn->query($sql);
            if($rs->num_rows > 0) {
                $rec = $rs->fetch_assoc();
                echo "<span class='status-text total'>Total candidates: " . $rec['total'] . "</span>";
            }
            // Fetch number of candidates who haven't voted
            $sql = "SELECT count(*) AS notvoted FROM people WHERE date IS NULL";
            $rs = $conn->query($sql);
            if($rs->num_rows > 0) {
                $rec = $rs->fetch_assoc();
                echo "<span class='status-text not-voted'>Candidates who haven't voted: " . $rec['notvoted'] . "</span>";
            }
            // Fetch number of candidates who have voted
            $sql = "SELECT count(*) AS voted FROM people WHERE date IS NOT NULL";
            $rs = $conn->query($sql);
            if($rs->num_rows > 0) {
                $rec = $rs->fetch_assoc();
                echo "<span class='status-text voted'>Candidates who have cast their vote: " . $rec['voted'] . "</span>";
            }
            ?>
        </div>
    </body>
</html>
‎signin.html
+94
Original file line number	Diff line number	Diff line change
@@ -0,0 +1,94 @@
<html>
    <head>
        <title>Sign In Page</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f9;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                font-family: Arial, sans-serif;
                background-image: url('https://www.shutterstock.com/image-vector/illustration-hand-voting-sign-india-260nw-2449815795.jpg');
                background-size: cover; /* Ensures the image covers the entire body */
		        background-size: 100% 100%;
                background-position: center; /* Keeps the image centered */
                background-repeat: no-repeat; /* Prevents the image from repeating */
                padding: 20px;
            }
            div {
                background-color: #7e96b1;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                width: 300px;
                text-align: center;
            }
            h2 {
                color: #333;
                font-size: 24px;
                margin-bottom: 20px;
            }
            input[type="text"] {
                width: 100%;
                padding: 10px;
                margin: 10px 0;
                border: 1px solid #ddd;
                border-radius: 5px;
                box-sizing: border-box;
                font-size: 16px;
            }
            input[type="password"] {
                width: 100%;
                padding: 10px;
                margin: 10px 0;
                border: 1px solid #ddd;
                border-radius: 5px;
                box-sizing: border-box;
                font-size: 16px;
            }
            input[type="submit"] {
                background-color: #4CAF50;
                color: white;
                border: none;
                padding: 10px 20px;
                font-size: 16px;
                border-radius: 5px;
                cursor: pointer;
                width: 100%;
                margin-top: 10px;
                transition: background-color 0.3s ease;
            }
            input[type="submit"]:hover {
                background-color: #45a049;
            }
            input[type="text"]:focus, input[type="submit"]:focus {
                outline: none;
                border-color: #4CAF50;
            }
            ::placeholder {
                color: #aaa;
            }
        </style>
    </head>
    <body>
        <div>
            <h2>Sign In</h2>
            <form action="signin.php" method="post">
                <input type="text" maxlength="20" size="20" placeholder="User Name" name="user_id" required> <br>
                <input type="password" maxlength="20" size="20" placeholder="Password" name="password" required> <br>
                <input type="submit" value="Sign In">
            </form>
        </div>
    </body>
</html>
‎signin.php
+17
Original file line number	Diff line number	Diff line change
@@ -0,0 +1,17 @@
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
‎validate.php
+27
Original file line number	Diff line number	Diff line change
@@ -0,0 +1,27 @@
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
‎vote.html
+192
Original file line number	Diff line number	Diff line change
@@ -0,0 +1,192 @@
<html>
    <head>
        <title>Vote</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                text-align: center;
                font-family: Arial, sans-serif;
                background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQj4GK-pnwD2jERjPu5lMtL-fiVxBrbV9Wzfw&s');
                background-size: cover; /* Ensures the image covers the entire body */
                background-size: 100% 100%;
                background-position: center; /* Keeps the image centered */
                background-repeat: no-repeat; /* Prevents the image from repeating */
                padding: 20px;
            }
            h1 {
                margin-top: 30px;
                color: #333;
            }
            form {
                margin: 20px;
                padding: 20px;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
                max-width: 900px;
                margin-left: auto;
                margin-right: auto;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            th, td {
                padding: 15px;
                text-align: center;
                border: 1px solid #ddd;
            }
            th {
                background-color: #4CAF50;
                color: white;
            }
            td {
                background-color: #f9f9f9;
            }
            img {
                width: 120px;
                height: 120px;
                object-fit: cover;
                border-radius: 8px;
            }
            button {
                padding: 10px 20px;
                font-size: 16px;
                color: white;
                background-color: #4CAF50;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }
            button:hover {
                background-color: #45a049;
            }
            button:active {
                background-color: #3e8e41;
            }
            @media (max-width: 768px) {
                img {
                    width: 100px;
                    height: 100px;
                }
                table {
                    width: 100%;
                }
                td, th {
                    font-size: 14px;
                }
            }
        </style>
    </head>
    <body>
        <h1>Vote for Your Favorite Party</h1>
        <form method="post" action="vote.php">
            <table>
                <tr>
                    <th>Party Name</th>
                    <th>Party Logo</th>
                    <th>VOTE</th>
                </tr>
                <tr>
                    <td>Party A</td>
                    <td><img src="symbols/binaculars.png" alt="Party A Logo" /></td>
                    <td><button name="binaculars" type="submit" onclick="return confirm('Are you sure you want to vote for Party A?')">ENTER</button></td>
                </tr>
                <tr>
                    <td>Party B</td>
                    <td><img src="symbols/bread.png" alt="Party B Logo" /></td>
                    <td><button name="bread" type="submit" onclick="return confirm('Are you sure you want to vote for Party B?')">ENTER</button></td>
                </tr>
                <tr>
                    <td>Party C</td>
                    <td><img src="symbols/brush.png" alt="Party C Logo" /></td>
                    <td><button name="brush" type="submit" onclick="return confirm('Are you sure you want to vote for Party C?')">ENTER</button></td>
                </tr>
                <tr>
                    <td>Party D</td>
                    <td><img src="symbols/cauliflower.png" alt="Party D Logo" /></td>
                    <td><button name="cauliflower" type="submit" onclick="return confirm('Are you sure you want to vote for Party D?')">ENTER</button></td>
                </tr>
                <tr>
                    <td>Party E</td>
                    <td><img src="symbols/chimney.png" alt="Party E Logo" /></td>
                    <td><button name="chimney" type="submit" onclick="return confirm('Are you sure you want to vote for Party E?')">ENTER</button></td>
                </tr>
                <tr>
                    <td>Party F</td>
                    <td><img src="symbols/dieselpump.png" alt="Party F Logo" /></td>
                    <td><button name="dieselpump" type="submit" onclick="return confirm('Are you sure you want to vote for Party F?')">ENTER</button></td>
                </tr>
                <tr>
                    <td>Party G</td>
                    <td><img src="symbols/dishantenna.png" alt="Party G Logo" /></td>
                    <td><button name="dishantenna" type="submit" onclick="return confirm('Are you sure you want to vote for Party G?')">ENTER</button></td>
                </tr>
                <tr>
                    <td>Party H</td>
                    <td><img src="symbols/gascylinder.png" alt="Party H Logo" /></td>
                    <td><button name="gascylinder" type="submit" onclick="return confirm('Are you sure you want to vote for Party H?')">ENTER</button></td>
                </tr>
                <tr>
                    <td>Party I</td>
                    <td><img src="symbols/grapes.png" alt="Party I Logo" /></td>
                    <td><button name="grapes" type="submit" onclick="return confirm('Are you sure you want to vote for Party I?')">ENTER</button></td>
                </tr>
                <tr>
                    <td>Party J</td>
                    <td><img src="symbols/kettle.png" alt="Party J Logo" /></td>
                    <td><button name="kettle" type="submit" onclick="return confirm('Are you sure you want to vote for Party J?')">ENTER</button></td>
                </tr>
                <tr>
                    <td>Party K</td>
                    <td><img src="symbols/slate.png" alt="Party K Logo" /></td>
                    <td><button name="slate" type="submit" onclick="return confirm('Are you sure you want to vote for Party K?')">ENTER</button></td>
                </tr>
                <tr>
                    <td>Party L</td>
                    <td><img src="symbols/mixie.png" alt="Party L Logo" /></td>
                    <td><button name="mixie" type="submit" onclick="return confirm('Are you sure you want to vote for Party L?')">ENTER</button></td>
                </tr>
                <tr>
                    <td>Party M</td>
                    <td><img src="symbols/pot.png" alt="Party M Logo" /></td>
                    <td><button name="pot" type="submit" onclick="return confirm('Are you sure you want to vote for Party M?')">ENTER</button></td>
                </tr>
                <tr>
                    <td>Party N</td>
                    <td><img src="symbols/pressurecooker.png" alt="Party N Logo" /></td>
                    <td><button name="pressurecooker" type="submit" onclick="return confirm('Are you sure you want to vote for Party N?')">ENTER</button></td>
                </tr>
                <tr>
                    <td>Party O</td>
                    <td><img src="symbols/ring.png" alt="Party O Logo" /></td>
                    <td><button name="ring" type="submit" onclick="return confirm('Are you sure you want to vote for Party O?')">ENTER</button></td>
                </tr>
                <tr>
                    <td>NOTA</td>
                    <td><img src="symbols/nota.webp" alt="NOTA Logo" /></td>
                    <td><button name="x" type="submit" onclick="return confirm('Are you sure you want to vote for NOTA?')">ENTER</button></td>
                </tr>
            </table>
        </form>
    </body>
</html>
‎vote.php
+118
Original file line number	Diff line number	Diff line change
@@ -0,0 +1,118 @@
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
‎voted.php
+132
Original file line number	Diff line number	Diff line change
@@ -0,0 +1,132 @@
<?php
require 'dbconn.php';
session_start();
$aadhar = $_SESSION["aadhar"];
$iris = $_SESSION['iris'];
$sql = "SELECT * FROM people WHERE aadharnumber = '$aadhar' AND irisid = '$iris'";
$rs = $conn->query($sql);
if ($rs->num_rows > 0) {
    $rec = $rs->fetch_assoc();
    $message = "You already casted your vote on " . date("F j, Y, g:i a", strtotime($rec['date'])) . ".";
} else {
    $message = "No vote found for this session.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote Status</title>
    <style>
        html, body {
            height: 100%; /* Make sure both html and body take up full height */
            margin: 0; /* Remove default margins */
            padding: 0; /* Remove default padding */
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            background-image: url('https://png.pngtree.com/png-vector/20190916/ourmid/pngtree-block-icon-for-your-project-png-image_1731069.jpg');
            background-size: cover; /* Ensure the image covers the entire body */
            background-position: center; /* Keeps the image centered */
            background-repeat: no-repeat; /* Prevents the image from repeating */
            padding: 10px;
            display: flex; /* Flexbox helps to align the content properly */
            flex-direction: column;
            justify-content: center; /* Vertically centers the content */
            align-items: center; /* Horizontally centers the content */
            min-height: 100vh; /* Ensures the body takes up at least the full height of the viewport */
        }
        h1 {
            margin-top: 50px;
            color: #333;
        }
        .container {
            margin: 30px;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        .message {
            font-size: 18px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .date {
            font-size: 16px;
            color: #4CAF50;
            font-weight: bold;
        }
        button {
            padding: 12px 25px;
            font-size: 16px;
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        button:hover {
            background-color: #45a049;
        }
        button:active {
            background-color: #3e8e41;
        }
        @media (max-width: 768px) {
            .container {
                margin: 15px;
                padding: 15px;
            }
            h1 {
                font-size: 24px;
            }
            .message {
                font-size: 16px;
            }
            button {
                font-size: 14px;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <h1>Voting Status</h1>
    <div class="container">
        <div class="message">
            <?php echo $message; ?>
        </div>
        <?php if ($rs->num_rows > 0): ?>
            <div class="date">Your vote was cast on: <?php echo date("F j, Y, g:i a", strtotime($rec['date'])); ?></div>
        <?php endif; ?>
        <a href="homepage.php"><button>Go Back to Home</button></a>
    </div>
</body>
</html>
