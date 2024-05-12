<?php
include_once("../includes/db_connection.php");
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_type'] != "admin") {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
        .admin-dashboard-container {
            text-align: center;
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
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
        .logout-btn {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
            background-color: #757575;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .logout-btn:hover {
            background-color: #424242;
        }
    </style>
</head>
<body>
    <div class="admin-dashboard-container">
        <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
        <a href="manage_users.php">Manage Users</a>
        <a href="../index.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>
