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
