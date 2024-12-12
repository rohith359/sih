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
