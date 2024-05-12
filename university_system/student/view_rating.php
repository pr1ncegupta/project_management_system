<?php
include_once("../includes/db_connection.php");
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_type'] != "student") {
    header("Location: ../login.php");
    exit();
}

// Get the logged-in student's ID
$student_id = $_SESSION['user_id']; // Assuming 'user_id' is the column name for student ID in your users table

// Retrieve rating along with guide information from database
$sql = "SELECT r.rating, u.user_id AS guide_id, u.username AS guide_name
        FROM ratings r
        INNER JOIN users u ON r.guide_id = u.user_id
        WHERE r.student_id = '$student_id'";
$result = $conn->query($sql);

if (!$result) {
    echo "Error: " . $sql . "<br>" . $conn->error; // Debugging SQL query
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Rating</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .view-rating-container {
            text-align: center;
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 90%;
        }
        h2 {
            color: #1976d2;
            margin-bottom: 20px;
        }
        p {
            margin-bottom: 10px;
        }
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #1976d2;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .back-btn:hover {
            background-color: #1565c0;
        }
    </style>
</head>
<body>
    <div class="view-rating-container">
        <h2>Your Rating</h2>
        <?php
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<p>Your overall rating: ".$row["rating"]."</p>";
            echo "<p>Guide ID: ".$row["guide_id"]."</p>";
            echo "<p>Guide Name: ".$row["guide_name"]."</p>";
        } else {
            echo "<p>No rating found</p>";
        }
        ?>
        <a href="student_dashboard.php" class="back-btn">Back to Dashboard</a>
    </div>

    <!-- JavaScript for back button -->
    <script>
        // Function to handle back button click
        function redirectToDashboard() {
            window.location.href = 'student_dashboard.php';
        }
    </script>
</body>
</html>
