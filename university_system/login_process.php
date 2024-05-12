<?php
include_once("includes/db_connection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate user's credentials against the database
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['user_type'] = $row['user_type'];

        // Redirect based on user type
        if ($row['user_type'] == 'admin') {
            header("Location: admin/admin_dashboard.php");
            exit();
        } elseif ($row['user_type'] == 'student') {
            header("Location: student/student_dashboard.php");
            exit();
        } elseif ($row['user_type'] == 'guide') {
            header("Location: guide/guide_dashboard.php");
            exit();
        }
    } else {
        // Redirect back to the login page with an error message
        header("Location: login.php?error=1");
        exit();
    }
}
?>
