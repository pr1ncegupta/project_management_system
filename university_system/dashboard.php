<?php include_once("includes/db_connection.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="dashboard-container">
        <?php
        // Check if user is logged in
        session_start();
        if(isset($_SESSION['username'])) {
            echo "<h2>Welcome, ".$_SESSION['username']."</h2>";
            // Display appropriate dashboard based on user type
            if($_SESSION['user_type'] == "admin") {
                header("Location: admin/admin_dashboard.php");
            } elseif($_SESSION['user_type'] == "guide") {
                header("Location: guide/guide_dashboard.php");
            } elseif($_SESSION['user_type'] == "student") {
                header("Location: student/student_dashboard.php");
            }
        } else {
            header("Location: login.php");
        }
        ?>
    </div>
</body>
</html>
