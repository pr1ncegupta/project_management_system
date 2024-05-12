<?php
include_once("../includes/db_connection.php");
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_type'] != "student") {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
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
        .student-dashboard-container {
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
        a {
            display: block;
            margin-bottom: 15px;
            padding: 10px 20px;
            background-color: #1976d2;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: #1565c0;
        }
        button {
            padding: 10px 20px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="student-dashboard-container">
        <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
        <a href="view_marks.php">View Marks</a>
        <a href="view_attendance.php">View Attendance</a>
        <a href="view_remarks.php">View Remarks</a>
        <a href="view_rating.php">View Rating</a>
        <a href="submit_progress.php">Submit Progress</a>
        <button id="logoutBtn">Logout</button>
    </div>

    <script>
        document.getElementById('logoutBtn').addEventListener('click', function() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = '../logout.php'; // Redirect to logout script
            }
        });

        // Disable browser back button to prevent navigation back to this page after logout
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };
    </script>
</body>
</html>
