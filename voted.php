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
